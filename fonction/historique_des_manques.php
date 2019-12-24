<?php
include_once("../include/include.php");
$json=array();
$sql="SELECT * FROM `rapport` WHERE `type` <> 'rapport de vente' AND `type` <> 'DEPENSE'";
$manque=$main->queryAll($sql,array($Madate['date']));
echo json_encode($manque);
?>