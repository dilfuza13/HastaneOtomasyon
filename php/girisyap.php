<?PHP
    require_once("inc_config.php");

    $email = p('email');
    $password = p('password');

    if($email=='' || $password==''){echo 'Bilgiler eksik veya hatalı!'; exit;}

    $patient = mysqli_fetch_assoc($mysqli->query("select * from patient where email='$email'"));
    if(!$patient){echo 'E-Posta ve Parola hatalı!'; exit;}

    if($password!==$patient['password']){echo 'E-Posta ve Parola hatalı!'; exit;}
   
    $_SESSION['patient'] = [
        "login"		=> true,
        "id"		=> $patient['id'],
        "name"		=> $patient['name']
    ];

    header("Location:hesabim.php");
    exit;
?>