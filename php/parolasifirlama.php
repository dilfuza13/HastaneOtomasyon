<?PHP

    include('inc_config.php');

    $email = g('email');
    $resetcode = g('resetcode');

    if(!$email || !$resetcode){echo "Eksik parametre."; exit;}

    $query = $mysqli->query("SELECT * FROM resetpassword WHERE email='$email' AND resetcode='$resetcode'");
    $fetch = mysqli_fetch_assoc($query);
    if(!$fetch){echo "Geçersiz link."; exit;}

    $status = $fetch['status'];
    $expiredtime = $fetch['expiredtime'];
    $date = new DateTime();
    //echo $date->format('Y-m-d H:i:s');

    if($status == 1){echo "Bu link zaten kullanılmış."; exit;}
    if($expiredtime < $date->format('Y-m-d H:i:s')){echo "Linkin süresi dolmuş."; exit;}

    if(isset($_POST['password']) && $_POST['password'] != ""){
        $password = p($_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $mysqli->query("UPDATE patient SET password='$hash' WHERE id='$fetch[patient]'");
        $mysqli->query("UPDATE resetpassword SET status='1' WHERE id='$fetch[id]'");
        
        echo "Parola başarıyla değiştirildi.";
        header("Location: $siteurl/girisyap.php");
        exit;
    }

?>
