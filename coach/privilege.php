<?php
$titre = "MES PRIVILIEGES";
include_once("../include/include.php");
include("header.php");
$sql="SELECT `Nom`,`Prenom`,`Fonction_Acutelle` FROM `personnel` WHERE `matricule` LIKE '".$_SESSION['matricule']."'";
$matricule=$main->query($sql);

$sql1="SELECT `matricule` FROM `personnel` WHERE `coach` LIKE ?";
$commerciale=$main->queryAll($sql1,array($_SESSION['matricule']));

$sql_pts="SELECT SUM(`point`) as pts_bimestre FROM `historique_personnel` WHERE `personnel` LIKE ? AND `date` BETWEEN ? AND ?";
$date_pts=new DateTime();
if($date_pts->format('m') % 2 != 0){
    $date_pts->modify('+1 month');   
}
$point_bimestre=$main->query($sql_pts,array($_SESSION['matricule'],date('Y-m').'-01',$date_pts->format('Y-m').'-01'));
$tabcouleur=['#e91e63','#0099CC','#9933CC','#ad1457'];
 $data=$main->progress($_SESSION['matricule']);
     if($data['point']<6400){
       $pointM=($data['point']*100)/6400;
       $poindD=100-$pointM;
       $i=0;
        $statDeb="0";
        $statFin="6400";
        $statBim="Beginner";

       
       
       
     }else if($data['point']<8000){
      $pointM=($data['point']*100)/8000;
      $poindD=100-$pointM;
      $i=0;
      $statDeb="6400";
      $statFin="8000";
      $statBim="Intermediate";
      

     }else if($data['point']<12000){
      $pointM=($data['point']*100)/12000;
      $poindD=100-$pointM;
      $i=1;
      $statDeb="8000";
      $statFin="12000";
      $statBim="Advanced";
     }else if($data['point']<15000){
      $pointM=($data['point']*100)/15000;
      $poindD=100-$pointM;
      $i=2;
        $statDeb="12000";
      $statFin="15000";
      $statBim="Confirmed";
     }else if($data['point']<25500){
      $pointM=($data['point']*100)/25500;
      $poindD=100-$pointM;
      $i=3;
      $statDeb="15000";
      $statFin="25500";
      
     }else if($data['point']<36000){
      $pointM=($data['point']*100)/36000;
      $poindD=100-$pointM;
      $i=3;

    }
    
//Point Annuelle
$tabcouleurAn=['#149046','#614e1a','#C0C0C0','#f2e02e'];
          $point=$main->getPoint($_SESSION['matricule']);

                      if($point->NbPoint<120000){
                        $pointP=(100*$point->NbPoint)/120000;
                        $restPoint=100-$pointP;
                        $statutAn="Natural";
                        $j=0;
                       
                      }else if($point->NbPoint<180000 ){
                        $pointP=(100*$point->NbPoint)/180000;
                        $restPoint=100-$pointP;
                        $statutAn="Bronze";
                        $j=1;
                      }else if($point->NbPoint<360000){
                        $pointP=(100*$point->NbPoint)/360000;
                        $restPoint=100-$pointP;
                        $statutAn="Silver";
                        $j=2;
                      }else if($point->NbPoint<450000){
                        $pointP=(100*$point->NbPoint)/450000;
                        $restPoint=100-$pointP;
                        $statutAn="Gold";
                        $j=3;
                      }
$mois_en_cours=date('Y-m');
$mois = array('Jan','Fev','Mar','Avr','Mai','Jui','Jul','Aou','Sep','Oct','Nov','Dec');
?>
<style>
    th{
        font-weight:normal;
        padding:3px!important;
        vertical-align: top!important;
    }
    h4{
        font-size:14px;
        color:#fff;
    }
    .formating{
        margin-top:-23px;
    }
    .bghead{
        background:#17a2b8;
        color:#fff;
    }
    .pointbg{
        background:#fff;
        color:black;
        padding:5px 5px;
        font-size:12px;
        border-radius:2px;
    }
    ul{
        list-style-type:none;
        padding-left:5px!important;
    }
    ul > li{
        margin-left:0px!important;
    }
    .content-statut{
       
        height:40px; 
        padding:10px 5px;
        border-radius:3px;
    }
     a:not([href]):not([tabindex]) {
    color: inherit;
    text-decoration: none;
    border: solid 1px grey;
    border-radius: 0px;
    }
    .nav-justified .nav-item {
    padding: 0;
}
h3{
        font-size:12px!important;
        padding:10px 0px;
    }
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
         <div class="container-fluid" style="padding:10px 10px">
            <div class="row mt-2">
                  <ul class="nav nav-pills nav-justified col-md-12">
                    <li class="nav-item col-md-6">
                      <a class="nav-link active privilege" style="" id="privilege1">Bi-mestriel</a>
                    </li>
                    <li class="nav-item col-md-6 ">
                      <a class="nav-link privilege" id="privilege2">Annuelle</a>
                    </li>
    
                  </ul>
            </div>
        <div class="row" id="tabcontent1" style="background-color:#FFF;margin-top:20px;">
            <div style="z-index:3; box-shadow: 5px 10px #grey;padding:0px 15px!important" class="col-md-12">
                <div class="row" style="border:1px solid grey;border-radius:5px;" >
                
                    <div class="col-md-12">
                        <h3 style="font-size:14px;text-transform:uppercase;"> <b>Votre statut bimestriel</b></h3>
                        <h3 style="font-size:14px;margin-top: -45px;" class="text-right"> 
                            <span class="statutBimestre" style="width:200px;height:40px; padding:5px 5px;background:<?=$tabcouleur[$i]?>;color:#fff;border-radius:2px"><?=$statBim?></span> 
                        </h3>
                    </div>
                    
                    <div class="col-md-12 mb-3" >
                  
                        <div>
                          <span><?=$statDeb;?></span>
                          <span class="pull-right"><?=$statFin;?></span>
    
                        </div>
                        
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$pointM;?>%;background:#149046;height:2px">
                            
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$poindD?>%;background:#ccc;height:2px">
                     
                        </div>
                   </div>
                
                 <div class="col-md-12">
                        <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background:#e91e63">
                            Begin
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background:#0099CC">
                            Inter
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background: #9933CC">
                            Advc
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background: #ad1457">
                            Confirm
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                   <h3 style="font-size:14px;text-transform:uppercase;">Vous avez: </h3>
                    <span class="privStatBim">
                           <!-- <li> - Réduction de sanctions téléphoniques : 20%</li>
                            <li> - Réduction de sanctions sur absences : 20%</li>-->
                        </span>
                </div>
                <br>
                <hr>
            </div>
        </div>    

           
            <div class="col-md-12">
                <div class="row bg-default">
                    <div class="col-md-12">
                        <hr>
                        
                        <h3 style="font-size:14px;text-transform:uppercase;" class="text-center"> <b>Tous les Statuts</b></h3>
                        <div class="content-statut" style="background:#e91e63;">
                            <h4>Beginner </h4>
                            <h4 class="text-right formating" ><span class="pointbg">6 400 Points </span></h4>
                        </div>
                     
                        <ul class="big" style="lyst-style-type:none">
                            <li> - Réduction de sanctions téléphoniques : 20%</li>
                            <li> - Réduction de sanctions sur absences : 20%</li>
                        </ul>
                    </div>
                    <div class="col-md-12" style="background:#fff">
                        <hr>
                        <div class="content-statut" style="background:#0099CC;">
                            <h4>Intermediate</h4>
                            <h4 class="text-right formating" ><span class="pointbg">8 000 Points </span></h4>
                        </div>
                    
                        <ul class="inter">
                            <li> - Réduction de sanctions téléphoniques : 30%</li>
                            <li> - Réduction de sanctions sur absence : 30%</li>
                            
                        </ul>
             
                    </div>
                    <div class="col-md-12" style="background:#fff">
                         <hr>
                         
                        <div class="content-statut" style="background:#9933CC;">
                             <h4>Advanced</h4>
                             <h4 class="text-right formating" ><span class="pointbg">12 000 Points</span></h4>
                        </div>   
                        <ul class="adv1">
                            <li> - Bonus mensuel : 5.000,00Ar</li>
                            <li> - Réduction de sanctions téléphoniques : 40%</li>
                            <li> - Réduction de sanctions sur absence : 40%</li>
                            <li> - Réduction de Malus : 20%</li>
                        </ul>
                                 
                    </div>
                    
                    <div class="col-md-12" style="background:#fff ">
                        <hr>
             
                        <div class="content-statut" style="background:#ad1457;">
                            <h4>Confirmed </h4>
                            <h4 class="text-right formating" ><span class="pointbg">15 000 Points</span></h4>
                        </div>
                        <ul class="avd2">
                            <li> - Bonus mensuel : 15.000,00Ar</li>
                            <li> - Jour de repos supplémentaire après mission* : 1 jour </li>
                            <li> - Réduction de sanctions téléphoniques : 50%</li>
                            <li> - Réduction de sanctions sur absence : 50%</li>
                            <li> - Réduction de Malus : 30%</li>
                            <li> - Priorité sur avances sur salaire à hauteur de pourcent du salaire en cours : 20%</li>
                        </ul>
                       
                    </div>
            </div>
       </div>

    </div>
<!--2 eme privilege-->
        <div class="row" id="tabcontent2" style='display:none;background-color:white;margin-top:20px;'>
             <div style="z-index:3;border:1px solid grey;border-radius:5px 5px 5px 5px; box-shadow: 5px 10px #grey;" class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                         <h3 style="font-size:14px;text-transform:uppercase;"> <b>Votre statut ANNUELLE</b></h3>
                    <h3 style="font-size:14px;margin-top: -45px;" class="text-right"> <span class="statAnnuelle" style="width:200px;height:40px; padding:5px 5px;background:<?=$tabcouleurAn[$j]?>;color:#fff;border-radius:2px"><?=$statutAn?></span> </h3>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                  
                        <div>
                          <span><?=$statDeb;?></span>
                          <span class="pull-right"><?=$statFin;?></span>
    
                        </div>
                        
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$pointM;?>%;background:#149046;height:2px">
                            
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$poindD?>%;background:#ccc;height:2px">
                     
                        </div>
                </div>
                
                 <div class="col-md-12">
                        <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background:green">
                            Natural
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background:#614e1a">
                            Bronze
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background: #C0C0C0">
                            Silver
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;background: #efd807">
                           Gold
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-12">
                   <h3 style="font-size:14px;text-transform:uppercase;">Vous avez: </h3>
                    <ul class="privStatAnnuelle">
                           <!--<li> 0 avantage</li>--> 
                           
                        </ul>
                </div>
                <br>
                <hr>
                </div>
            </div>
            
            
            
            
            
            <div class="col-md-12">
                <div class="row bg-default" >
                    <div class="col-md-12" style="background:#fff;margin-top:20px;">
                       <hr>
                        
                        <h3 style="font-size:14px;text-transform:uppercase;" class="text-center"> <b>Tous les Statuts</b></h3>
                         
                        <div class="content-statut" style="background:green;">
                             <h4>Statut Natural</h4>
                             <h4 class="text-right formating" ><span class="pointbg">120 000 Points</span></h4>
                             <ul class="nat">
                                 <li>Aucun Avantages </li>
                             </ul>
                        </div>   
                                 
                    </div>
                    <div class="col-md-12" style="background:#fff ">
                        <hr>
             
                        <div class="content-statut" style="background:#614e1a;">
                            <h4>Statut Bronze</h4>
                            <h4 class="text-right formating" ><span class="pointbg">180 000 Points</span></h4>
                        </div>
                        <ul class="br">
                            <li>Avances spéciales annuelles remboursables sur 4 mois: 200.000,00Ar</li>
                        </ul>
                       
                    </div>
                    
                    <div class="col-md-12" style="background:#fff">
                        <hr>
                        <div class="content-statut" style="background:#C0C0C0;">
                            <h4>Statut Silver</h4>
                            <h4 class="text-right formating" ><span class="pointbg">360 000 Points</span></h4>
                        </div>
                        <ul class="sil">
                            <li>Avances spéciales annuelles remboursables sur 6 mois: 480.000,00Ar</li>
                        </ul>
                    
                    </div>
                    <div class="col-md-12" style="background:#fff">
                        <hr>
         
                        <div class="content-statut" style="background: #efd807;">
                            <h4>Statut Gold</h4>
                            <h4 class="text-right formating" ><span class="pointbg">450 000 Points</span></h4>
                        </div>
                        <ul class="gold">
                            <li>Avances spéciales annuelles remboursables sur 6 mois: 480.000,00Ar</li>
                        
                        </ul>
                    </div>
                    
               </div>     
            </div>               
     </div>
   </div>
    
</div>

<?php include("footer.php");


?>