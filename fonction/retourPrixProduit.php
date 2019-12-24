<?php
    include_once('../include/include.php');
    $sql="SELECT mission.lieu,prix.prixdetail,prix.prixgros,prix.dateOn FROM `prix`,mission WHERE mission.idMission = prix.idMission AND prix.idProduit LIKE ? AND prix.statut LIKE 'on'";
    $prix_produit=$main->queryAll($sql,array($_POST['produit']));//prix de ();chaque mission du produit acti
   
?>
        <div class="row">
         <!-- <div class="col-md-5 col-sm-5 col-12">
             <img src="images/BEV004.png" width="300px" class="img-thumbnail">
          </div>-->

           <div class="col-md-12 col-sm-7 col-12">
            <div class="table-responsive">
        
            <table class="table">
              <thead>
                <tr>
                  
                  <th style="font-weight: bold;">Nom du mission</th>
                  <th style="font-weight: bold;">Date de modification</th>
                  <th style="font-weight: bold;">Prix détails</th>
                  <th style="font-weight: bold;">Prix de gros</th>
                </tr>
              </thead>

              <tbody>
                  <?php foreach($prix_produit as $prix_produit): ?>
                <tr>
                  
                  <td><?=$prix_produit['lieu']?></td>
                  <?php 
                        if($prix_produit['dateOn']=='0000-00-00'){ ?>
                            <td>Pas de date</td>
                   <?php     }else{
                  ?>
                        <td><?=date('d-M-Y',strtotime($prix_produit['dateOn']));?></td>
                  <?php } ?>
                  <td><?=number_format($prix_produit['prixdetail'],2,',',' ')?></td>
                  <td><?=number_format($prix_produit['prixgros'],2,',',' ')?></td>
                 
                </tr>
                    <?php
    endforeach; ?>
              </tbody>
            </table>

            </div>
          </div>
        </div>