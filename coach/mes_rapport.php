<?php 
$titre = "Details du rapport";
include "header.php";
include_once('../include/include.php');

$coach=$_SESSION['matricule'];
$sql="SELECT `date`,`heure`,`description`,`ca_journaliere` FROM `rapport` WHERE `id_coach` LIKE ? AND `type` LIKE 'rapport de vente'";
$rapport=$main->queryAll($sql,array($coach));
$total_ca=0;

foreach($rapport as $rapport){
    $total_ca+=$rapport['ca_journaliere'];
}
if(isset($_GET['date']) || !empty($_GET['date'])){
    $dt= new DateTime($_GET['date']);
    $date=$dt->format('Y-m-d');
    $daty=$dt->format('d-M-Y');
}else{
    $date=date('Y-m-d');
    $dt= new DateTime();
    $daty=$dt->format('d-M-Y');
}
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
          <div class="row" style="margin-top:-10px">
              <div class="col-md-12" style="background:#fff;padding:5px 5px">
                  <ol class="breadcrumb" style="font-size:14px!important;padding-left:0px" >
                        <li class="active" style="padding:0px 5px" > <a href="rapport_vente.php" title="Accueil">Rapport de vente journalière</a> &nbsp;&nbsp;> </b> </li>
                        <li style="padding:0px 5px">Détails du rapport</li>
                </ol>
              </div>
          </div>
        <div class="row" style="margin-top:5px">
            <div class="col-md-12" style="background:#fff">
                <span class="pull-right" style="font-size:12px;">Date: <?=$daty?></span>
              <span style="font-size:12px;">Rapport n° 1</span>
              <hr/>   
               
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="font-size:11px;">Commercial</th>
                        <th style="font-size:11px;">Aperçu du commercial</th>
                        <th style="font-size:11px;">Aperçu du coach</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql="SELECT `idvp`,`ca` FROM `RapportCaCoach` WHERE `idcotn` LIKE ? AND `numero_rapport` = 1 AND `date_rapport` LIKE ?";
                            $rapport_matin=$main->queryAll($sql,array($_SESSION['matricule'],$date));
                            if($rapport_matin){
                                foreach($rapport_matin as $rapport_matin):
                        ?>
                      <tr>
                        <td style="font-size:10px;"><?= $rapport_matin['idvp']; ?></td>
                        <td style="font-size:10px;"  class="text-center"><?=number_format($main->ca_du_com_heure($rapport_matin['idvp'],$date,'08:00:00','12:30:00'),2,',',' ').' Ar'?></td>
                        <td style="font-size:10px;"  class="text-center"><?= number_format($rapport_matin['ca'],2,',',' ').' Ar' ?></td>
                      </tr>
                            <?php
                               endforeach; 
                            }else{ ?>
                            
                    <tr>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                      </tr>
                                
                        <?php  }
                            ?>
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12" style="background:#fff">
              <span style="font-size:12px;">Rapport n° 2</span>
              <hr/>   
               
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="font-size:11px;">Commercial</th>
                        <th style="font-size:11px;">Aperçu du commercial</th>
                        <th style="font-size:11px;">Aperçu du coach</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
                            $sql="SELECT `idvp`,`ca` FROM `RapportCaCoach` WHERE `idcotn` LIKE ? AND `numero_rapport` = 2 AND `date_rapport` LIKE ?";
                            $rapport_soir=$main->queryAll($sql,array($_SESSION['matricule'],$date));
                            if($rapport_soir){
                                foreach($rapport_soir as $rapport_soir):
                        ?>
                      <tr>
                        <td style="font-size:10px;"><?= $rapport_soir['idvp']; ?></td>
                        <td style="font-size:10px;"  class="text-center"><?=number_format($main->ca_du_com_heure($rapport_soir['idvp'],$date,'12:31:00','17:00:00'),2,',',' ').' Ar'?></td>
                        <td style="font-size:10px;"  class="text-center"><?= number_format($rapport_soir['ca'],2,',',' ').' Ar' ?></td>
                      </tr>
                            <?php
                               endforeach; 
                            }else{ ?>
                            
                    <tr>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                      </tr>
                                
                        <?php  }
                            ?>
                    </tbody>
                  </table>
            </div>
            <div class="col-md-12" style="background:#fff">
              <span style="font-size:12px;">Vente d'accompagnement</span>
              <hr/>   
               
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="font-size:11px;width:27%" class="text-center">Commercial</th>
                        
                        <th style="font-size:11px;width:40%" class="text-center">Evaluation</th>
                        <th style="font-size:11px;width:33%" class="text-center">CA (*Ar)</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
                            $sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
                            $mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
                            if($mes_commerciaux){
                        ?>
                      <tr>
                        <td style="font-size:10px;"><?= $mes_commerciaux['com_1']; ?></td>
                        
                        <td style="font-size:10px;"  class="text-center"><?=$main_function->moyenne_evaluation($mes_commerciaux['com_1'],$date).' / 5'?></td>
                        <td style="font-size:10px;"  class="text-center"><?=number_format($main->ca_accompagnement($mes_commerciaux['com_1'],$date),2,',',' ').' Ar'?></td>
                      </tr>
                      <tr>
                        <td style="font-size:10px;"><?= $mes_commerciaux['com_2']; ?></td>
                        
                        <td style="font-size:10px;"  class="text-center"><?=$main_function->moyenne_evaluation($mes_commerciaux['com_2'],$date).' / 5'?></td>
                        <td style="font-size:10px;"  class="text-center"><?=number_format($main->ca_accompagnement($mes_commerciaux['com_2'],$date),2,',',' ').' Ar'?></td>
                      </tr>
                            <?php
                            }else{ ?>
                            
                    <tr>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                        <td style="font-size:10px;" class="text-center">-</td>
                      </tr>
                                
                        <?php  }
                            ?>
                    </tbody>
                  </table>
            </div>
        </div>
        <a href="calendrier_rapport.php" style="font-size:15px;padding-bottom:5px">Récaputilatif rapport Mensuel - annexe</a>
        
        
     <!--   
    <div class="row" style="margin-top:5px">
        <div class="col-md-12" style="background:#fff">
            <table class="table table-hover   table-bordered " style="font-size:13px;margin-top:5px; ">
               <thead>
                  
                   <tr>

                        <td class="text-center" style="font-weight:bold">Date/heure</td>
                        <td class="text-center" style="font-weight:bold">heure</td>
                        <td class="text-center" style="font-weight:bold">Déscription</td>
                        <td class="text-center" style="font-weight:bold">Aperçu C.A (*Ar)</td>
                    </tr>
                   
               </thead>
               <tbody>
                        
                        <?php 
                            $rapport=$main->queryAll($sql,array($coach));
                            if($rapport){
                                $test=true;
                                foreach($rapport as $rapport):        
                                    if($test){
                                        $test=false;
                        ?>
                                <tr>
                                    <td class="text-center" rowspan="2" style="font-size:11px;vertical-align:middle"><?=$rapport['date']?></td>
                                    <td class="text-center" style="font-size:11px;"><?=$rapport['heure']?></td>
                                    <td class="text-center" style="font-size:11px;"><?=$rapport['description']?></td>
                                    <td class="text-center" style="font-size:11px;"><?=number_format($rapport['ca_journaliere'],2,',',' ').' Ar'?></td>
                                </tr>
                        <?php }else{ 
                            $test=true;
                        ?>
                                <tr>

                                    <td class="text-center" style="font-size:11px;"><?=$rapport['heure']?></td>
                                    <td class="text-center" style="font-size:11px;"><?=$rapport['description']?></td>
                                    <td class="text-center" style="font-size:11px;"><?=number_format($rapport['ca_journaliere'],2,',',' ').' Ar'?></td>
                                </tr>
                        <?php } endforeach; }else{ ?>
                                <tr>
                                    <td class="text-center" style="font-size:11px;">-</td>
                                    <td class="text-center" style="font-size:11px;">-</td>
                                    <td class="text-center" style="font-size:11px;">-</td>
                                </tr>
                        <?php } ?>
                </tbody>
                <!--<tfoot>
                    <tr>
                        <td class="text-center" style="font-size:11px;font-weight:bold">Total :</td>
                        <td class="text-center" style="font-size:11px;"></td>
                        <td class="text-center" style="font-size:11px;"></td>
                        <td class="text-center" style="font-size:11px;font-weight:bold">
                            <?=number_format($total_ca,2,',',' ').' Ar'?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            
        </div>
         
    </div>-->
  </div>
</div>

  </div>
</div>

  </div>

<?php include "footer.php";?>