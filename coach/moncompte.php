<style>
    th{
        padding:0px!important;
    }

.statut > h3{
    
    padding:8px 0px;
    color:white;
    
    
}
h3{
    font-size:14px!important;
}
.content{
    padding-left:15px!important;
}
ul{
        list-style-type:none;
        padding-left:5px!important;
    }
    ul > li{
        margin-left:0px!important;
    }
    span > a{
        color:#000!important;
    }
    hr{
        margin:0px 0px!important;
    }
</style>
<?php 
$titre = "Mon compte";

include_once('../include/include.php');

$sql="SELECT `Nom`,`Prenom`,`Fonction_Acutelle` FROM `personnel` WHERE `matricule` LIKE '".$_SESSION['matricule']."'";
$matricule=$main->query($sql);

$sql1="SELECT `matricule` FROM `personnel` WHERE `coach` LIKE ?";
$commerciale=$main->queryAll($sql1,array($_SESSION['matricule']));

$sql_pts="SELECT SUM(`point`) as pts_bimestre FROM `historique_personnel` WHERE `personnel` LIKE ? AND `date` BETWEEN ? AND ?";
$date_pts=new DateTime();
$date_pts2=new DateTime();
if($date_pts->format('m') % 2 != 0){
    $date_pts->modify('+1 month');  
    $point_bimestre=$main->query($sql_pts,array($_SESSION['matricule'],date('Y-m').'-01',$date_pts->format('Y-m').'-01'));
}else{
    $date_pts->modify('-1 month'); 
    $date_pts2->modify('+1 month');
    $point_bimestre=$main->query($sql_pts,array($_SESSION['matricule'],$date_pts->format('Y-m').'-01',$date_pts2->format('Y-m').'-01'));
}



$tabcouleur=['#e91e63','#0099CC','#9933CC','#ad1457'];
 $data=$main->progress($_SESSION['matricule']);
     if($data['point']<6400){
       $pointM=($data['point']*100)/6400;
       $poindD=100-$pointM;
       $i=0;
        $statDeb="0";
        $statFin="6400";

       $text="Beginner";
       
       
     }else if($data['point']<8000){
      $pointM=($data['point']*100)/8000;
      $poindD=100-$pointM;
      $i=0;
      $statDeb="6400";
      $statFin="8000";
      $text="Intermediate";

     }else if($data['point']<12000){
      $pointM=($data['point']*100)/12000;
      $poindD=100-$pointM;
      $i=1;
      $statDeb="8000";
      $statFin="12000";
      $text="Advcanced";
     }else if($data['point']<15000){
      $pointM=($data['point']*100)/15000;
      $poindD=100-$pointM;
      $i=2;
        $statDeb="12000";
      $statFin="15000";
      $text="confirmed";
     }else if($data['point']<25500){
      $pointM=($data['point']*100)/25500;
      $poindD=100-$pointM;
      $i=3;
      $statDeb="15000";
      $statFin="25500";
      $text="Professional";
     }else if($data['point']<36000){
      $pointM=($data['point']*100)/36000;
      $poindD=100-$pointM;
      $i=3;
      $text="Expert";    
    }
    
//Point Annuelle
$tabcouleurAn=['#149046','#614e1a','#C0C0C0','#f2e02e'];
          $point=$main->getPoint($_SESSION['matricule']);

                      if($point->NbPoint<120000){
                        $pointP=(100*$point->NbPoint)/120000;
                        $restPoint=100-$pointP;
                        $statutAn="Natural";
                        $j=0;
                        $ptsdeb=0;
                        $ptsFin=120000;
                       
                      }else if($point->NbPoint<180000 ){
                        $pointP=(100*$point->NbPoint)/180000;
                        $restPoint=100-$pointP;
                        $statutAn="Bronze";
                        $j=0;
                        $ptsdeb=120000;
                        $ptsFin=180000;                        
                      }else if($point->NbPoint<360000){
                        $pointP=(100*$point->NbPoint)/360000;
                        $restPoint=100-$pointP;
                        $statutAn="Silver";
                        $j=0;
                        $ptsdeb=180000;
                        $ptsFin=360000;                        
                      }else if($point->NbPoint<450000){
                        $pointP=(100*$point->NbPoint)/450000;
                        $restPoint=100-$pointP;
                        $statutAn="Gold";
                        $j=0;
                        $ptsdeb=360000;
                        $ptsFin=450000;                        
                      }
                      
                        $mois_en_cours=date('Y-m');
                        $mois = array('Jan','Fev','Mar','Avr','Mai','Jui','Jul','Aou','Sep','Oct','Nov','Dec');
                        include "header.php";

                        ?>
                         <?php
                                  if(@$point_bimestre['point']<6400){
                                   // $statutCouleur="Beginner";//green
                                    
                                ?>
                                
                               <h3 class="text-center" aria-hidden="true" style="font-size:10px;"><span style='padding-right:5px;'><?php $statutCouleur;?></span> <br>
                               
                              </h3>
                                <?php }else if($point_bimestre['point']<8000){
                                    //$statutCouleur="Intermediate";//marron
                                    
                                ?>
                                <h3 class="text-center" aria-hidden="true" style="font-size:10px;"> <?=$statutCouleur;?> <br>
                               
                                </h3>
                                <?php }else if($point_bimestre['point']<12000){
                                   // $statutCouleur="Advanced1";//gris
                                    
                                ?>
                                <h3 class="text-center" aria-hidden="true" style="font-size:10px;"> <?=$statutCouleur;?> <br>
                                 
                               </h3>
                                <?php }else if($point_bimestre['point']<15000){
                                    //$statutCouleur="Advanced2";//or
                                    
                                ?>
                                <h3 class="text-center" aria-hidden="true" style="font-size:10px;"><?=$statutCouleur;?> <br> 
                                
                                </h3>
                                <?php }else if($point_bimestre['point']<25500){
                                   // $statutCouleur="Proféssionnel";
                                   // $statutAn="P";
                                ?>
                                <h3 class="text-center" style="font-size:10px;"> <?=$statutCouleur;?> <br>
                                
                               </h3>
                                <?php }else if($point_bimestre['point']<36000){
                                    //$statutCouleur="Proféssionnel";
                                ?>
                                <h3 class="text-center" style="font-size:10px;"> <?=$statutCouleur?> <br>
                               
                               </h3>                               
                                <?php }else{
                                // $statutCouleur="Expert";?>
                                <h3 class="text-center" style="font-size:10px;"> <?=$statutCouleur;?> <br>
                               
                        <?php } ?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-corp">
      <div class="container-fluid">
           <div class="row entete" style="margin-top:-20px">
               <div class="col-md-5 col-sm-5 col-5">
                   
                   <a href="../image/personnel/<?=$_SESSION['matricule'].".jpg"?>"data-lightbox="roadtrip" title="">
                       <img src="../image/personnel/<?=$_SESSION['matricule'].".jpg"?>" class="img-thumbnail img-responsive  img-profile"  style="" alt="...">
                   </a>
                  
                       <div class="">
                           <div class="" style="padding:0px 0px">
                                <div class="statut pt-2" style="padding-top:-5px!important;color:#fff;background-color:#0062eb; list-style-type:none;font-size:15px;">
                                    <li class="text-center" style="text-transform:uppercase;font-size:12px;padding-top:3px">COACH</li>
                                </div>
                           </div>
                          <!--  <div class="col-md-4 col-sm-4 col-4">
                               <div class="statut2 text-center" id="statut2"  style="height:35px;padding:10px 0px;color:#fff;background-color:<?=$tabcouleurAn[$i];?>" ><?=$statutAn;?></div>
                           </div>
                           -->
                           
                   </div>
               </div>
                <div class="col-md-7 col-sm-7 col-7 detail">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pull-right" style="list-style-type:none;font-size:13px;">
                                <li class="text-left"><?=$matricule['Nom'];?></li>
                                <li class="text-left"><?=$matricule['Prenom'];?></li>
                                <li class="text-left"><?=$_SESSION['matricule']?></li>
                            </ul>
                        </div>
                    </div>
               </div>
           </div>
           <div class="row statut1 pr-3" >
               <div class="col-md-2 offset-md-10 col-sm-3 offset-sm-9 col-5 offset-7" style="margin-top:-45px">
                   <div class="row">
                      
                       <div class="col-6" style="background:green;height:45px;border-top-left-radius:5px;border-bottom-left-radius:5px;border-right:solid 2px #ccc">
                           <a href="detail-point.php">
                          <h3 class="text-center statB"  style="font-size:10px!important;margin-bottom:2px!important;padding-top:9px;color:#fff"><?=$statutAn;?></h3>
                            <hr width="100%" color="#fff">
                           <h3 class="text-center"  style="font-size:10px!important;margin-bottom:2px!important;color:#fff"> <?=" ".$point->NbPoint?> Pts </h3>
                        </a> 
                       </div>
                     
                        <div class="col-6" style="background:#e91e63;height:45px;border-top-right-radius:5px;border-bottom-right-radius:5px;border-left:solid 2px #ccc">
                            <a href="detail-point.php">
                           <h3 class="text-center statA"  style="font-size:10px!important;margin-bottom:2px!important;padding-top:9px;color:#fff"> <?=$text;?></h3>
                           <hr width="100%" color="#fff">
                            <h3 class="text-center"  style="font-size:10px!important;color:#fff"><?php if($data){echo $data['point'].' '.'Pts';}else{echo "00 Point (JR)";}?></h3>
                             </a> 
                       </div>
                   </div>
               </div>
           </div>

           <div class="row entete  pt-3 pb-3" style="margin-top:-5px">
                <div class="col-md-12">
                  <p class="text-center" style="color:#000!important">C .A <?php  setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); echo $mois[strftime("%m")-1]." ".strftime("%Y"); ?> : <span style="font-weight:bold;color:#000!important" class="cacoach"></span></p>
                </div>
           </div>
           <div class="row entete" style="margin-top:-20px">
               <div class="col-md-12">
                    <table class="table table-bordered">
                         <tbody >
                             <tr>
                                 <td><a href="deduction_salaire.php">Déduction</a></td>
                                 <?php 
                                        $sql_deduct="SELECT SUM(`montont`) as compte FROM `penalite` WHERE `IdCodeVp` LIKE ? AND `date` LIKE ?";
                                        $deduction=$main->query($sql_deduct,array($_SESSION['matricule'],date('Y-m')."-%"));
                                 ?>
                                <!-- <td class="text-right deduction_ca"> Ar</td>-->
                                <td class="text-right"> <?=number_format($deduction['compte'],2,","," ")." Ar";?></td>
                             </tr>
                              <tr>
                                 <td><a href="bonus-prime.php">Bonus et Prime</a></td>
                                 <td class="text-right">
                                     <?php 
                                            $sql="SELECT `montant` FROM `BonusEtPrime` WHERE `IdCodeVp` LIKE ?";
                                            $bonus=$main->queryAll($sql,array($_SESSION['matricule']));
                                            $total_bonus=0;
                                            foreach($bonus as $bonus){
                                                $total_bonus+=($bonus['montant']);
                                            }                            
                                        
                                            echo number_format($total_bonus,2,","," ");
                                        ?> Ar
                                 </td>
                             </tr>
                              <tr>
                                 <td><a href="renumeration.php">Rénumeration</a></td>
                                 <td class="text-right">
                                      Ar
                                 </td>
                             </tr>
                         </tbody>
                     </table>
               </div>
           </div>
           <br>
            <div class="row entete"  style="margin-top:-20px">
               <div class="col-md-12">
                    <h3 style="font-size:12px"> Statut mois  Nov-Dec</h3>
                  
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;color:white;font-weight:bold;background:#e91e63;opacity:0.2">
                            Beginner
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background:#0099CC;opacity:0.2">
                            Inter
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background: #9933CC;opacity:0.2">
                            Confir
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background: #ad1457;opacity:0.2">
                            Advan
                        </div>
                    </div>
               </div>
           </div>
           <div class="row entete">
               <div class="col-md-12">
                    <h4 style="font-size:12px">Progression de votre statut</h4>
                   
                    <div style="font-size:0.7em">
                      <span><?=$statDeb;?></span>
                      <span class="pull-right"><?=$statFin;?></span>

                    </div>
                    <div class="progress">
                        
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$pointM;?>%;background:<?=$tabcouleur[$i]?>;height:2px">
                            
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$poindD?>%;background:#ccc;height:2px">
                     
                        </div>
                    </div>   
                </div>
                    
                    
             
           </div>
             <div class="row entete" style="margin-top:5px; padding-left:10px;padding-right:10px">
               <div class="col-md-12" style="">
                    <h3 style="font-size:12px"> Statut Annuel</h3>
                    
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;color:white;font-weight:bold;background:#149046;opacity:0.2">
                        Natural
                        </div>
                         <div class="progress-bar" role="progressbar proStat" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background:#614e1a;opacity:0.2">
                        Bronze
                        </div>
                         <div class="progress-bar" role="progressbar proStat" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background: #C0C0C0;opacity:0.2">
                        Silver
                        </div>
                         <div class="progress-bar" role="progressbar proStat" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 20%;color:white;font-weight:bold;background: #f2e02e;opacity:0.2">
                        Gold
                        </div>
                    </div>
                    
               </div>
           </div>
           <div class="row entete" >
               <div class="col-md-12">
                    <h3 style="font-size:12px"> Progression Annuelle</h3>
                    <div style="font-size:0.7em">
                      <span><?=$ptsdeb;?></span>
                      <span class="pull-right"><?=$ptsFin;?></span>

                    </div>
                    <div class="progress" style="height:2px;"> <!--style="height:2px"-->
                        <!--POINT ANNUELLE -->
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pointP?>%;background:<?=$tabcouleurAn[$j]?>;style="height:2px"">
                                 
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$restPoint?>%;background:#ccc;style="height:2px"">
                                
                        </div>

                    </div>
               </div>
           </div>
           
           <div class="row mt-2 mb-2" style="padding:10px 10px;background:#fff">
               <div class="col-md-12 pt-2" style="border:solid 1px grey;border-radius:5px">
                   <h3>Vos Privilièges Actuel Par rapport à votre statut</h3>
                   
                   <hr>
                   <h3 style="color:#149046" > <i class="fa fa-calendar" aria-hidden="true"></i> Priviliège Annuel</h3>
                    <h3 class="text-right" style="margin-top:-25px!important;color:#149046">  2020</h3>
                   <div class="content">
                        <ul class="nat">
                            <li style="">Aucun Avantages </li>
                        </ul>
                   </div>

                  <hr >
                   <h3 style="color:#e91e63"> <i class="fa fa-calendar" aria-hidden="true" ></i> Priviliège Bimestriel</h3>
                   <h3 class="text-right" style="margin-top:-25px!important;color:#e91e63">  Jan - Fév</h3>
                    <div class="content">
                        <ul class="big" style="lyst-style-type:none">
                            <li> - Réduction de sanctions téléphoniques : 20%</li>
                            <li> - Réduction de sanctions sur absences : 20%</li>
                        </ul>  
                   </div>
               </div>
           </div>
           
           <div class="modal">
            <div class="modal-content">
                <span class="close-button">×</span>
                <h1>Hello, I am a modal!</h1>
            </div>
        </div>
      </div>
    </div>
 </div>
 



<?php include "footer.php";?>

</script>