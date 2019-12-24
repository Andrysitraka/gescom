<?php 
include_once ('main.php');
$main= new main;
$mot=$_GET['term'];
$array=array();

$sql="SELECT `LIBELLE_VILLE` FROM `ville` WHERE `LIBELLE_VILLE` LIKE '%".$mot."%'";
$result=$main->queryAll($sql);
foreach ($result as $result) {
		array_push($array, $result['LIBELLE_VILLE']);
}
echo json_encode($array); 

?>