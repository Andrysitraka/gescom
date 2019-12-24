<?php
    include_once('../include/include.php');
    date_default_timezone_set("Europe/Moscow");
    if(isset($_POST['heure']) AND isset($_POST['description'])){
        if(!empty($_POST['heure']) AND !empty($_POST['description'])){
            
            //calcul ca jour
            
            $sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
            $mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
            $total_ca=0;
            $total_ca=$main->ca_jour_com($mes_commerciaux['com_1'],date('Y-m-d'))+$main->ca_jour_com($mes_commerciaux['com_2'],date('Y-m-d'));
            
            $type="rapport de vente";
            
            $date = new DateTime();
            $dt = $date->format('Y-m-d');
            
            //PLANING
            $sql_eq="SELECT `designationEquipe` FROM `planing_equipe` WHERE `mtrP` LIKE ? AND `statut` LIKE 'Active'";
            $equipe=$main->query($sql_eq,array($_SESSION['matricule']));
            
            $sql_pl="SELECT `idPL` FROM `planing` WHERE `date` LIKE ? AND `IdEquipe` LIKE ?";
            $planing=$main->query($sql_pl,array(date('Y-m-d'),$equipe['designationEquipe']));
            
            $heure = new DateTime($_POST['heure']);
            if($heure>new DateTime('11:30:00') && $heure<new DateTime('12:30:00')){
                $sql_test_rapport="SELECT COUNT(`idr`) as cpt FROM `rapport` WHERE `id_coach` LIKE ? AND `date` LIKE ? AND `type` LIKE ? AND `heure` BETWEEN ? AND ?";
                $rapport_matin=$main->query($sql_test_rapport,array($_SESSION['matricule'],date('Y-m-d'),$type,'11:30:00','12:30:00'));
                if($rapport_matin['cpt']<1){
                    $sql="INSERT INTO `rapport`(`idr`, `date`, `type` , `heure`, `description`, `ca_journaliere`, `id_coach`,`idpl`) VALUES (?,?,?,?,?,?,?,?)";
                    $main->query($sql,array(null,$dt,'rapport de vente',$_POST['heure'],$_POST['description'],$total_ca,$_SESSION['matricule'],$planing['idPL']));
                    echo 'Rapport numéro 1 ajouté'.'&nbsp;&nbsp;<i class="fa fa-check text-success" aria-hidden="true"></i>';
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 1'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else if($heure>new DateTime('16:00:00') && $heure<new DateTime('17:00:00')){
                $sql_test_rapport="SELECT COUNT(`idr`) as cpt FROM `rapport` WHERE `id_coach` LIKE ? AND `date` LIKE ? AND `type` LIKE ? AND `heure` BETWEEN ? AND ?";
                $rapport_soir=$main->query($sql_test_rapport,array($_SESSION['matricule'],date('Y-m-d'),$type,'16:00:00','17:00:00'));
                if($rapport_soir['cpt']<1){
                    $sql="INSERT INTO `rapport`(`idr`, `date`, `type` , `heure`, `description`, `ca_journaliere`, `id_coach`,`idpl`) VALUES (?,?,?,?,?,?,?,?)";
                    $main->query($sql,array(null,$dt,'rapport de vente',$_POST['heure'],$_POST['description'],$total_ca,$_SESSION['matricule'],$planing['idPL']));
                    echo 'Rapport numéro 2 ajouté'.'&nbsp;&nbsp;<i class="fa fa-check text-success" aria-hidden="true"></i>';
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 2'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else{
                echo 'Vous n\'avez pas l\'autorisation d\'ajouté un rapport à cette heure '.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
            }

        }else{
            echo 'Veuillez complétez tous les champs.&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
        }
    }else{
        echo 'Erreur insertion';
    }