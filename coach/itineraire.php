<?php 
$titre = "rapport de vente journalière";
include_once('header.php');
$titre = "Mes points";
include_once('../include/include.php');
date_default_timezone_set("Europe/Moscow");
$date = new DateTime();
$dt = $date->format('Y-m-d');

//TEST DE VENTE DES COMMERCIAUX
$activite_contraire='vente d\'accompagnement';
//afficher le nbr de vente à part vente d'accompagnement
$sql_coach="SELECT `matricule` FROM `personnel` WHERE `coach` LIKE ?";
$mes_commerciaux=$main->queryAll($sql_coach,array($_SESSION['matricule']));

$test=false; // 0 enregistrement
foreach($mes_commerciaux as $mes_commerciaux){
    //$sql="SELECT COUNT(vente.idVP) as compte FROM `vente`,historique_personnel WHERE `idVP` LIKE ? AND id_historique_coach = historique_personnel.id AND historique_personnel.activite != ? AND vente.date LIKE ?";
    $sql="SELECT COUNT(`idPrix`) as compte FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $nbr_vente=$main->query($sql,array($mes_commerciaux['matricule'],$dt));    
    ($nbr_vente['compte']!=0)?$test=true:$test=false;
}
//FIN TEST COMMERCIAUX

//TEST CA JOUNALIERE ATTEINT
$total_ca=0;
$sql_coach="SELECT `matricule` FROM `personnel` WHERE `coach` LIKE ?";
$mes_commerciaux=$main->queryAll($sql_coach,array($_SESSION['matricule']));
foreach($mes_commerciaux as $mes_commerciaux){
    $sql_ca1="SELECT `idPrix`,`quantite` FROM `vente` WHERE `idVP` LIKE ? AND `date` LIKE ?";
    $vente=$main->queryAll($sql_ca1,array($mes_commerciaux['matricule'],$dt));  
    foreach($vente as $vente){
        $sql_prix="SELECT `prixdetail` FROM `prix` WHERE `idPrix` = ?";
        $caa=$main->query($sql_prix,array($vente['idPrix']));
        $total_ca+=($caa['prixdetail']*$vente['quantite']);  
    }
    
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
          
           
           <div class="row" style="padding:10px 10px;">
               <div class="col-md-6 col-sm-6 col-6" style="padding:5px 5px"  data-toggle="modal" data-target="#exampleModal">
                    <div class="bloc_rapport" style="min-height:50px;background:#fff;border-radius:5px;padding:10px 10px;font-size:16px">
                       <i class="fa fa-edit"></i>
                       <h2>Rapport journalière </h2>
                       
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
            
            <div class="form-row" style="padding-bottom:7px">
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
            <div class="form-row" style="padding-bottom:7px">
                <div class="col-12">
                    <input class="form-control ora" type="text" disabled placeholder="<?=$date->format('H:i:s');?>">
                </div>
            </div>
            
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