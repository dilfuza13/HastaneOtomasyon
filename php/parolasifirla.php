<?PHP
    require_once("inc_config.php");

    $email = p('email');
    if($email==''){echo "Lütfen e-posta adresinizi giriniz."; exit;}


    echo 'E-posta adresinize sıfırlama linki gönderilmiştir.';
    exit;

?>