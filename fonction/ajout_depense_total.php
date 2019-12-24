<?php
    include_once("../include/include.php");
    $coach=$_SESSION['matricule'];
    date_default_timezone_set('Europe/Moscow');
    $date= new Datetime();
    $Hnow= $date->format("H:i:s");
   if(isset($_POST['description'])){
       if(!empty($_POST['description'])){
           $sql="INSERT INTO `depense`(`id_dep`, `date`, `heure`, `mt_heb`, `mt_resp`, `mt_carb`, `mt_autre`, `fact_heb`, `fact_rest`, `fact_carb`, `fact_autre`, `observation`, `id_equipe`, `id_coach`) VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)";
           $main->query($sql,array(date('Y-m-d'),$Hnow,$_POST['Heb'],$_POST['Rest'],$_POST['Carb'],$_POST['Autre'],$_POST['tabFact'][0],$_POST['tabFact'][1],$_POST['tabFact'][2],$_POST['tabFact'][3],$_POST['description'],'VPTEST',$coach));
           $json['idfacture']=$idfactTemp;
       }
   }
    echo json_encode($json);