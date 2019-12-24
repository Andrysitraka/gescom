<?php
include_once("../include/include.php");
if(isset($_POST['type']) AND isset($_POST['description']) AND isset($_POST['matricule']) AND isset($_POST['montant']) ){
  if(!empty($_POST['type']) AND !empty($_POST['description']) AND !empty($_POST['matricule']) AND !empty($_POST['montant'])){
      
$type=$_POST['type'];
$description=$_POST['description'];
$matricule=$_POST['matricule'];
$montant=$_POST['montant'];
$sql="INSERT INTO `rapport`(`idr`, `type`, `date`, `heure`, `description`, `ca_journaliere`, `id_coach`) VALUES (?,?,?,?,?,?,?)";
$main->query($sql,array(null,$type,date("Y-m-d"),date("H:m:s"),$description,$montant,$matricule));    
echo "ok";
 }    
}

?>