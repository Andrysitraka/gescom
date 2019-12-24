<?php
include_once('../include/include.php');
$retour=array("error"=>"true");
$date_deb=new DateTime($_POST['date_deb']);
$date_deb->format("Y-m-d ");
$date_fin=new DateTime($_POST['date_fin']);
$date_fin->format("Y-m-d ");
if( isset($_POST['date_deb']) AND isset($_POST['date_fin']) AND  isset($_POST['idMission']) AND isset($_POST['date']) AND isset($_POST['ville']) AND isset($_POST['province']) AND isset($_POST['quartier']) AND isset($_POST['IdEquipe']) AND isset($_POST['Panier']) ){
    if( !empty($_POST['date_deb']) AND !empty($_POST['date_fin']) AND !empty($_POST['idMission']) AND !empty($_POST['date']) AND !empty($_POST['ville']) AND !empty($_POST['province']) AND !empty($_POST['quartier']) AND !empty($_POST['IdEquipe']) AND !empty($_POST['Panier'])){
$sql="INSERT INTO `planing`(`idPL`, `idMission`, `date`, `ville`, `province`, `quartier`, `IdEquipe`, `Panier`) VALUES (?,?,?,?,?,?,?,?)";
$sql="(`idPL`, `idMission`, `date_deb`, `date_fin`, `date`, `ville`, `province`, `quartier`, `IdEquipe`, `Panier`) VLAUES(?,?,?,?,?,?,?,?,?,?)";
$main->query($sql,array(null,$_POST['idMission'],$date_deb,$date_fin,$_POST['date'],$_POST['ville'], $_POST['province'], $_POST['quartier'], $_POST['IdEquipe'], $_POST['Panier']));
$retour['error']='false';
 }
}
echo json_encode($retour);

