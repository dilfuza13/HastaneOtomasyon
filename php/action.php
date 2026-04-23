<?PHP
    include("inc_config.php");

    if(!isset($_SESSION['patient']['id'])){header("Location: girisyap.php");  exit;}
    $patientid = $_SESSION['patient']['id'];

    if(!isset($_POST["action"])){header("Location: $siteurl"); exit;}
    $action = p("action");



    if($action=="addstory"){
        
        $patient = p("patient");
        $request = p("request");
        $story = p("story");

        if($patient=="" || $request=="" || $story==""){echo "Eksik veri"; exit;}

        $reqeust = mysqli_fetch_assoc($mysqli->query("SELECT * FROM requests WHERE id='$request' and patient='$patient'"));
        if(!$reqeust){echo "Talep bulunamadı veya hatalı"; exit;}
        
        $date = new DateTime();
        //echo $date->format('Y-m-d H:i:s');

        $newstory = $reqeust['story'] . "<br><small>" . $date->format('Y-m-d H:i:s') . "</small><br>" . $story;

        $mysqli->query("UPDATE requests SET story='$newstory', status='2' WHERE id='$request'");

        header("Location: $siteurl/talep.php?id=$request");

        exit;

    }

    if($action=="addfile"){
        
        $patient = p("patient");
        $request = p("request");
        $file = $_FILES["file"];

        if($patient=="" || $request=="" || $file==""){echo "eksik veri"; exit;}

        $newfilename = rand(00000, 99999)."-".rand(00000, 99999).$file["name"];
        
        if(!move_uploaded_file($file["tmp_name"], "uploads/" . $newfilename)){echo "Dosya yüklenemedi"; exit;}

        $mysqli->query("INSERT INTO uploads (patient, request, fileurl) VALUES ('$patient', '$request', '$newfilename')");

        header("Location: $siteurl/talep.php?id=$request");

        exit;

    }


?>