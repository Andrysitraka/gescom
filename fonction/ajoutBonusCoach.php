<?php
    include_once("../include/include.php");
        if(isset($_POST['heure']) AND isset($_POST['date']) AND isset($_POST['coach']) AND isset($_POST['controller']) AND isset($_POST['montant']) AND isset($_POST['motif'])){
           if(!empty($_POST['heure']) AND !empty($_POST['date']) AND !empty($_POST['coach']) AND !empty($_POST['controller']) AND !empty($_POST['montant']) AND !empty($_POST['motif'])){
                  $sql="INSERT INTO `BonusEtPrime`(`idb`, `IdCodeVp`, `date`, `heure`, `motif`, `montant`) VALUES (?,?,?,?,?,?)";
                  $resultat=$main->query($sql,array(NULL,$_POST['coach'],$_POST['date'],$_POST['heure'],$_POST['motif'],$_POST['montant']));
                   echo 'Le coach '.$_POST['coach'].' a été bonifié'.'&nbsp;&nbsp;<i class="fa fa-check text-success" aria-hidden="true"></i>
';
           }else{
               echo 'Veuillez complétez tous les champs.&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
           }
       }else{
           echo 'Erreur insertion';
       }
?>