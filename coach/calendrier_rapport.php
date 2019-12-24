<?php 
$titre = "Details du rapport";
include "header.php";
include_once('../include/include.php');

$coach=$_SESSION['matricule'];
$sql="SELECT `date`,`heure`,`description`,`ca_journaliere` FROM `rapport` WHERE `id_coach` LIKE ? AND `type` LIKE 'rapport de vente'";
$rapport=$main->queryAll($sql,array($coach));
$total_ca=0;

foreach($rapport as $rapport){
    $total_ca+=$rapport['ca_journaliere'];
}
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header" >
      <div class="container-fluid">
          <div class="row" style="margin-top:-10px">
              <div class="col-md-12" style="background:#fff;padding:5px 5px">
                  <ol class="breadcrumb" style="font-size:14px!important;padding-left:0px" >
                        <li class="active" style="padding:0px 5px" > <a href="mes_rapport.php" title="Accueil">Détails du rapport</a> &nbsp;&nbsp;> </b> </li>
                        <li style="padding:0px 5px">Rapport Mensuel - annexe</li>
                </ol>
              </div>
          </div>

        <div class="row" style="background:#fff;padding:0px 10px">
                   

                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="font-size:11px;">Date</th>
                        <th style="font-size:11px;">C.A (Ar)</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $c_a=0;
                            $tt=new dateTime();
                            $dta=$tt->format("t");
                            
                            for($i=1;$i<=$dta;$i++):
                                if($i<10){
                                    $testDim=$main_function->dimanche(date('Y-m')."-0".$i);
                                }else{
                                    $testDim=$main_function->dimanche(date('Y-m')."-".$i);
                                }
                                
                                //couleur du jour
                                            if($i==date('d')){
                                                $couleurjour="bg-success";
                                            }else{
                                                $couleurjour="";
                                            }

                                if($testDim=="Sun"){
                                 //echo 'style="background-color:red;color:#fff;"'; ?>
                                 <tr style="background-color:red;color:#fff;">
                                    <td style="font-size:10px;">
                                        <?php
                                            if($i<10){
                                               echo '0'.$i.'-'.date('m-Y');
                                            }else{
                                                echo $i.'-'.date('m-Y');
                                            }
                                            
                                        ?>
                                    </td>
                                    <td  class="text-center" style="font-size:10px;">
                                        -
                                    </td>
                                   
                                  </tr>
                                <?php    
                                }else{
                        ?>
                                <tr class="<?=$couleurjour?>">
                                    <td style="font-size:10px;">
                                        <?php
                                            if($i<10){
                                               echo '<a href="http://gestion-commerciale.in-expedition.com/coach/mes_rapport.php?date='.'0'.$i.'-'.date('m-Y').'">'.'0'.$i.'-'.date('m-Y').'</a>';;
                                            }else{
                                                echo '<a href="http://gestion-commerciale.in-expedition.com/coach/mes_rapport.php?date='.$i.'-'.date('m-Y').'">'.$i.'-'.date('m-Y').'</a>';
                                            }
                                            
                                        ?>
                                    </td>
                                    <td style="font-size:10px;">
                                            <?php 
                                                $tmp_=($i<10)?'0'.$i.'-'.date('m-Y'):$i.'-'.date('m-Y');
                                                $date_custom = new DateTime($tmp_);
                                                
                                                $sql_coach="SELECT `com_1`,`com_2` FROM `mes-accompagnement` WHERE `id_coach` LIKE ? AND `date_accomp` LIKE ?";
                                                $mes_commerciaux=$main->query($sql_coach,array($_SESSION['matricule'],date('Y-m-d')));
                                                
                                                $ca_total=0;
                                    
                                                    $ca_total=$main->ca_jour_coach($mes_commerciaux['com_1'],$date_custom->format('Y-m-d'))+$main->ca_jour_coach($mes_commerciaux['com_2'],$date_custom->format('Y-m-d'));
                                            
                                                
                                                echo number_format($ca_total,2,',',' ').' Ar ';
                                            ?>
                                    </td>
                                  </tr>
                      
                        <?php if($couleurjour=="bg-success"){
                                    break;
                              } 
                                    
                                }
                                $c_a=0;
                           endfor;
                        ?>
                    </tbody>
                  </table>
           </div>     
  </div>
</div>

  </div>
</div>

  </div>

<?php include "footer.php";?>