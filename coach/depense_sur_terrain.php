<?php
$titre = "Depense sur Terrain";
include_once("../include/include.php");
include("header.php");
$sql2 ="SELECT * FROM `mes_terrains` where id_coach  LIKE ?";
$terrain = $main->queryAll($sql2,array($_SESSION['matricule']));
$sql="SELECT `id_dep` FROM `depense` WHERE 1 ORDER BY `id_dep` DESC LIMIT 1";
           $id=$main->query($sql);
           if($id){
            if($id['id_dep']<10){
                $num=$id['id_dep']+1;
                $idfactTemp='0000'.$num;
            }else if($id['id_dep']<100){
                 $num=$id['id_dep']+1;
               $idfactTemp='000'.$num ;
            }else if($id['id_dep']<1000){
                 $num=$id['id_dep']+1;
               $idfactTemp='00'.$num; 
            }else if($id['id_dep']<10000){
                 $num=$id['id_dep']+1;
               $idfactTemp='0'.$num; 
            }else{
                 $num=$id['id_dep']+1;
               $idfactTemp=$num; 
            }
           }else{
            $idfactTemp='0000';
           };
           $Fhebergement ='FACT-H-'.$idfactTemp.'-'.date('y-m');
           $Frestauration ='FACT-R-'.$idfactTemp.'-'.date('y-m');
           $Fcarburant ='FACT-C-'.$idfactTemp.'-'.date('y-m');
           $Fautre ='FACT-A-'.$idfactTemp.'-'.date('y-m');
?>
<style>
    td{
        padding:5px!important;
        padding-left:10px;
        font-size:12px!important;
    }
    
    th{
       font-size:14px!important;
       font-weight:normal;
    }
     h2{
        font-size:14px!important;
    }
   .bloc_rapport > i{
        font-size:24px!important;
        color:#0277bd;
    }
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
                <div class="row" style="padding:10px 10px">
               <div class="col-md-12" style="height:80px;background:#42a5f5;border-radius:5px;padding-top:5px">
                   <button type="button" class="btn btn-warning pull-right">
                      Jour du <span class="badge badge-light"> <?php formatdt($dt);?></span>
                      <span class="sr-only"> </span>
                    </button>
                    <br>
                     <br>
                     
              
               </div>
           </div>
        </div>
         <div class="row" style="padding:10px 10px;margin-top:-50px">
               <div class="col-md-6 col-sm-6 col-6 btn-form R" style="padding:5px 5px;cursor:pointer">
                    <div class="bloc_rapport" style="min-height:50px;background:#fff;border-radius:5px;padding:10px 10px;font-size:16px">
                       <i  class="fa fa-edit"></i>
                       <h2>Dépenses du jour</h2>
                       
                    </div>
                    <div style="height:20px;background:#0277bd;width:100%"></div>
               </div>
               <a class="col-md-6 col-sm-6 col-6" href="../coach/historique_depenses.php" style="padding:5px 5px" >
                    <div class="bloc_rapport" style="min-height:50px;background:#fff;border-radius:5px;padding:10px 10px">
                         <i class="fa fa-list"></i>
                       <h2> Mes dépenses</h2> 
                    </div>
                    <div style="height:20px;background:#0277bd;width:100%"></div>
               </a>
           </div>
   
<div class="collapse form-depence">

 <form method="post" enctype="multipart/form-data" style="padding:10px 10px;" action="../fonction/telecharger_photo_facture.php">
            <div class="form-row " style="padding:0px 10px">
                <div class="col-sm-6 col-6"><label for="Heb" style="font-weight: normal;" class="mt-1">Hébergement</label></div>
                <div class="col-sm-6 col-6"><input type="number" id="Heb" class="form-control form-control-sm" required><span style="font-size: 10px;" id="Fact1"></span><b class="Hbmt" hidden><?=$Fhebergement ?></b></div>
            </div>
            <p class="text text-center nom_fic1 im"></p>
            <div class="form-row " style="padding:0px 10px">
                <div class="col-sm-6 col-6"><label for="Rest" style="font-weight: normal;" class="mt-1">Restauration</label></div>
                <div class="col-sm-6 col-6"><input type="number" id="Rest" class=" form-control form-control-sm" required><span style="font-size: 10px;" id="Fact2"></span><b class="Rest" hidden><?=$Frestauration ?></b></div>
             
            </div>
            <p class="text text-center nom_fic2 im"></p>
            <div class="form-row " style="padding:0px 10px">
                <div class="col-sm-6 col-6"><label for="Carb" style="font-weight: normal;" class="mt-1">Carburant</label></div>
                <div class="col-sm-6 col-6"><input type="number" id="Carb" class=" form-control form-control-sm" required><span style="font-size: 10px;" id="Fact3"></span><b class="carb" hidden><?=$Fcarburant ?></b></div>
        
            </div>
            <p class="text text-center nom_fic3 im"></p>
            <div class="form-row " style="padding:0px 10px">
                <div class="col-sm-6 col-6"><label for="Autre" style="font-weight: normal;" class="mt-1">Autre</label></div>
                <div class="col-sm-6 col-6"><input type="number" id="Autre" class=" form-control form-control-sm" required><span style="font-size: 10px;" id="Fact4" ></span><b class="aut" hidden><?=$Fautre ?></b></div>
        
            </div>
             <p class="text text-center nom_fic4 im"></p>
            <div class="form-row" style="padding:0px 10px; margin-top: 0px!important" >
                    <div class="col-sm-12 col-12">
                        <textarea class="form-control form-control-sm description" placeholder="Description . . ."  required></textarea>
                    </div>
                </div>
                <div class="form-row justify-content-end" style="padding:10px 10px; margin-top: 0px!important" >
                        <div style="display: inline-block">
                             <button type="reset" class="btn btn-danger btn-sm annu"  style="font-size: 15px; font-weight: bold;margin-left:0px;height:35px!important; width: 100px;" >Annuler</button>
                             <button type="button" class="btn btn-success btn-sm enregistrer"  style="font-size: 15px; font-weight: bold;margin-left:5px;height:35px!important;width: 100px;">Enregistrer</button>
                        </div>
                   </div>
        </form>
</div>
 </div>

</div>

      </div>
    </div>
  </div>
</div>

<?php include("footer.php");


?>

