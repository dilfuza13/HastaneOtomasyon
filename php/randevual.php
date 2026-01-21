<?PHP
    require_once("inc_config.php");

    $doctor = p('doctor');
    $tarih = p('tarih');
    $timeslot = p('timeslot');

    $patientid = $_SESSION['patient']['id'];

    if($doctor=='' || $tarih=='' || $timeslot==''){echo 'Bilgiler eksik veya hatalı!'; exit;}

    echo $doctor.'>'.$tarih.'>'.$timeslot;

    $timeslot = $tarih.' '.$timeslot;

    $slot = mysqli_fetch_assoc($mysqli->query("select id from timeslot where doctor='$doctor' and timeslot='$timeslot' and status=1"));

    if(!$slot){echo 'Slot Uygun değil!'; exit;}
        

    $mysqli->query("update timeslot set status=2 where id='{$slot['id']}'");

    if($mysqli -> affected_rows<1){
        echo 'Slot güncellenemedi!'; exit;
    }

    $createAppointment = $mysqli->query("insert into appointment(doctor,patient,timeslot,status)
                                        values('$doctor','$patientid','$timeslot','1')");
    

    if(!$createAppointment){echo 'Randevu oluşturulamadı!'; exit;}


    header("Location:hesabim.php");
    exit;
?>