<style>
h1, h2, h3, h4{
    font-size:14px!important;
}
th{
    padding:2px!important;
    font-size:14px;
}
td{
    font-size:12px;
}
.fonttb{
    font-weight: normal!important;
    color:#fff;
}
</style>
<?php 
$titre = "Chiffre d'Affaire";
include_once('header.php');
$titre = "Mes points";
include_once('../include/include.php');
$date_now=date('Y-m-d');
$coach=$_SESSION['matricule'];
$sql="SELECT `nom_mission`,`id_equipe`,`date_deb`,`date_fin` FROM `ma_mission` WHERE `id_coach` LIKE ? AND `statut_mission` LIKE 'En_cours'"; 
$mission = $main->query($sql,array($coach));
 $sql="SELECT `mtrP` FROM `planing_equipe`,fonction,equipe WHERE `fonction` = fonction.id AND fonction.DesFonction LIKE ? AND `statut` LIKE 'Active' AND `designationEquipe` LIKE equipe.IdEquipe AND equipe.idEqupe LIKE ?";
                            $coach_mission=$main->queryAll($sql,array('Coach',$mission['id_equipe']));
                                    $i=0; $total_ca=0;
                                    foreach($coach_mission as $coach_mission){ 
                                        if($i==0){
                                            $i=1;
                                            $comm1=$coach_mission['mtrP'];
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                           
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                                            
                                        }else{ 
                                            $comm2=$coach_mission['mtrP'];
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                           
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                                        }
                                    }
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-corp">
        <div class="container-fluid">
            <div class="row" style="padding:10px 10px">
                
            </div>
            <div class="col-md-12 p-2" style="background:#3F729B;color:#fff;">
                <?php 
                        $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                        $total_ca=0;
                         @$com=$main->queryAll($sql,array($comm1));
                        
                                            $date_deb=new DateTime($mission['date_deb']);
                                            $date_fin=new DateTime($mission['date_fin']);
                                            $ca=array();
                                            if($com){
                                                foreach($com as $com){
                                                    do{
                                                        @$ca[$com['matricule']]+=$main->ca_jour_coach($com['matricule'],$date_deb->format('Y-m-d'));
                                                        $date_deb->modify('+1 day');
                                                    }while($date_deb<=$date_fin);
                                                    $total_ca+=$ca[$com['matricule']];
                                                }
                                            }
                        $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                        $com=$main->queryAll($sql,array($comm2));
                        
                                            $date_deb=new DateTime($mission['date_deb']);
                                            $date_fin=new DateTime($mission['date_fin']);
                                            $ca=array();
                                            if($com){
                                                foreach($com as $com){
                                                    do{
                                                         @$ca[$com['matricule']]+=$main->ca_jour_coach($com['matricule'],$date_deb->format('Y-m-d'));
                                                        $date_deb->modify('+1 day');
                                                    }while($date_deb<=$date_fin);
                                                    $total_ca+=$ca[$com['matricule']];
                                                }
                                            }
                                            
                ?>
                     <span class="col-md-5">C.A de la mission</span>
                     <span class="pull-right" style="font-size:11px"><?=number_format($total_ca,2,',',' ').' ar'?></span>
            </div>
            
            <div clas="row pt-2" style="padding:10px 15px">
                <div class="col-md-12">
                    <hr>
                    <h2><?=$comm1?> : 
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                        $com=$main->queryAll($sql,array($comm1));
                        $total_ca=0;
                        $date_deb=new DateTime($mission['date_deb']);
                        $date_fin=new DateTime($mission['date_fin']);
                                            $ca=array();
                                            if($com){
                                                foreach($com as $com){
                                                    do{
                                                         @$ca[$com['matricule']]+=$main->ca_jour_coach($com['matricule'],$date_deb->format('Y-m-d'));
                                                        $date_deb->modify('+1 day');
                                                    }while($date_deb<=$date_fin);
                                                    $total_ca+=$ca[$com['matricule']];
                                                }
                                            }
                                           
                    ?>
                        <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2>
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus" value="Show/Hide" onClick="showHideDiv('divMsg_mission')"></i></h2>
                		<div id="divMsg_mission" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
                                            <td><a href="detail-ca-mission.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($ca[$com['matricule']],2,',',' ');?></td>
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
                 <div class="col-md-12">
                    <hr>
                    <h2 style="padding-bottom:10px"><?=$comm2?> :
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            $total_ca=0;
                                            $date_deb=new DateTime($mission['date_deb']);
                                            $date_fin=new DateTime($mission['date_fin']);
                                            $ca=array();
                                            if($com){
                                                foreach($com as $com){
                                                    do{
                                                         @$ca[$com['matricule']]+=$main->ca_jour_coach($com['matricule'],$date_deb->format('Y-m-d'));
                                                        $date_deb->modify('+1 day');
                                                    }while($date_deb<=$date_fin);
                                                    $total_ca+=$ca[$com['matricule']];
                                                }
                                            }
                    ?>
                    <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2> 
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus blue" value="Show/Hide" onClick="showHideDiv('divMsg2_mission')" ></i></h2>
                    	<div id="divMsg2_mission" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
  
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
 
                                                <td><a href="detail-ca-mission.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($ca[$com['matricule']],2,',',' ');?></td>
                                    
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
            </div>
            
            <div class="col-md-12 p-2" style="background:#3F729B!important;color:#fff;">
                     <?php 
                        $total_ca=0;
                     $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                                            
                ?>
                     <span class="col-md-5">C.A journalier</span>
                     <span class="pull-right" style="font-size:11px"><?=number_format($total_ca,2,',',' ').' ar'?></span>
            </div>
            
            <div clas="row pt-2" style="padding:10px 15px;">
                <div class="col-md-12">
                    <hr>
                    <h2><?=$comm1?> : 
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            $total_ca=0;
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                    ?>
                        <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2>
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus" value="Show/Hide" onClick="showHideDiv('divMsg')"></i></h2>
                		<div id="divMsg" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63!important;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
                                            <td><a href="detail-ca.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($main->ca_jour_coach($com['matricule'],date('Y-m-d')),2,',',' ');?></td>
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
                 <div class="col-md-12">
                    <hr>
                    <h2 style="padding-bottom:10px"><?=$comm2?> :
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            $total_ca=0;
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                    ?>
                    <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2> 
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus blue" value="Show/Hide" onClick="showHideDiv('divMsg2')" ></i></h2>
                    	<div id="divMsg2" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63 ;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
  
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
 
                                                <td><a href="detail-ca.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($main->ca_jour_coach($com['matricule'],date('Y-m-d')),2,',',' ');?></td>
                                    
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
            </div>
            
            <div class="row" style="padding:0px 10px">
                 <div class="col-md-12 p-2" style="background:#3F729B!important;color:#fff;">
                     <?php 
                        $dt = new DateTime('-1 day');
                        $date = $dt->format('Y-m-d');
                        $total_ca=0;
                     $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],$date);//ca du jour du coach
                                                }
                                            }
                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],$date);//ca du jour du coach
                                                }
                                            }
                                            
                ?>
                     <span class="col-md-5">C.A la veille</span>
                     <span class="pull-right" style="font-size:11px"><?=number_format($total_ca,2,',',' ').' ar'?></span>
            </div>
            </div>
            
            <div clas="row pt-2" style="padding:10px 15px;">
                <div class="col-md-12">
                    <hr>
                    <h2><?=$comm1?> : 
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            $total_ca=0;
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],$date);//ca du jour du coach
                                                }
                                            }
                    ?>
                        <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2>
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus" value="Show/Hide" onClick="showHideDiv('divMsg4')"></i></h2>
                		<div id="divMsg4" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63!important;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm1));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
                                            <td><a href="detail-ca.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($main->ca_jour_coach($com['matricule'],$date),2,',',' ');?></td>
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
                 <div class="col-md-12">
                    <hr>
                    <h2 style="padding-bottom:10px"><?=$comm2?> :
                    <?php $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            $total_ca=0;
                                            if($com){
                                                foreach($com as $com){
                                                    $total_ca+=$main->ca_jour_coach($com['matricule'],date('Y-m-d'));//ca du jour du coach
                                                }
                                            }
                    ?>
                    <b class="text-right"><?=number_format($total_ca,2,',',' ').' Ar'?></b></h2> 
                    <h2 class="text-right" style="margin-top:-25px; color:blue;cursor:pointer"> <i class="fa fa-plus blue" value="Show/Hide" onClick="showHideDiv('divMsg3')" ></i></h2>
                    	<div id="divMsg3" style="display:none;padding:0px 0px">
                			<table class="table" style="background:#fff">
                			    <thead style="background:#e91e63 ;">
                			        <tr>
                			            <th class="fonttb" style="width:15%;">Matr</th>
                			            <th class="fonttb" style="width:50%;">Nom</th>
                			            <th class="fonttb" style="width:25%;">C A (*Ar)</th>
  
                			        </tr>
                			    </thead>
                			    <tbody>
                			        <?php
                                            $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `coach` LIKE ?";
                                            $com=$main->queryAll($sql,array($comm2));
                                            if($com){
                                            foreach($com as $com):
                                        ?>
                			        <tr>
 
                                                <td><a href="detail-ca.php?matricule=<?=$com['matricule']?>"><?=$com['matricule']?></a></td>
                                            <td><?=$com['Nom']." ".$com['Prenom']?></td>
                                            <td><?= number_format($main->ca_jour_coach($com['matricule'],date('Y-m-d')),2,',',' ');?></td>
                                    
                                        </tr>
                                        <?php endforeach; }else{ ?>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                
                                        </tr>
                                        <?php } ?>
                			         
                			    </tbody>
                			</table>
                		</div>
                </div>
            </div>
           
        </div>
    </div>
</div>
<script type="text/javascript">
			function showHideDiv(ele) {
				var srcElement = document.getElementById(ele);
				if (srcElement != null) {
					if (srcElement.style.display == "block") {
						srcElement.style.display = 'none';
					}
					else {
						srcElement.style.display = 'block';
					}
					return false;
				}
			}
		</script>
<?php include_once('footer.php');?>