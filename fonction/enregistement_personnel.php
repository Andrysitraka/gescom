<?php
include_once("../include/include.php");
echo 'test';
/*if(isset($_POST['Matricule']) AND  isset($_POST['date_d_embauche']) AND isset($_POST['Nom']) AND isset($_POST['Prenom']) AND isset($_POST['date_de_naissance']) AND isset($_POST['lieu_de_naissance']) AND isset($_POST['situation_Matrimoniale']) AND isset($_POST['nombre_d_enfant']) AND isset($_POST['sexe']) AND isset($_POST['CIN_COM']) AND isset($_POST['Date_CIN_COM']) AND isset($_POST['Fait_a_COM']) AND isset($_POST['Duplicata_du_com']) AND isset($_POST['Lieu_de_Duplicatat_COM']) AND isset($_POST['Adresse']) AND isset($_POST['Contact']) AND isset($_POST['Contact_flotte']) AND isset($_POST['personne_a_contacter']) AND isset($_POST['Lien_de_Parente']) AND isset($_POST['Contact_Telephonique']) AND isset($_POST['Adresse_paret']) AND isset($_POST['Numero_CIN_personne_a_contacter']) AND isset($_POST['Date_de_son_CIN']) AND isset($_POST['Lieu_d_enregistrementPr']) AND isset($_POST['Duplicata_du_pr']) AND isset($_POST['Lieu_de_duplicatat_pr']) AND isset($_POST['Fonction_a_l_embauche']) AND isset($_POST['Fonction_Acutelle']) AND isset($_POST['Mode_de_Paymemnt_salaire']) AND isset($_POST['numero_de_compte']) AND isset($_POST['Statut'])){
   if(!empty($_POST['Matricule']) AND  !empty($_POST['date_d_embauche']) AND !empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['date_de_naissance']) AND !empty($_POST['lieu_de_naissance']) AND !empty($_POST['situation_Matrimoniale']) AND !empty($_POST['nombre_d_enfant']) AND !empty($_POST['sexe']) AND !empty($_POST['CIN_COM']) AND !empty($_POST['Date_CIN_COM']) AND !empty($_POST['Fait_a_COM']) AND !empty($_POST['Duplicata_du_COM']) AND !empty($_POST['Lieu_de_Duplicatat_COM']) AND !empty($_POST['Adresse']) AND !empty($_POST['Contact']) AND !empty($_POST['Contact_flotte']) AND !empty($_POST['personne_a_contacter']) AND !empty($_POST['Lien_de_Parente']) AND !empty($_POST['Contact_Telephonique']) AND !empty($_POST['Adresse_paret']) AND !empty($_POST['Numero_CIN_personne_a_contacter']) AND !empty($_POST['Date_de_son_CIN']) AND !empty($_POST['Lieu_d_enregistrementPr']) AND !empty($_POST['Duplicata_du_pr']) AND !empty($_POST['Lieu_de_duplicatat_pr']) AND !empty($_POST['Fonction_a_l_embauche']) AND !empty($_POST['Fonction_Acutelle']) AND !empty($_POST['Mode_de_Paymemnt_salaire']) AND !empty($_POST['numero_de_compte']) AND !empty($_POST['tatut'])){
       $sql="INSERT INTO `personnel`(`id`, `matricule`, `date_d_embauche`, `Nom`, `Prenom`, `date_de_naissance`, `lieu_de_naissance`, `situation_Matrimoniale`, `nombre_d_enfant`, `sexe`, `CIN_COM`, `Date_CIN_COM`, `Fait_a_COM`, `Duplicata_du_COM`, `Lieu_de_Duplicatat_COM`, `Adresse`, `Contact`, `Contact_flotte`, `personne_a_contacter`, `Mode_de_Paymemnt_salaire`, `Contact_Telephonique`, `Adresse_paret`, `Numero_CIN_personne_a_contacter`, `Date_de_son_CIN`, `Lieu_d_enregistrementPr`, `Duplicata_du_CIN_pr`, `Lieu_de_duplicatat_pr`, `Fonction_a_l_embauche`, `Fonction_Acutelle`, `Lien_de_Parente`, `numero_de_compte`, `Statut`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
       $main->query($sql,array(null,$_POST['Matricule'],$_POST['date_d_embauche'],$_POST['Nom'],$_POST['Prenom'],$_POST['date_de_naissance'],$_POST['lieu_de_naissance'],$_POST['situation_Matrimoniale'],$_POST['nombre_d_enfant'],$_POST['sexe'],$_POST['CIN_COM'],$_POST['Date_CIN_COM'],$_POST['Fait_a_COM'],$_POST['Duplicata_du_COM'],$_POST['Lieu_de_Duplicatat_COM'],$_POST['Adresse'],$_POST['Contact'],$_POST['Contact_flotte'],$_POST['personne_a_contacter'],$_POST['Lien_de_Parente'],$_POST['Contact_Telephonique'],$_POST['Adresse_paret'],$_POST['Numero_CIN_personne_a_contacter'],$_POST['Date_de_son_CIN'],$_POST['Lieu_d_enregistrementPr'],$_POST['Duplicata_du_CIN_pr'],$_POST['Lieu_de_duplicatat_pr'],$_POST['Fonction_a_l_embauche'],$_POST['Fonction_Acutelle'],$_POST['Mode_de_Paymemnt_salaire'],$_POST['numero_de_compte'],$_POST['Statut']));
   }

}*/
?>