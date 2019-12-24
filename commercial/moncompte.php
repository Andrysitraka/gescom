<?php
include_once('../fonction/main.php');
$dbfacebook=new main('localhost','inexped1_gestiondevente','root','');
$sql="SELECT `Nom`,`Prenom`,`Fonction_Acutelle` FROM `personnel` WHERE `matricule` LIKE '".$_SESSION['matricule']."'";
$matricule=$main->query($sql);
$main_function->chiffreAffaireFB($mois_en_cours,$_SESSION['matricule']);
$point=$main->getPoint($_SESSION['matricule']);
$sql="SELECT DISTINCT `date` FROM `vente` WHERE `idVP` LIKE ? AND `date`  LIKE  '".date("Y-m")."-%'";
$date=$main->queryAll($sql,array($_SESSION['matricule']));
$sql="SELECT DISTINCT facture.NumFact FROM `client`,`facture` WHERE facture.datedefacture LIKE '".date("Y-m-")."%'  AND  facture.idclient LIKE client.idclient AND client.idVP LIKE '".$_SESSION['matricule']."'";
$resultat=$dbfacebook->queryAll($sql);
$montant=0;
$qunatite=0;

 $data=$main->progress($_SESSION['matricule']);
 $tabcouleur=['#e91e63','#0099CC','#9933CC','#ad1457','#3949ab','#00acc1'];
     if($data['point']<1800){
       $pointM=($data['point']*100)/1800;
       $poindD=100-$pointM;
       $i=0;
      $statDeb="0";
      $statFin="1800";
      $text="Beginner";
     }else if($data['point']<3600){
      $pointM=($data['point']*100)/3600;
      $poindD=100-$pointM;
      $i=1;
      $statDeb="1800";
      $statFin="3600";
      $text="Intermediate";
     }else if($data['point']<5400){
      $pointM=($data['point']*100)/5400;
      $poindD=100-$pointM;
      $i=2;
      $statDeb="3600";
      $statFin="5400";
      $text="Advcanced";
     }else if($data['point']<7200){
      $pointM=($data['point']*100)/7200;
      $poindD=100-$pointM;
      $i=3;
      $statDeb="5400";
      $statFin="72000";
      $text="Confirmed";
     }else if($data['point']<9000){
      $pointM=($data['point']*100)/9000;
      $poindD=100-$pointM;
      $i=4;
      $statDeb="7200";
      $statFin="9000";
      $text="Professional";
     }else if($data['point']<10800){
      $pointM=($data['point']*100)/10800;
      $poindD=100-$pointM;
      $i=5;
      $statDeb="9000";
      $statFin="10800";
      $text="Expert";
    }else{
      $i=5;
      $statDeb="9000";
      $statFin="10800";
      $text="Exp";
    }
    /*STATUT ANNUELEE*/
    $bgcouleurAn=['#149046','#614e1a','#C0C0C0','#f2e02e'];
$point=$main->getPoint($_SESSION['matricule']);

  if($point->NbPoint<70000){
    $pointP=(100*$point->NbPoint)/70000;
    $restPoint=100-$pointP;
    $j=0;
    $statAn="Natural";
    $debAn="0";
    $finAn="70000";
  }else if($point->NbPoint<90000 ){
    $pointP=(100*$point->NbPoint)/90000;
    $restPoint=100-$pointP;
    $statAn="Bronze";
    $j=1;
    $debAn="70000";
    $finAn="90000";
  }else if($point->NbPoint<130000){
    $pointP=(100*$point->NbPoint)/130000;
    $restPoint=100-$pointP;
    $statAn="silver";
    $j=2;
    $debAn="90000";
    $finAn="130000";
  }
  else{
         $pointP=(100*$point->NbPoint)/130000;
        $restPoint=100-$pointP;
      $statAn="Gold";
      $j=3;
  }     
?>
<style>
.entete{
    background:#fff; 
    padding:5px 10px;
    font-size:12px!important;
}
.img-profile{
    width:100%;
    height:120px;
    overflow:hidden;
    object-fit:cover;
    z-index:111;
}
@media (min-width:720px){
    .img-profile{
        height:250px;
    }
}

.statut{
    /*background:#149046;*/
    height:35px;
    width:100%; 
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    margin-top:-5px;
    z-index:22222;
    font-size:10px;
}

.statut2{
    height:35px;
    width:100%; 
   border-bottom-right-radius: 5px;
   /* margin-top:-5px;
    z-index:22222;*/
    font-size:10px;
   /* padding: 10px;*/
    border-radius: 5px;
    
}

.statut > h3{
    font-size:14px;
    color:#fff;
    padding:10px 0px;
}

.detail > h3 {
    font-size:16px;
    color:#000;
    font-weight:normal;
}
.detail:hover{
    color:#000!important;
}
table > tbody > tr > td{
    padding:7px!important;
    font-size:9px!important;
}
.point{
    background:#FF8800;padding:5px 5px;color:#fff;
}
</style>


<div class="container-fluid" style="background-color:rgba(0,0,0,.05);" >
    <div class="content-corp">
           <div class="row entete" style="margin-top:1px">
               <div class="col-md-5 col-sm-5 col-5">
                   
                   <a href="../image/personnel/<?=$_SESSION['matricule'].".jpg"?>"data-lightbox="roadtrip" title="">
                       <img src="../image/personnel/<?=$_SESSION['matricule'].".jpg"?>" class="img-thumbnail img-responsive  img-profile"  style="" alt="...">
                   </a>
                  
                       <div class="">
                           <div class="" style="padding:0px 0px">
                                <div class="statut pt-2" style="padding-top:-9px!important;color:#fff;background: linear-gradient(#ff0000, #bf0d0dc4); list-style-type:none;font-size:15px;">
                                    <li class="text-center" style="text-transform:uppercase;font-size:9px;">
                                    <?php 
                                    $sql="SELECT `DesFonction` FROM `fonction` WHERE `id` = ?";
                                    $fonction=$main->query($sql,array($matricule['Fonction_Acutelle']));
                                    echo $fonction['DesFonction'];
                                    ?>
                                    </li>
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
                            <ul class="pull-right" style="list-style-type:none;font-size:11px;">
                                <li class="text-left"><?=$matricule['Nom'];?></li>
                                <li class="text-left"><?=$matricule['Prenom'];?></li>
                                <li class="text-left"><?=$_SESSION['matricule']?></li>
                            </ul>
                        </div>
                    </div>
               </div>
           </div>        
           <div class="row statut1 pr-3" >
               <div class="col-md-2 offset-md-9 col-sm-3 offset-sm-8 col-6 offset-6" style="margin-top:-45px">
                   <div class="row">
                       

                      
                        <div class="col-5" style="background:<?=$bgcouleurAn[$j]?>;height:40px;border-top-left-radius:5px;border-bottom-left-radius:5px;">
                           <a href="?page=detail_point"><h3 class="text-center statA"  style="font-size:10px;margin-bottom:2px!important;padding-top:5px;color:#fff"> <?=$statAn;?></h3></a>
                            <hr/ style="margin:2px;background-color:#fff;">
                            <a href="?page=detail_point"><h3 class="text-center"  style="font-size:10px;margin-bottom:2px!important;color:#fff"><?=" ".$point->NbPoint?> Pts</h3><a href="?page=detail_point.php">
                       </div>
                       <div class="col-7" style="background:<?=$tabcouleur[$i]?>;height:40px;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                          <a href="?page=detail_point"><h3 class="text-center statB"  style="font-size:10px;margin-bottom:2px!important;padding-top:5px;color:#fff"><?=$text;?></h3> </a>
                           <hr/style="margin:2px;background-color:#fff;">
                           
                              <a href="?page=detail_point"> <h3 class="text-center"  style="font-size:10px;color:#fff"><?php if($data){echo $data['point'].' '.'Pts';}else{echo "00 Point";}?></h3></a>
                       </div>                       
                   </div>
               </div>
           </div>

           <div class="row entete  pt-3 pb-3" style="margin-top:-5px">
                <div class="col-md-12">
                   <p class="text-center" style="font-size:12px!important;">C.A  <?php  setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); echo utf8_encode(strftime(" %B %Y")); ?> : <span class="catotal"></span></p>
                </div>
           </div>
           
           <div class="row entete" style="margin-top:-20px">
               <div class="col-md-12">
                    <table class="table table-hover table-bordered size" align="center">
                    
                                   <tbody>
                                       
                    
                                        <tr style="font-size:10px;">
                    
                                            <td><a href="?page=detail_vente_facebook">Vente facebook</a></td>
                                            <td class="text-right"><a href="?page=detail_vente_facebook"><?php $fb=$main_function->chiffreAffaireFB($mois_en_cours,$_SESSION['matricule']);echo  number_format($fb, 2, ',', ' ');?>Ar </a></td>
                    
                                        </tr>
                    
                    
                                        <tr style="font-size:10px;">
                                         <td><a href="?page=detail_vente_sur_terrain">Vente terrain</a></td>
                                         <td class="text-right"><a href="?page=detail_vente_sur_terrain"><?php $tr=$main_function->chiffreAffaireTR($mois_en_cours,$_SESSION['matricule']);echo number_format($tr, 2, ',', ' ');?>Ar</a></td>
                    
                                     </tr>
                    
                                      <tr style="font-size:10px;">
                                         <td><a href="?page=deduction_sur_salaire">Déduction sur salaire</a></td>
                                         <td class="text-right"><a href="?page=deduction_sur_salaire">- 
                                         
                                           <?php 
                                            $Man=$main_function->ttmalus($_SESSION['matricule'],date('Y-m'));
                                            echo number_format($Man,2,","," ");
                                            ?> Ar
                                           </a></td>
                    
                                     </tr>
                    
                                    </tbody>
                    </table>

            <table class="table table-hover  table-bordered table-striped size" >
              <tbody>
                <tr>
                 <td style="width:57%;">Salaire prévisionnel du mois  : </td>
                 <td class="text-right"> 
                 
                   <?php if($resultat){ foreach($resultat as $resultat){
                        $produitClientMontant=0;
                        $sql="SELECT produit.designation,produit.prix,produit.quantite,comande.codeproduit,comande.quantite FROM `facture`,`comande`,`produit` WHERE comande.idcomand LIKE facture.idcomande AND comande.codeproduit LIKE produit.codeproduit  AND facture.NumFact LIKE '".$resultat['NumFact']."'";
                        $produit=$dbfacebook->queryAll($sql);
                        foreach($produit as $produit){
                          $qunatite+=$produit["quantite"];  
                          $produitClientMontant=$produit["prix"]*$produit["quantite"];
                          $montant+=$produitClientMontant;
                            
                          }
                        } 
                       $sa=($montant*15)/100;
                   }
                      $totaReal=0; if($date): foreach($date as $date):
                      $monca=0;
                      $com=0;
                      $sql="SELECT `lieu`,`codeproduit`,`quantite`,`idPrix` FROM `vente` WHERE `idVP` LIKE ? AND  `date`  LIKE ?";
                      $resultat=$main->queryAll($sql,array($_SESSION['matricule'],$date['date']));
                      foreach($resultat as $resultat){
                        $sql="SELECT `prixdetail` FROM `prix` WHERE `idMission` LIKE ? AND `idProduit` LIKE ? AND `idPrix`=?";
                        $prix=$main->query($sql,array($resultat['lieu'],$resultat['codeproduit'],$resultat['idPrix']));
                        $monca+=($prix['prixdetail']*$resultat['quantite']);
                      }
                      $sql="SELECT `lieu` FROM `vente` WHERE `idVP` LIKE ? AND  `date`  LIKE ?";
                      $cacom=$main->query($sql,array($_SESSION['matricule'],$date['date']));
                      if($cacom['lieu']==1){
                        $com=($monca*15.1)/100; 
                      }else if($cacom['lieu']==2){
                           $com=($monca*12.8)/100; 
                      }else if($cacom['lieu']==5){
                           $com=($monca*18.4)/100; 
                      }
                             
                     
                  
                 
                 $totaReal+=$com; endforeach;endif;
                 $Totaltemp= $totaReal-$Man;
                  echo '<b>'.number_format($Totaltemp,2,","," ").' Ar </b>';  
                 ?> </td>
                </tr>
              
             

                </tbody>
            </table>
               </div>
           </div>
           
           <br>

            <div class="row entete"  style="margin-top:-20px">
               <div class="col-md-12">
                    <h3 style="font-size:12px"> Statut mois  <?=" ".$main->BimMois(date("m"))?></h3>
                    <div class="progress">
                        
                        <div class="progress-bar progress-bar-striped proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#e91e63;opacity:0.2">
                        Beginner
                        </div>
                        <div class="progress-bar progress-bar-striped proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#0099CC;opacity:0.2">
                        Intermediate
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#9933CC;opacity:0.2">
                        Advcanced
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#ad1457;opacity:0.2">
                        Confirmed
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#3949ab;opacity:0.2">
                        Professionnal
                        </div>
                        <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#00acc1;opacity:0.2">
                        Expert
                        </div>
                    </div>
               </div>
           </div>
           <div class="row entete">
               <div class="col-md-12">
                    <h3 style="font-size:12px">Progression de votre statut</h3>
                    <div style="font-size:0.7em;">
                      <span ><?=$statDeb;?></span>
                      <span class="pull-right"><?=$statFin;?></span>
                      
                    </div>                    
                    <div class="progress"  style="height:2px">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$pointM?>%;background:<?=$tabcouleur[$i];?>;height:2px">
                            
                        </div>
                         <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$poindD?>%;background:#ccc;height:2px">
                        </div>

                    </div>
               </div>
           </div>
             <div class="row entete" style="margin-top:5px">
               <div class="col-md-12">
                    <h3 style="font-size:12px"> Statut Annuel</h3>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#149046;opacity:0.2">
                        Natural
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background:#614e1a;opacity:0.2">
                        Bronze
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background: #C0C0C0;opacity:0.2">
                        Silver
                        </div>
                         <div class="progress-bar proStat" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;color:black;font-weight:bold;background: #f2e02e;opacity:0.2">
                        Gold
                        </div>
                    </div>

               </div>
           </div>
           <div class="row entete" >
               <div class="col-md-12">
                    <h3 style="font-size:12px"> Progression Annuelle</h3>
                    <div style="font-size:0.7em;">
                      <span ><?=$debAn;?></span>
                      <span class="pull-right"><?=$finAn;?></span>
                      
                    </div> 
                    <div class="progress" style="height:2px">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$pointP?>%;background:<?=$bgcouleurAn[$j]?>;height:2px">

                        </div>

                       <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$restPoint?>%;background:#ccc;style=height:2px">

                        </div>

                    </div>
               </div>
           </div>           

 <!-----TOUS LES STATUS-->           
<div class="row mt-2 mb-2" style="padding:10px 10px;background:#fff">
               <div class="col-md-12 pt-2" style="border:solid 1px grey;border-radius:5px;font-size:11px;padding:15px;">
                   <h3 style="font-size:11px">Vos Privilièges Actuel Par rapport à votre statut</h3>
                   
                   <hr>
                   <h3 style="color:#149046;font-size:11px"> <i class="fa fa-calendar" style="font-size:11px" aria-hidden="true"></i> Priviliège Annuel</h3>
                    <h3 class="text-right" style="margin-top:-25px!important;color:#149046;font-size:11px"><?=date("Y")?></h3>
                   <div class="content">
                        <ul class="nat">
                            <li style="">Aucun Avantages </li>
                        </ul>
                   </div>
                  
                  <hr >
                   <h3 style="color:#e91e63;font-size:11px"> <i class="fa fa-calendar" style="font-size:11px" aria-hidden="true" ></i> Priviliège Bimestriel</h3>
                   <h3 class="text-right" style="margin-top:-25px!important;color:#e91e63;font-size:11px"><?=" ".$main->BimMois(date("m"))?>:</h3>
                    <div class="content privStatut">
                        
                   </div>
               </div>
               
           </div>


           <br>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
           <p>2000 point</p>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>        
        
        
        
        
        
        
        
        
        
        
        
    </div>    
</div>     






