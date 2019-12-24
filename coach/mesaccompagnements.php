<?php
$titre = "Mes accompangements";
include_once("../include/include.php");
include("header.php");
$sql ="SELECT * FROM `mes-accompagnement`  where id_coach  LIKE ? ORDER BY date_accomp ASC";
$accompagnement = $main->queryAll($sql,array($_SESSION['matricule']));

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
    
    p{
           margin-bottom: 2px!important;
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
                        <table  class="table table-striped" style="font-size:12px; margin-top: 10px;">
                            <thead style="background:#33b5e5;color:#fff;font-weight:normal!important">
                              <tr>
                                
                                <th style="width:50%">Date</th>
                                <th style="width:50%;margin-right:5px" class="text-center">Commerciaux </th>
                              </tr>
                            <tbody>
                                <?php
                                $i=0;
                                foreach($accompagnement as $row) {
                                          $dt= $row['date_accomp'];
                                          $date = new DateTime($dt);
                                          if($date->format('d-M-Y')==date('d-M-Y')){
                                              $couleur='bg-success';
                                          }else{
                                              $couleur='';
                                          }
                                ?>
                                    <tr class="<?=$couleur?>">
                                        <td class="align-middle"><?php
                                          
                                          echo $date->format('d-M-Y');
                                       
                                       $d?></td>
                                        <td  class="align-middle">
                                           
                                            
                                            <a href="#" data-toggle="modal" data-target="#<?php echo $row['com_1'].$i;?>" style="margin-right:20px">
                                                <?php echo $row['com_1'];?> 
                                            </a>
                                            <?php
                                                    $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `matricule` LIKE ?";
                                                    $commerciale=$main->query($sql,array($row['com_1']));
                                            ?>
                                            <div class="modal fade" id="<?php echo $row['com_1'].$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle">Détails</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body text-dark">
                                                          <div class="card" style="width: 100%;">
                                                              <img class="card-img-top" src="../image/personnel/<?=$row['com_1'].".jpg"?>" alt="<?=$commerciale['Nom']." ".$commerciale['Prenom']?>" style="height:200px;object-fit:cover">
                                                              <div class="card-body">
                                                                <div class="">
                                                                    <p class="card-text"><?=$commerciale['Nom']." ".$commerciale['Prenom']?></p>
                                                                    <p><?php $tel=str_split($commerciale['Contact']);
                                                                            echo $tel[0].$tel[1].$tel[2].' '.$tel[3].$tel[4].' '.$tel[5].$tel[6].$tel[7].' '.$tel[8].$tel[9]; 
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <p>
                                                                   <span class="">Tranche d'heure:</span> <span class="">8h 30 à 10h</span>
                                                                </p>
                                                                
                                                                 <p>
                                                                   <span class="">Note d'évaluation :</span> 
                                                                        <span class="text-success"> <?=$main_function->moyenne_evaluation($row['com_1'],$date->format('Y-m-d'));?>
                                                                   </span>
                                                                </p>
                                                                
                                                                  <p>
                                                                   <span class="">Vente d'accompagnement </span> <span class="text-success"><?=number_format($main->ca_accompagnement($row['com_1'],$date->format('Y-m-d')),2,',',' ')." Ar"?></span>
                                                                </p>
                                                                    
                                                              </div>
                                                            </div>
                                                        
                                                      </div>
                                                    
                                                    </div>
                                                  </div>
                                                </div>
                                           
                                            | 
                                            <?php $i++; ?>
                                            <a href="#" data-toggle="modal" data-target="#<?php echo $row['com_2'].$i;?>"  style="margin-left:20px">
                                                <?php echo $row['com_2'];?>
                                            </a>
                                            <?php
                                                    $sql="SELECT `matricule`,`Nom`,`Prenom`,`Contact` FROM `personnel` WHERE `matricule` LIKE ?";
                                                    $commerciale=$main->query($sql,array($row['com_2']));
                                            ?>
                                            <div class="modal fade" id="<?php echo $row['com_2'].$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle">Evaluez votre commerciale</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body text-dark" >
                                                            <div class="" style="border:solid 1px #ccc; border-radius:5px;padding:5px 10px">
                                                                <h3 for="presentation" >Présentation</h3>
                                                                <div class="form-row mb-2 mr-sm-2" >
                                                                    <input type="text" class="form-control col-12" placeholder="Point Fort" >
                                                                    <input type="text" class="form-control  col-12 mt-1" placeholder="Point à améliorer"  >
                                                                   <input type="number" class="form-control note_presentation text-center note col-10 mt-1" id="presentation" maxLength="1" placeholder="Note">
                                                                    <div class="input-group-prepend  mt-1">
                                                                      <div class="input-group-text">&nbsp;/&nbsp;5</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          
                                                           <div class="mt-2" style="border:solid 1px #ccc; border-radius:5px;padding:5px 10px">
                                                                <h3  >Argumentaire</h3>
                                                                <div class="form-row mb-2 mr-sm-2" >
                                                                    <input type="text" class="form-control col-12" placeholder="Point Fort" >
                                                                    <input type="text" class="form-control  col-12 mt-1" placeholder="Point à améliorer"  >
                                                                   <input type="number" class="form-control note_argumentaire text-center note col-10 mt-1" id="argumentaire" maxLength="1" placeholder="Note">
                                                                    <div class="input-group-prepend  mt-1">
                                                                      <div class="input-group-text">&nbsp;/&nbsp;5</div>
                                                                    </div>
                                                                </div>
                                                          </div>
                                                          
                                                           <div class="mt-2" style="border:solid 1px #ccc; border-radius:5px;padding:5px 10px">
                                                          <h3 >Cible</h3>
                                                                <div class="form-row mb-2 mr-sm-2" >
                                                                    <input type="text" class="form-control col-12" placeholder="Point Fort" >
                                                                    <input type="text" class="form-control  col-12 mt-1" placeholder="Point à améliorer"  >
                                                                   <input type="number" class="form-control note_cible text-center note col-10 mt-1" id="cible" maxLength="1" placeholder="Note">
                                                                    <div class="input-group-prepend  mt-1">
                                                                      <div class="input-group-text">&nbsp;/&nbsp;5</div>
                                                                    </div>
                                                                </div>
                                                          </div>
                                                          
                                                           <div class="mt-2" style="border:solid 1px #ccc; border-radius:5px;padding:5px 10px">
                                                            <h3>Comportement</h3>
                                                                <div class="form-row mb-2 mr-sm-2" >
                                                                    <input type="text" class="form-control col-12" placeholder="Point Fort" >
                                                                    <input type="text" class="form-control  col-12 mt-1" placeholder="Point à améliorer"  >
                                                                   <input type="number" class="form-control note_comportement text-center note col-10 mt-1" id="comportement" maxLength="1" placeholder="Note">
                                                                    <div class="input-group-prepend  mt-1">
                                                                      <div class="input-group-text">&nbsp;/&nbsp;5</div>
                                                                    </div>
                                                                </div>
                                                          
                                                          </div>
                                                          
                                                           <div class="mt-2" style="border:solid 1px #ccc; border-radius:5px;padding:5px 10px">
                                                                <h3 >Moyenne</h3>
                                                          <div class="input-group mb-2 mr-sm-2">
                                                            
                                                             <input type="text" class="form-control note_moyenne text-center" id="moyenne" disabled placeholder="0">
                                                            <div class="input-group-prepend">
                                                              <div class="input-group-text">&nbsp;/&nbsp;5</div>
                                                            </div>
                                                          </div>
                                                          </div>
                                                        </form>
                                                        
                                                      </div>
                                                       <div class="modal-footer footer">
                                                    <button type="button" class="btn btn-secondary clear_note" data-dismiss="modal">Fermer</button>
                                                    <button type="button" class="btn btn-primary save_evaluation" data-dismiss="modal">Enregistrer</button>
                                                  </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            
                                            </td>
                                    </tr>
                               <?php $i++; } ?>
                               
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div><!-- /.row -->
        </div>
    </div>
</div>
<?php include("footer.php");


?>