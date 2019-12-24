<?php 
$titre = "Detail Panier";

include_once('../include/include.php');

include "header.php";

$contentProduit=scandir("../image/produit");
if(isset($_GET['designation']) and !empty($_GET['designation'])){
    
    $sql_planing ="SELECT DISTINCT `idEquipe` FROM `planing` WHERE `Panier` like ?";
    $planing=$main->queryAll($sql_planing,array($_GET['designation']));
    
    $sql_panier="SELECT `IdProduit`,`status` FROM `panier` WHERE `desigbation` LIKE ?";
    $idProduit =$main->queryAll($sql_panier,array($_GET['designation']));
    
    $sql_produit_affecte="SELECT COUNT(*) as compte FROM `panier` WHERE `desigbation` LIKE ?";
    $compte=$main->queryAll($sql_produit_affecte,array($_GET['designation']));
    
    $sql_equipe="SELECT COUNT(DISTINCT(`IdEquipe`)) as compte FROM `planing` WHERE `Panier` LIKE 'Ptes'";
    $equipe = $main->queryAll($sql_equipe,array($_GET['designation']));
}

//MISSION
$sql="SELECT `nom_mission` FROM `ma_mission` WHERE `id_coach` LIKE ? AND `statut_mission` LIKE 'En_cours'"; 
$mission = $main->query($sql,array($_SESSION['matricule']));
//Produit
$sql_produit="SELECT `designation`,`quantite` FROM `produit` WHERE `idProduit` LIKE ?";

?>
<?php
$sql2 ="SELECT * FROM `mes-accompagnement` where id_coach  LIKE ?";
$terrain = $main->queryAll($sql2,array($_SESSION['matricule']));
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
    h3{
        font-size:14px;
    }
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12" style="background:#fff">
              <div  class="table-responsive">
<table class="table" style="font-size:12px; margin-top: 10px;">
  
    <thead style="background:#33b5e5;color:#fff;font-weight:normal!important">
      <tr>
        <th style="width:33%" class="text-left">Date </th>
        <th style="width:33%" class="text-left">Panier  </th>
        <th style="width:33%" class="text-left">Addition  </th>
      </tr>
    <tbody>
                          <?php foreach($terrain as $ter) {
                                $dt= $ter['date_accomp'];
                                $date = new DateTime($dt);
                                if($date->format('d-M-Y')==date('d-M-Y')){
                                    $couleur='bg-success';
                                }else{
                                    $couleur='';
                                }
                          ?>
            <tr class="<?=$couleur?>">
                <td class="text-left pl-2"><?php 
                echo $date->format('d-M-Y');
                ;?></td>
                <td class="text-left pl-3"><a href="info-pannier.php?designation=<?=$ter['panier']?>&date=<?=$date->format('d-M-Y')?>&couleur=0099CC"><?php echo $ter['panier'];?></a></td>
               <td class="text-center" style="color:red;top:2px!importatnt"><button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm" style="font-size:14px;margin-top:1px">New <i class="fa fa-envelope"></i></td>
            </tr>
       <?php } ?>
                           
                          
                         
                          
    </tbody>

 </table>
                </div> 
          </div>
          
         
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Produit additionel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead style="background:red">
                <tr>
                    <th class="text-white">Image</th>
                    <th class="text-white">Code produit</th>
                    <th class="text-white">Prix</th>
                    <th class="text-white">Qtt</th>
                </tr>
            </thead>
            <tbody>
               <tr>
                   <td><img src="../image/produit/PRO016.jpg" width="25px" height="25px" class="thumbnail"/></td>
                    <td  class="align-middle">PRO016</td>
                    <td  class="align-middle">25000 Ar</td>
                    <td  class="align-middle">10</t²d>
               </tr>
               <tr>
                    <td ><img src="../image/produit/PRO015.jpg" width="25px" height="25px" class="thumbnail" /></td>
                    <td  class="align-middle">PRO015</td>
                    <td  class="align-middle"> Ar</td>
                    <td  class="align-middle">10</td>
               </tr>
               
               <tr>
                    <td><img src="../image/produit/PRO006.jpg" width="25px" height="25px" class="thumbnail" /></td>
                    <td  class="align-middle">PRO006</td>
                    <td  class="align-middle">10,600 Ar</td>
                    <td  class="align-middle">10</td>
               </tr>
            </tbody>
        </table>
        
        <hr>
         
         <table class="table infoProduit text-center">
                       <h4 style="font-size:15px">Produit du panier <?php echo $_GET['designation']." - ";echo ($mission)?$mission['nom_mission']:'(*Pas de Mission)'; echo " ".$_GET['date']?></h4>
              <thead style="background:green">
                <tr style="font-size:12px">
                  <th scope="col" style="color:#fff">Code Produit</th>
                  <th scope="col" style="color:#fff">Prix</th>
                  <th scope="col" style="color:#fff">Statut</th>
                </tr>
              </thead>
              <tbody style="font-size:11px">
                    <?php foreach($idProduit as $idProduit): 
                        $produit=$main->query($sql_produit,array($idProduit['IdProduit']));
                    ?>
                  <tr>
                      <td>
                          <?php if(file_exists("../image/produit/".$idProduit['IdProduit'].".jpg")){ ?>
                          <a href="../image/produit/<?= $idProduit['IdProduit'].".jpg";?>" data-lightbox="roadtrip" title="<?=$produit['designation']?>"><?= $idProduit['IdProduit']; ?></a>
                          <?php }else{ ?>
                          <a href="../image/produit/image.jpg" data-lightbox="roadtrip" title="<?=$produit['designation']?>"><?= $idProduit['IdProduit']; ?></a>
                          <?php } ?>
                      </td>
                      <td> 
                            <a href="#">
                                <?php $sql_prix="SELECT * FROM `prix` WHERE `idProduit` LIKE ?"; $prix =$main->query($sql_prix,array($idProduit['IdProduit'])); echo number_format($prix['prixdetail'],0, ',', ' ')." Ar"; ?>
                            </a>
                      </td>
                      <td><?=($idProduit['status']=='Actif')?'<i class="fa fa-lock" align="center" style="color: green " aria-hidden="true"></i>':'<i class="fa fa-lock" align="center" style="color: red " aria-hidden="true"></i>' ?> </td>

                </tr>
                    <?php endforeach; ?>
                
              </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
          
          
        </div><!-- /.row -->
    </div>
    </div>
</div>
<?php include("footer.php");


?>