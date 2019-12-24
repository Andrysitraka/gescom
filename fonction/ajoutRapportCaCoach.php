<?php
    include_once('../include/include.php');
    date_default_timezone_set("Europe/Moscow");
    if(isset($_POST['ca']) AND isset($_POST['commercial']) AND !empty($_POST['commercial']) AND isset($_POST['heure']) AND !empty($_POST['heure'])){
        
        $sql_produit="SELECT vente.id_rcc FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
        $vente=$main->query($sql_produit,array($_POST['commercial'],'vente d\'accompagnement',date('Y-m-d')));
        
       /* $sql_ca_coach="SELECT `ca` FROM `RapportCaCoach` WHERE `idrcc` = ?";
        $ca_rapport=$main->query($sql_ca_coach,array($vente['id_rcc']));*/
        if($vente){
            $heure = new DateTime($_POST['heure']);
            if($heure>new DateTime('11:30:00') && $heure<new DateTime('12:30:00')){
                $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 1 AND `idvp` LIKE ?";
                $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$_POST['commercial']));
                if($rapport_matin['cpt']<1){
                    $sql="INSERT INTO `RapportCaCoach`(`idrcc`, `ca`,`idcotn`,`idvp`,`date_rapport`,`numero_rapport`) VALUES (?,?,?,?,?,?)";
                    $main->query($sql,array(NULL,$_POST['ca'],$_SESSION['matricule'],$_POST['commercial'],date('Y-m-d'),1));
                    //Ajout de l'id ca du coach rapport
                    $sql_id="SELECT `idrcc` FROM `RapportCaCoach` WHERE 1 ORDER BY `idrcc` DESC LIMIT 1";
                    $id_rcc=$main->query($sql_id);
                    
                    $sql_produit="SELECT vente.idVente FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
                    $vente=$main->queryAll($sql_produit,array($_POST['commercial'],'vente d\'accompagnement',date('Y-m-d')));
                    if($vente){
                        foreach($vente as $vente){
                             $main->upDateRapport(array($id_rcc['idrcc'],$vente['idVente']));
                        }   
                        echo number_format($_POST['ca'],2,',',' ');
                    }else{
                        echo 'Pas de produit vendu';
                    }
                    
                    echo number_format($_POST['ca'],2,',',' ');
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 2'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else if($heure>new DateTime('16:00:00') && $heure<new DateTime('17:00:00')){
                $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 2 AND `idvp` LIKE ?";
                $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$_POST['commercial']));
                if($rapport_matin['cpt']<1){
                    $sql="INSERT INTO `RapportCaCoach`(`idrcc`, `ca`,`idcotn`,`idvp`,`date_rapport`,`numero_rapport`) VALUES (?,?,?,?,?,?)";
                    $main->query($sql,array(NULL,$_POST['ca'],$_SESSION['matricule'],$_POST['commercial'],date('Y-m-d'),2));
                    //Ajout de l'id ca du coach rapport
                    $sql_id="SELECT `idrcc` FROM `RapportCaCoach` WHERE 1 ORDER BY `idrcc` DESC LIMIT 1";
                    $id_rcc=$main->query($sql_id);
                    
                    $sql_produit="SELECT vente.idVente FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
                    $vente=$main->queryAll($sql_produit,array($_POST['commercial'],'vente d\'accompagnement',date('Y-m-d')));
                    if($vente){
                        foreach($vente as $vente){
                             $main->upDateRapport(array($id_rcc['idrcc'],$vente['idVente']));
                        }   
                        echo number_format($_POST['ca'],2,',',' ');
                    }else{
                        echo 'Pas de produit vendu';
                    }
                    
                    echo number_format($_POST['ca'],2,',',' ');
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 2'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else{
                echo 'Vous n\'avez pas l\'autorisation d\'ajouté un rapport à cette heure '.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
            }
            
            /*if($ca_rapport){//existe ca rapport coach alors on doit juste modifier
                $sql="UPDATE `RapportCaCoach` SET `ca`= ? WHERE `idrcc`= ?";
                $main->query($sql,array($_POST['ca'],$vente['id_rcc']));
                echo number_format($_POST['ca'],2,',',' ');
            }else{//pas de ca rapport et il faut ajouté
                $sql="INSERT INTO `RapportCaCoach`(`idrcc`, `ca`) VALUES (?,?)";
                $main->query($sql,array(NULL,$_POST['ca']));
                //Ajout de l'id ca du coach rapport
                $sql_id="SELECT `idrcc` FROM `RapportCaCoach` WHERE 1 ORDER BY `idrcc` DESC LIMIT 1";
                $id_rcc=$main->query($sql_id);
                
                $sql_produit="SELECT vente.idVente FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
                $vente=$main->queryAll($sql_produit,array($_POST['commercial'],'vente d\'accompagnement',date('Y-m-d')));
            
                if($vente){
                    foreach($vente as $vente){
                         $main->upDateRapport(array($id_rcc['idrcc'],$vente['idVente']));
                    }   
                    echo number_format($_POST['ca'],2,',',' ');
                }else{
                    echo 'Pas de produit vendu';
                }
            }*/
        }else{ //insertion rapport sans vente
            
            $heure = new DateTime($_POST['heure']);
            if($heure>new DateTime('11:30:00') && $heure<new DateTime('12:30:00')){
                $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 1 AND `idvp` LIKE ?";
                $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$_POST['commercial']));
                if($rapport_matin['cpt']<1){
                    $sql="INSERT INTO `RapportCaCoach`(`idrcc`, `ca`,`idcotn`,`idvp`,`date_rapport`,`numero_rapport`) VALUES (?,?,?,?,?,?)";
                    $main->query($sql,array(NULL,$_POST['ca'],$_SESSION['matricule'],$_POST['commercial'],date('Y-m-d'),1));
                    echo number_format($_POST['ca'],2,',',' ');
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 1'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else if($heure>new DateTime('16:00:00') && $heure<new DateTime('17:00:00')){
                $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 2 AND `idvp` LIKE ?";
                $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$_POST['commercial']));
                if($rapport_matin['cpt']<1){
                    $sql="INSERT INTO `RapportCaCoach`(`idrcc`, `ca`,`idcotn`,`idvp`,`date_rapport`,`numero_rapport`) VALUES (?,?,?,?,?,?)";
                    $main->query($sql,array(NULL,$_POST['ca'],$_SESSION['matricule'],$_POST['commercial'],date('Y-m-d'),2));
                    echo number_format($_POST['ca'],2,',',' ');
                }else{
                    echo 'Vous avez déjà enregistré le rapport numéro 2'.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
                }
            }else{
                echo 'Vous n\'avez pas l\'autorisation d\'ajouté un rapport à cette heure '.'&nbsp;&nbsp;<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>';
            }
            
        }
       
    }else{
        echo 'Champ vide';
    }