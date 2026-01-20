<?PHP

	session_start(); ob_start();

	// veri tabanı bağlantı bilgilerini tanımlıyoruz

	//local database settings
	$DbHost		= "mysql";
	$DbUser		= "admindilfuza";
	$DbPass		= "dilfuzakarimova";
	$DbName		= "hastaneotomasyon";

	//web server database settings
	//$DbHost		= "localhost";
	//$DbName		= "volkansezer";
	//$DbUser		= "sezervolkan";
	//$DbPass		= "Tamirci!34";

	//vertabanına bağlanıyoruz
	$mysqli = new mysqli($DbHost, $DbUser, $DbPass, $DbName);

	//bağlantı kurulamazsa hata dönüyoruz
	if($mysqli->connect_errno){
		printf("Bağlantı Hatası: %s\n", $mysqli->connect_error);
		exit();
	}
	
	//bağlantı sağlandı, dil formatını UTF8 olarak tanımlıyoruz
	mysqli_query($mysqli ,"SET NAMES UTF8");


	$sitename = "Hastane Otomasyon"; //değiştirilebilir tanımalma
	const _SiteName = "Hastane Otomasyon"; //değiştirilemez tanımlama
	const _CopyRight = "2026";


	//GET ile alınan verileri temizleyen fonksion
	function g($data){
		if(!isset($_GET[$data])){return false;} //veri boşsa geri false döner
		$data = trim($_GET[$data]); //verinin başındaki ve sonundai boşlukları temizler
		$data = strip_tags($data); //verinin içindeki kod/komut olabilecek karakterleri bozar
		return $data; //son veriyi geri gönder
	}

	//POST ile alınan verileri temizleyen fonksion
	function p($data){
		if(!isset($_POST[$data])){return false;}
		$data = trim($_POST[$data]);
		$data = strip_tags($data);
		return $data;
	}


?>