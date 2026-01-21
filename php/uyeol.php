<?PHP
    require_once("inc_config.php");

    $name = p('name');
    $email = p('email');
    $password = p('password');
    $phone = p('phone');
    $address = p('address');
    $birthyear = p('birthyear');
    $relative = p('relative');


    $patient = mysqli_fetch_assoc($mysqli->query("select id from patient where email='$email'"));
    if($patient){echo 'bu eposta ile zaten bir hesap var!'; exit;}

    $create = $mysqli->query("insert into patient(name, email, password, phone, birthyear, address, relative)
                        values('$name','$email','$password','$phone','$birthyear','$address','$relative')");

    if($create){
        $_SESSION['patient'] = [
            "login"		=> true,
            "id"		=> $mysqli->insert_id,
            "name"		=> $name
	    ];

        header("Location:hesabim.php");
        exit;
    }

    echo 'Üyelik oluşturulamadı!';
    exit;
?>