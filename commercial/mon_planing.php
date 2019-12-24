<?php
include_once("../include/include.php");
$sql2 ="SELECT `planing`.`date`,`planing`.`Panier`,`planing`.`quartier`,`planing`.`province`,`planing`.`ville`,`mission`.`lieu` FROM `planing`,`mission`,`planing_equipe` WHERE planing.IdEquipe LIKE planing_equipe.designationEquipe AND planing_equipe.mtrP LIKE ? AND planing_equipe.statut LIKE 'Active' AND mission.idMission LIKE planing.idMission";
$terrain = $main->queryAll($sql2,array($_SESSION['matricule']));
$sql="SELECT `designationEquipe` FROM `planing_equipe` WHERE `statut` LIKE 'Active' AND `mtrP` LIKE ?";
$equipe=$main->query($sql,array($_SESSION['matricule']));

$sql="SELECT `planing`.`date`,`planing`.`Panier`,`planing`.`quartier`,`planing`.`province`,`planing`.`ville`,`mission`.`lieu` FROM `planing`,`mission`,`planing_equipe` WHERE planing.IdEquipe LIKE planing_equipe.designationEquipe AND planing_equipe.mtrP LIKE ? AND planing_equipe.statut LIKE 'Active' AND mission.idMission LIKE planing.idMission AND planing.date LIKE ?";
$planning=$main->query($sql,array($_SESSION['matricule'],date("Y-m-d")));

?>
<meta charset="utf-8">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" style="font-size:9px"><a href="?page">Accueil</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="font-size:9px">Mon planning</li>
  </ol>
</nav>
<div class="container" style="margin-top:20px;">
    <h4 style="font-size:12px" class="text-center">Equipe :&nbsp; <?=$equipe['designationEquipe']?></h4>
</div>
<div class="text-center" >
    
    <h4 style="font-size:12px"><?=strftime(" Planning du :  %A %d %B %Y")?></h4>
    <table class="table table-responsive table-bordered">
       <thead>
          <tr> 
                    
                
                    <th  style="font-size:9px;" class="text-center">Ville </th>
                    <th  style="font-size:9px;" class="text-center">Lieu d'animation</th>
                    <th  style="font-size:9px;" class="text-center">Panier </th>
                    <th  style="font-size:9px;" class="text-center">Prix appliquer</th>
                </tr>
       </thead> 
       <tbody>
               
                <td style="font-size:9px;" class="text-center"><?=$planning['ville']?></td>
                <td style="font-size:9px;" class="text-center"><?=$planning['quartier']?></td>
                <td style="font-size:9px;" class="text-center"><?=$planning['Panier']?></td>
                <td style="font-size:9px;" class="text-center"><?=$planning['lieu']?></td>
       </tbody>
    </table>
 
</div>

<div class="text-center">
    <h4 style="font-size:11px">Planning général</h4>
</div>
   

    <table class="table table-bordered table-responsive">
         <thead>
                <tr>
                    <th  style="font-size:9px;" class="text-center col-5">Date </th>
                    <th  style="font-size:9px;" class="text-center">Ville </th>
                    <th  style="font-size:9px;" class="text-center">Lieu d'animation</th>
                    <th  style="font-size:9px;" class="text-center">Panier  </th>
                    <th  style="font-size:9px;" class="text-center">Prix appliquer</th>
                </tr>
      </thead>
      <tbody>        
           <?php 
           if($terrain):
               foreach($terrain as $terrain):
            
           ?>             
            <tr <?php if(date($terrain['date'])<date("Y-m-d")): ?>
            style="background-color:#ff8276;color:#fff;"<?php elseif($terrain['date']==date("Y-m-d")):?>
            style="background-color:#fcd100;color:#000;"<?php elseif(date($terrain['date'])>date("Y-m-d")):?> 
            style="background-color:#83c371;color:#fff;" <?php endif;?>>
            <td style="font-size:9px;" class="text-center">
                <?php 
                setlocale (LC_TIME, 'fr_FR');
                $dateFormat =  $terrain['date'];
                $dat = strftime("%A %d %B %Y",strtotime("$dateFormat"));
                echo $dat;?></td>
                <td style="font-size:9px;" class="text-center"><?=$terrain['ville']?></td>
                <td style="font-size:9px;" class="text-center"><?=$terrain['quartier']?></td>
                <td style="font-size:9px;" class="text-center"><?=$terrain['Panier']?></td>
                <td style="font-size:9px;" class="text-center"><?=$terrain['lieu']?></td>
               
            </tr>
          <?php
          endforeach;
            endif;
          ?>
    </tbody>

 </table>

 
        
       