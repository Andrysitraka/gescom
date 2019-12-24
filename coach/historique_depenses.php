<?php
include "header.php";
include_once('../include/include.php');
$coach=$_SESSION['matricule'];
 $sql="SELECT DISTINCT `date` FROM `depense` WHERE 1";
$dateTable=$main->queryAll($sql);

?>
<div class="content-wrapper">
   <div class="container">
    <meta charset="utf-8">
   <div class="row" style="margin-top:-10px">
              <div class="col-md-12" style="background:#fff;padding:5px 5px">
                  <ol class="breadcrumb" style="font-size:14px!important;padding-left:0px" >
                        <li class="active" style="padding:0px 5px" > <a href="../coach/depense_sur_terrain.php" title="Accueil">Depense sur terrain</a> &nbsp;&nbsp;> </b> </li>
                        <li style="padding:0px 5px">Mes dépenses</li>
                </ol>
              </div>
          </div>
    <div class="container">
          <table class=" table table-bordered" style="font-size: 10px">
              <thead>
                  <tr>
                      <th>Heure</th>
                      <th>Motif</th>
                      <th>Montant</th>
                      <th>N° Facture</th>
                  </tr>
                  
              </thead>
              <tbody>
                  <?php foreach( $dateTable as $dateTable ):
                    $sql="SELECT * FROM `depense` WHERE `date` LIKE "+ $dateTable['date'];
                    $montant_depense =$main->queryAll($sql,array());
                    $total = $montant_depense['mt_heb'] + $montant_depense['mt_resp'] + $montant_depense['mt_carb'] + $montant_depense['mt_autre'];
                    ?>
                  <th colspan="2">Dépenses total du <?= $dateTable['date']?> </th>
                  <td style="color: red;"><?= number_format($total,0,","," ")." Ar" ?></td>
                        <tr>
                          <td rowspan="4"><?= $montant_depense['heure']?></td>
                          <td>Hébergement</td>
                          <td><?= number_format($montant_depense['mt_heb'],0,","," ")." Ar"?></td>
                           <td><?= $montant_depense['fact_heb']?></td>
                        </tr>
                        <tr>
                          <td>Restauration</td>
                          <td><?= number_format($montant_depense['mt_resp'],0,","," ")." Ar"?></td>
                           <td><?= $montant_depense['fact_rest']?></td>
                        </tr>
                        <tr>
                          <td>Carburant</td>
                          <td><?= number_format($montant_depense['mt_carb'],0,","," ")." Ar"?></td>
                           <td><?= $montant_depense['fact_carb']?></td>
                        </tr>
                        <tr>
                          <td>Autre</td>
                          <td><?= number_format($montant_depense['mt_autre'],0,","," ")." Ar"?></td>
                           <td><?= $montant_depense['fact_autre']?></td>
                        </tr>
                <?php endforeach; ?>      
                  
              </tbody>
          </table>
    </div>
    </div>
    </div>
<?php 
 include "footer.php";
?>