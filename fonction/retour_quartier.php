<?php 
include_once ('main.php');
$main= new main;
$mot=$_GET['term'];

$array=array();
$sql="SELECT `LIBELLE_FOKONTANY` FROM `quartier` WHERE `LIBELLE_VILLE` LIKE ? AND  `LIBELLE_FOKONTANY` LIKE '%".$mot."%'";
$result=$main->queryAll($sql,array($_GET['ville']));
foreach ($result as $result) {
		array_push($array, $result['LIBELLE_FOKONTANY']);
}
echo json_encode($array); 

?>