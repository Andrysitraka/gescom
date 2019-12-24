<?php 
$titre = "rapport de vente journalière";
include_once('header.php');
$titre = "Mes points";
include_once('../include/include.php');
date_default_timezone_set("Europe/Moscow");
$date = new DateTime();
$dt = $date->format('Y-m-d');
$ht = $date->format('H:i:s');

//TEST DE VENTE DES COMMERCIAUX
$activite_contraire='vente d\'accompagnement';
//afficher le nbr de vente à part vente d'accompagnement
$sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
$mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
$test=false; // 0 enregistrement
 $sql="SELECT COUNT(`idPrix`) as compte FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $nbr_vente=$main->query($sql,array($mes_commerciaux['com_1'],$dt));    
    if($nbr_vente['compte']!=0){
        $test=true;
    }else{
        $test=false;
    }
    $sql="SELECT COUNT(`idPrix`) as compte FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $nbr_vente=$main->query($sql,array($mes_commerciaux['com_2'],$dt));    
    if($nbr_vente['compte']!=0 && $test==true){
        $test=true;
    }else{
        $test=false;
    }
//FIN TEST COMMERCIAUX

//TEST CA JOUNALIERE ATTEINT
$total_ca=0;
$sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
$mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));

    $sql_ca1="SELECT `idPrix`,`quantite` FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $vente=$main->queryAll($sql_ca1,array($mes_commerciaux['com_1'],$dt));  
    foreach($vente as $vente){
        $sql_prix="SELECT `prixdetail` FROM `prix` WHERE `idPrix` = ?";
        $caa=$main->query($sql_prix,array($vente['idPrix']));
        $total_ca+=($caa['prixdetail']*$vente['quantite']);  
    }
    $sql_ca1="SELECT `idPrix`,`quantite` FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $vente=$main->queryAll($sql_ca1,array($mes_commerciaux['com_2'],$dt));  
    foreach($vente as $vente){
        $sql_prix="SELECT `prixdetail` FROM `prix` WHERE `idPrix` = ?";
        $caa=$main->query($sql_prix,array($vente['idPrix']));
        $total_ca+=($caa['prixdetail']*$vente['quantite']);  
    }

//FIN TEST CA 

//TEST RAPPORT 
$sql="SELECT COUNT(`idr`) as cp FROM `rapport` WHERE `id_coach` LIKE ? AND `date` LIKE ? AND `type` LIKE ?";
$rapport=$main->query($sql,array($_SESSION['matricule'],$dt,'rapport de vente'));
//FIN TEST RAPPORT

?>
<style>
    h2{
        font-size:14px!important;
    }
   .bloc_rapport > i{
        font-size:24px!important;
        color:#0277bd;
    }
</style>

 <div class="content-wrapper">
    <div class="content-corp">
        <div class="container-fluid">
           <div class="row" style="padding:10px 10px">
                
               <div class="col-md-12" style="height:200px;background:#673ab7;border-radius:5px;padding-top:5px">
                   <button type="button" class="btn btn-warning pull-right">
                      Jour du <span class="badge badge-light"> <?php formatdt($dt);?></span>
                      <span class="sr-only"> </span>
                    </button>
                    <br>
                     <br>
                <?php if($rapport['cp']==2){ ?>
                    <span class="badge badge-success">Merci ! Vous avez envoyer votre rapport</span><br>
                <?php }else{ ?>
                    <span class="badge badge-danger">Vous n'avez pas encore envoyer votre rapport</span><br>
                <?php } ?>
                <?php if($test){ ?>
                    <span class="badge badge-success">Tous les commerciaux ont enregistrés une vente</span><br>
                <?php }else{ ?>
                    <span class="badge badge-warning">Vous avez des commerciaux avec 0 enregistrement</span><br>
                <?php 
                    }
                    if($total_ca>100000){ // 100.000 Ar C.A A ATTEINDRE
                ?>
                    <span class="badge badge-success">Félicitation ! Votre C A journalière est atteint</span>
                <?php }else{ ?>
                    <span class="badge badge-danger">Votre C A journalière n'est pas encore atteint</span>
                <?php } ?>
               </div>
           </div>
           
           <div class="row" style="padding:10px 10px;margin-top:-50px">
               <div class="col-md-6 col-sm-6 col-6" style="padding:5px 5px"  data-toggle="modal" data-target="#exampleModal">
                    <div class="bloc_rapport" style="min-height:50px;background:#fff;border-radius:5px;padding:10px 10px;font-size:16px">
                       <i class="fa fa-edit"></i>
                       <h2>Rediger Mon Rapport</h2>
                       
                    </div>
                    <div style="height:20px;background:#0277bd;width:100%"></div>
               </div>
               <div class="col-md-6 col-sm-6 col-6 redirect_rapport" style="padding:5px 5px;">
                    <div class="bloc_rapport" style="min-height:50px;background:#fff;border-radius:5px;padding:10px 10px">
                         <i class="fa fa-list"></i>
                       <h2>Consulter Mes Rapports</h2> 
                    </div>
                    <div style="height:20px;background:#0277bd;width:100%"></div>
               </div>
      
           </div>
           
           <div class="row" style="padding:10px 10px;">
                <div class="col-md-12">
                    <span class="pull-left" style="font-size:12px">Rapport n° 1</span>
                    <span class="pull-right" style="font-size:12px">Heure : <span class="ora" style="font-size:12px"></span></span>
                </div>
                <div class="col-md-12 mt-2 table-responsive">
                    <table class="table table-bordered " style="font-size:13px;margin-top:5px; ">
                       <thead>
                          
                           <tr>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:15%">Com</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:25%">Aperçu C.A com</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:25%">Aperçu C.A coach</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:30%">Action</td>
                            </tr>
                           
                       </thead>
                       <tbody>
                            <?php 
                            $sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
                            $mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
                            
                            $total_ca_com=0;
                            $total_ca_coach=0;
                            if($mes_commerciaux){
                                $commercial=$mes_commerciaux['com_1'];
                                for($j=0;$j<=2;$j++):
                                    $sql_produit="SELECT vente.id_rcc FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
                                    $vente=$main->query($sql_produit,array($commercial,'vente d\'accompagnement',$dt));
                                    $sql_ca_coach="SELECT `ca` FROM `RapportCaCoach` WHERE `idrcc` = ? AND `numero_rapport` = ?";
                                    $ca_rapport=$main->query($sql_ca_coach,array($vente['id_rcc'],1));
                                    
                                    $sql_="SELECT `ca` FROM `RapportCaCoach` WHERE `idcotn` LIKE ? AND `idvp` LIKE ? AND `date_rapport` LIKE ? AND `numero_rapport` LIKE ?";
                                    $ca_rap=$main->query($sql_,array($_SESSION['matricule'],$commercial,date('Y-m-d'),1));
                                    
                                    if($ca_rapport || $ca_rap){ // rapport
                                        
                            ?>
                                          
                                        <tr>
                                            <?php 
                                                $total_ca_com+= $main->ca_du_com_heure($commercial,$dt,'08:00:00','12:30:00');
                                                $total_ca_coach+= (int)($ca_rapport)?$ca_rapport['ca']:$ca_rap['ca'];
                                            ?>
                                            <td class="text-center com" style="font-size:11px;"><?=$commercial?></td>
                                            <td class="text-center colsp ca_com" style="font-size:11px;"><?=number_format($main->ca_du_com_heure($commercial,$dt,'08:00:00','12:30:00'),2,',',' ')?></td>
                                            <td class="text-center existe_ok ca_coach" style="font-size:11px;"><?= ($ca_rapport)?number_format($ca_rapport['ca'],2,',',' '):number_format($ca_rap['ca'],2,',',' ');?></td>
                                            <td class="text-center" style="font-size:11px;">
                                                <span class="d-none"></span>
                                                <button type="button" class="btn btn-success btn-xs lock_ok ok_ca" style="margin-left:-10px;width:35px">ok</button>
                                            <?php 
                                                $heure = new DateTime($ht);
                                                if($heure>new DateTime('11:30:00') && $heure<new DateTime('12:30:00')){
                                                    $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 1 AND `idvp` LIKE ?";
                                                    $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$commercial));
                                                    if($rapport_matin['cpt']<1){ ?>
                                                        <button type="button" class="btn btn-danger btn-xs lock_no no_ca" style="margin-right:-10px;width:35px">non</button>
                                                  <?php }else{ ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_after" style="margin-right:-10px;width:35px"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                                 <?php }
                                                }else if($heure>new DateTime('16:00:00') && $heure<new DateTime('17:00:00')){
                                                    $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 2 AND `idvp` LIKE ?";
                                                    $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$commercial));
                                                    if($rapport_matin['cpt']<1){ ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_no no_ca" style="margin-right:-10px;width:35px">non</button>
                                                <?php    }else{
                                            ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_after" style="margin-right:-10px;width:35px"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                            <?php } }else{ ?>
                                                    <button type="button" class="btn btn-danger btn-xs lock_no no_ca" style="margin-right:-10px;width:35px">non</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    
                                <?php }else{ //Pas de rapport du jour ?>
                                        <?php 
                                            $total_ca_com+= $main->ca_du_com_heure($commercial,$dt,'08:00:00','12:30:00'); 
                                            $total_ca_coach+= $main->ca_du_com_heure($commercial,$dt,'08:00:00','12:30:00'); 
                                        ?>        
                                        <tr>
                                            <td class="text-center com" style="font-size:11px;"><?=$commercial?></td>
                                            <td class="text-center colsp ca_coach ca_com" colspan="2" style="font-size:11px;"><?=number_format($main->ca_du_com_heure($commercial,$dt,'08:00:00','12:30:00'),2,',',' ')?></td>
                                            <td class="text-center" style="font-size:11px;">
                                                <span class="d-none"></span>
                                                <button type="button" class="btn btn-success btn-xs lock_ok ok_ca" style="margin-left:-10px;width:35px">ok</button>
                                                <button type="button" class="btn btn-danger btn-xs lock_no no_ca" style="margin-right:-10px;width:35px">non</button>
                                            </td>
                                        </tr>
                                
                                
                                <?php } $commercial=$mes_commerciaux['com_2']; $j++; endfor; }else{ ?>
                                        <tr>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                        </tr>
                            <?php }  ?>
                          
                        </tbody>
                        <tfoot>
                            <tr class="<?=($total_ca_com==$total_ca_coach)?'bg-success':'bg-danger'?>">
                                <td class="text-center" style="font-weight:bold;font-size:10px;">Total : </td>
                                <td class="text-center totalcacom" style="font-weight:bold;font-size:10px;"><?=number_format($total_ca_com,2,',',' ')?></td>
                                <td class="text-center totalcacoach" style="font-weight:bold;font-size:10px;"><?=number_format($total_ca_coach,2,',',' ')?></td>
                                <td class="text-center" style="color:white;font-weight:bold;font-size:10px;"><?=($total_ca_com==$total_ca_coach)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-warning" aria-hidden="true"></i>'?></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
           </div>
           
           <div class="row" style="padding:10px 10px;">
                <div class="col-md-12">
                    <span class="pull-left" style="font-size:12px">Rapport n° 2</span>
                    <span class="pull-right" style="font-size:12px">Heure : <span class="ora" style="font-size:12px"></span></span>
                </div>
                <div class="col-md-12 mt-2 table-responsive">
                    <table class="table table-bordered " style="font-size:13px;margin-top:5px; ">
                       <thead>
                          
                           <tr>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:15%">Com</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:25%">Aperçu C.A com</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:25%">Aperçu C.A coach</td>
                                <td class="text-center" style="font-weight:bold;font-size:11px;width:30%">Action</td>
                            </tr>
                           
                       </thead>
                       <tbody>
                            <?php 
                            $sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
                            $mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
                            
                            $total_ca_com=0;
                            $total_ca_coach=0;
                            if($mes_commerciaux){
                                $commercial=$mes_commerciaux['com_1'];
                                for($j=0;$j<=2;$j++):
                                    $sql_produit="SELECT vente.id_rcc FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
                                    $vente=$main->query($sql_produit,array($commercial,'vente d\'accompagnement',$dt));
                                    
                                        $sql_ca_coach="SELECT `ca` FROM `RapportCaCoach` WHERE `idrcc` = ? AND `numero_rapport` = ?";
                                  
                                        $ca_rapport=$main->query($sql_ca_coach,array($vente['id_rcc'],2));
                                        
                                        $sql_="SELECT `ca` FROM `RapportCaCoach` WHERE `idcotn` LIKE ? AND `idvp` LIKE ? AND `date_rapport` LIKE ? AND `numero_rapport` LIKE ?";
                                        $ca_rap=$main->query($sql_,array($_SESSION['matricule'],$commercial,date('Y-m-d'),2));//rapport 2'];

                                    if($ca_rapport || $ca_rap){ // rapport
                                        
                            ?>
                                          
                                        <tr>
                                            <?php 
                                                $total_ca_com+= $main->ca_jour_com($commercial,$dt);
                                                $total_ca_coach+= (int)($ca_rapport)?$ca_rapport['ca']:$ca_rap['ca'];
                                            ?>
                                            <td class="text-center com" style="font-size:11px;"><?=$commercial?></td>
                                            <td class="text-center colsp ca_com" style="font-size:11px;"><?=number_format($main->ca_jour_com($commercial,$dt),2,',',' ')?></td>
                                            <td class="text-center existe_ok ca_coach" style="font-size:11px;"><?= ($ca_rapport)?number_format($ca_rapport['ca'],2,',',' '):number_format($ca_rap['ca'],2,',',' ');?></td>
                                            <td class="text-center" style="font-size:11px;">
                                                <span class="d-none"></span>
                                                <button type="button" class="btn btn-success btn-xs lock_ok ok_ca" style="margin-left:-10px;width:35px">ok</button>
                                            <?php 
                                                $heure = new DateTime($ht);
                                                if($heure>new DateTime('11:30:00') && $heure<new DateTime('12:30:00')){
                                                    $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 1 AND `idvp` LIKE ?";
                                                    $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$commercial));
                                                    if($rapport_matin['cpt']<1){ ?>
                                                        <button type="button" class="btn btn-danger btn-xs lock_no no_ca lock" style="margin-right:-10px;width:35px">non</button>
                                                  <?php }else{ ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_after" style="margin-right:-10px;width:35px"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                                 <?php }
                                                }else if($heure>new DateTime('16:00:00') && $heure<new DateTime('17:00:00')){
                                                    $sql_test_rapport="SELECT COUNT(`idrcc`) as cpt FROM `RapportCaCoach` WHERE `date_rapport` LIKE ? AND `numero_rapport` = 2 AND `idvp` LIKE ?";
                                                    $rapport_matin=$main->query($sql_test_rapport,array(date('Y-m-d'),$commercial));
                                                    if($rapport_matin['cpt']<1){ ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_no no_ca lock" style="margin-right:-10px;width:35px">non</button>
                                                <?php    }else{
                                            ?>
                                                      <button type="button" class="btn btn-danger btn-xs lock_after" style="margin-right:-10px;width:35px"><i class="fa fa-lock" aria-hidden="true"></i></button>
                                            <?php } }else{ ?>
                                                    <button type="button" class="btn btn-danger btn-xs lock_no no_ca" style="margin-right:-10px;width:35px">non</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    
                                <?php }else{ //Pas de rapport du jour ?>
                                        <?php 
                                            $total_ca_com+= $main->ca_jour_com($commercial,$dt); 
                                            $total_ca_coach+= $main->ca_jour_com($commercial,$dt); 
                                        ?>        
                                        <tr>
                                            <td class="text-center com" style="font-size:11px;"><?=$commercial?></td>
                                            <td class="text-center colsp ca_coach ca_com" colspan="2" style="font-size:11px;"><?=number_format($main->ca_jour_com($commercial,$dt),2,',',' ')?></td>
                                            <td class="text-center" style="font-size:11px;">
                                                <span class="d-none"></span>
                                                <button type="button" class="btn btn-success btn-xs lock_ok ok_ca" style="margin-left:-10px;width:35px">ok</button>
                                                <button type="button" class="btn btn-danger btn-xs lock_no no_ca lock" style="margin-right:-10px;width:35px">non</button>
                                            </td>
                                        </tr>
                                
                                
                                <?php } $commercial=$mes_commerciaux['com_2']; $j++; endfor; }else{ ?>
                                        <tr>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                            <td class="text-center" style="font-size:11px;">-</td>
                                        </tr>
                            <?php }  ?>
                          
                        </tbody>
                        <tfoot>
                            <tr class="<?=($total_ca_com==$total_ca_coach)?'bg-success':'bg-danger'?>">
                                <td class="text-center" style="font-weight:bold;font-size:10px;">Total : </td>
                                <td class="text-center totalcacom" style="font-weight:bold;font-size:10px;"><?=number_format($total_ca_com,2,',',' ')?></td>
                                <td class="text-center totalcacoach" style="font-weight:bold;font-size:10px;"><?=number_format($total_ca_coach,2,',',' ')?></td>
                                <td class="text-center" style="color:white;font-weight:bold;font-size:10px;"><?=($total_ca_com==$total_ca_coach)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-warning" aria-hidden="true"></i>'?></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
           </div>
           
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Rapport de vente du <?php formatdt($dt);?> </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-row" style="padding-bottom:7px">
                <div class="col-12">
                    <span class="num_rapport text-danger" font-size:12px;>Rapport</span>
                </div>
            </div>
            
           <!-- <div class="form-row" style="padding-bottom:7px">
                <div class="col-12">
                    <input class="form-control" type="text" disabled placeholder="Aperçu C.A du jour : <?=number_format($total_ca,2,',',' ').' Ar'?>">
                </div>
            </div>
            
            <!--<div class="form-row" style="padding-bottom:7px">
                <div class="col-6">
                    <input class="form-control tps_rap" type="time" disabled value="13:45:00">
                </div>
                <div class="col-6">
                    <input type="date" class="form-control date_rap" disabled name="date">
                </div>
            </div>-->
         <!--   <div class="form-row" style="padding-bottom:7px">
                <div class="col-12">
                    <input class="form-control ora" type="text" disabled placeholder="">
                </div>
            </div>-->
            
            <div class="form-row">
                   <div class="col-12">
                       <textarea  class="form-control desc_rap" placeholder="Déscription du rapport" rows="5"></textarea> 
                   </div>
            
            </div>
        </form>
        <br>
      </div>
      <div class="modal-footer">
         <button type="reset" class="btn btn-danger reset_modal" data-dismiss="modal">Annulez</button>
        <button type="button" class="btn btn-success save_rapport" style="margin-top:2px" data-dismiss="modal">Enregistrez</button>
        
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php');?>