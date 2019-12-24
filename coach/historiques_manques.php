<?php
        include "header.php";
        //include_once('../include/include.php');
       // $sql="SELECT DISTINCT `date` FROM `rapport` WHERE 1 ";
        // $Madate=$main->queryAll($sql);
       //$sql="SELECT * FROM `rapport` WHERE `type` <> 'rapport de vente' AND `type` <> 'DEPENSE'";
       //$manque=$main->queryAll($sql,array($Madate['date']));
?>
    <div class="content-wrapper">
   <div class="container">
    <meta charset="utf-8">
   <div class="row" style="margin-top:-10px">
              <div class="col-md-12" style="background:#fff;padding:5px 5px">
                  <ol class="breadcrumb" style="font-size:14px!important;padding-left:0px" >
                        <li class="active" style="padding:0px 5px" > <a href="../coach/rapport_manque.php" title="Accueil">Manques</a> &nbsp;&nbsp;> </b> </li>
                        <li style="padding:0px 5px">Listes des manques</li>
                </ol>
              </div>
          </div>
    <div class="container">
          <table class=" table table-bordered" style="font-size: 10px" id="Tmanque">
              <thead>
                  <tr>
                      <th class="text-center">Date</th>
                      <th class="text-center">Heure</th>
                      <th class="text-center">Manque</th>
                      <th class="text-center">Remarque</th>
                      <th class="text-center">Montant</th>
                      <th class="text-center">Matricule</th>
                  </tr>
              </thead>
              <tbody id="emp_body">
                 
              </tbody>
          </table>
                 <div class="col-lg-8 text-center" style="font-size:12px;paddind:5px;">
                         <ul class="pagination justify-content-center" id="pagination"></ul>
                </div>
                      
    </div>
    </div>
    </div>
<?php 
        include "footer.php";
?>