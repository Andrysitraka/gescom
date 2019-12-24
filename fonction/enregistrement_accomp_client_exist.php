<?php
include_once('../include/include.php');
date_default_timezone_set("Europe/Moscow");
$commercial=$_POST['com'];
$dt=new dateTime();
$date=$dt->format("H:i:s");
if (isset($_POST['content_produit']) AND isset($_POST['content_quantite']) AND isset($_POST['ville']) AND isset($_POST['quartier']) AND isset($_POST['codeClient']) AND isset($_POST['note_presentation']) AND isset($_POST['note_argumentaire']) AND isset($_POST['note_cible']) AND isset($_POST['note_comportement'])){
    if (!empty($_POST['content_produit']) AND !empty($_POST['content_quantite']) AND !empty($_POST['ville']) AND !empty($_POST['quartier']) AND !empty($_POST['codeClient']) AND !empty($_POST['note_presentation']) AND !empty($_POST['note_argumentaire']) AND !empty($_POST['note_cible']) AND !empty($_POST['note_comportement'])){
      $activites="vente d'accompagnement";
      $id_coach='NULL';
       
        $content_produit=array();
        $content_quantite=array();
     
        $idPrix=json_decode($_POST['idPrix']);
        
        $content_produit=json_decode($_POST['content_produit']);
        $content_quantite=json_decode($_POST['content_quantite']);
    
        
        //get de l'équipe du commercial
        $sql1="SELECT `designationEquipe` FROM `planing_equipe` WHERE `mtrP` LIKE ? AND `statut` LIKE 'Active'";
        $equipe=$main->query($sql1,array($commercial));
        
        $main->historique(array(null,date("Y-m-d"),$date,$activites, $_SESSION['matricule'],0,''));
        $id_coach=$main->getIdStory_coach($_SESSION['matricule'],date("Y-m-d"),$date);
        
        //insertion evaluation
        $sql="INSERT INTO `note_evaluation`(`idev`, `presentation`, `argumentaire`, `cible`, `comportement`) VALUES (?,?,?,?,?)";
        $main->query($sql,array(null,$_POST['note_presentation'],$_POST['note_argumentaire'],$_POST['note_cible'],$_POST['note_comportement']));

        $idev=$main->getEvaluation(); //prend l'id de l'évaluation
        foreach ($content_produit as $key=>$content_produit) {
            $sql="INSERT INTO `vente`(`idVente`,`codeClient`,`quantite`, `lieu`, `date`, `idVP`, `heure`,`codeproduit`, `ville`, `quartier`,`id_equipe`,`id_historique_coach`,`idPrix`,`id_evaluation`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $main->query($sql,array(null,$_POST['codeClient'],$content_quantite[$key],$_SESSION['idMission'],date("Y-m-d"),$commercial,$date,$content_produit,$_POST['ville'],$_POST['quartier'],$equipe['designationEquipe'],$id_coach,$idPrix[$key],$idev[0]));
        }
        echo "false";

 }
}
?>

