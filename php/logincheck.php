<?PHP

	//önemli ayarları getirdik (veritabanı, configuration, functions)
	require_once("inc_config.php");

	//kullanıcı giriş yapmışsa, doğrudan anasayfaya yönlendiriyoruz
	if(isset($_SESSION['user']) && $_SESSION['user']['login']==true){
		header("location:index.php");
		exit;
	}

	//POST ile gönderim koruması eklendi
	if($_SERVER["REQUEST_METHOD"] != "POST"){
		header("Location:logout.php");
		exit;
	}

	$username	= p('username');
	$password	= p('password');

	if($username == '' || $username == null || $password == '' || $password == null){
		$_SESSION['alert']['warning'] = 'BİLGİLER EKSİK!';
		header("Location:login.php");
		exit;
	}

	//önce sadece username'i kontrol ettiriyoruz
	$user = mysqli_fetch_assoc($mysqli->query("select * from user where username='$username'"));
	if(!$user){ //$user oluşmamışsa (!)
		$_SESSION['alert']['warning'] = 'KULLANICI ADI VEYA PAROLA HATALI !1';
		header("Location:login.php");
		exit;
	}

	//şimdi de parolayı kontrol ettiriyoruz
	if($user['password']!==$password){
		$_SESSION['alert']['warning'] = 'KULLANICI ADI VEYA PAROLA HATALI !2';
		header("Location:login.php");
		exit;
	}

	//şimdi de durumunu kontrol ediyoruz
	if(!$user['status']){ //0 pasif, 1 aktif (!1) 1 değilse
		$_SESSION['alert']['warning'] = 'KULLANICI AKTİF DEĞİL!';
		header("Location:login.php");
		exit;
	}

	$_SESSION['user'] = [
		"login"		=> true,
		"id"		=> $user['id'],
		"name"		=> $user['name'],
		"username"	=> $user['username']
	];

	header("Location:index.php");

	exit;

?>