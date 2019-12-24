<?php
    include_once('../include/include.php');
    date_default_timezone_set("Europe/Moscow");
    $dt=new dateTime();
    $date=$dt->format("H:i:s");
    $commercial=$_POST['com'];
    if(isset($commercial) AND isset($_POST['note_presentation']) AND isset($_POST['note_argumentaire']) AND isset($_POST['note_cible']) AND isset($_POST['note_comportement'])){
        if(!empty($commercial) AND !empty($_POST['note_presentation']) AND !empty($_POST['note_argumentaire']) AND !empty($_POST['note_cible']) AND !empty($_POST['note_comportement'])){
            //insertion evaluation
            $sql="INSERT INTO `note_evaluation`(`idev`, `presentation`, `argumentaire`, `cible`, `comportement`) VALUES (?,?,?,?,?)";
            $main->query($sql,array(null,$_POST['note_presentation'],$_POST['note_argumentaire'],$_POST['note_cible'],$_POST['note_comportement']));
        }
    }