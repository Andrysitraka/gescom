
<style>
    label{
        font-weight: normal!important;
        font-size:12px!important;
    }
    blockquote{
        margin:0px 0px!important;
    }
    
</style>
<?php 
include_once("../include/include.php");
include_once("header.php");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <form method="POST" enctype="multipart/form-data" >
                        
<blockquote>
            <div class="md-form form-sm mb-2">
                <div class="row">
                    <div class="col-6">
                        <select class="form-control col-md-12 matricule form-control-sm IdEquipe">
                            <option hidden selected>Equipe</option>
                                <?php
                                $sql="SELECT * FROM `equipe`";
                                $variable=$main->queryAll($sql);
                                 foreach ($variable as $variable ):
                                ?>
                            <option><?=$variable['IdEquipe']?></option>
                                <?php endforeach;?>
                           </select>
                    </div>
                     <div class="col-6">
                        <input type="text" id="province" class="form-control form-control-sm province" placeholder="Province">
                    </div>
                   
                </div>
            </div>

            <div class="md-form form-sm mb-2">
                <div class="row" style="padding:0px 10px!important">
                    <div class="col-12">
                        <select name="Prix" id="Prix" class="form-control form-control-sm idMission" placeholder="Prix appliquer">
                            <option blocked>Mission</option>
                            <?php
                            $sql="SELECT `idMission`,`lieu` FROM `mission` WHERE 1";
                            $misson=$main->queryAll($sql);
                                if($misson):
                                  foreach($misson as $misson ):
                            ?>
                               <option value="<?=$misson['idMission']?>"><?=$misson['lieu']?></option>
                            
                            <?php
                                 endforeach;
                                   endif;
                            ?>
                        </select>
                    </div>
                    
                </div>
            </div>
            
            <div class="md-form form-sm mb-2">
                <div class="row">
                    <div class="col-4">
                        <label for="IdEquipe">Debut Mission</label>
                    </div>
                    <div class="col-8">
                        <input type="date" class="form-control  form-control-sm date_deb"  class="js-form-control" placeholder="Enter Date">
                    </div>
               </div>
            </div>
            <div class="md-form form-sm mb-2">
                <div class="row">
                    <div class="col-4">
                        <label for="IdEquipe">Fin Mission</label>
                    </div>
                     <div class="col-8">
                        <input type="date" class="form-control  form-control-sm date_fin"  class="js-form-control" placeholder="Enter Date">
                    </div>
                </div>
            </div>
</blockquote>
<br>
<blockquote>
    
            <div class="md-form form-sm mb-2">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control form-control-sm ville" placeholder="Ville"> 
                    </div>
                      <div class="col-6">
                        <input type="text" id="quartier" class="form-control form-control-sm quartier" placeholder="Quartier">
                    </div>
                </div>
            </div>

            <div class="md-form form-sm mb-2">
            <div class="row">
                <div class="col-6">
                    <select class="form-control col-md-12 matricule form-control-sm Panier">
                        <option hidden selected>Panier</option>
                        <?php
                            $sql="SELECT DISTINCT `desigbation` FROM `panier` WHERE 1";
                            $panier=$main->queryAll($sql);
                            foreach ($panier as $panier ):
                            ?>
                            <option><?=$panier['desigbation']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            <div class="col-2">
                <label for="IdEquipe">Date</label>
            </div>
             <div class="col-4">
                        <input type="date" id="date" class="form-control form-control-sm date">
                    </div>
            </div>
            
          <!--  <div class="col-12 mt-2" style="padding-left: 0px!important;" >
                 <input type="file" class="image uploadFile" name="image" value="Upload Photo" >
                 <input type="submit" value="ajouter" class="AjoutphotoCarte">
                 
            </div>
        -->

            <div class="md-form form-sm mb-4" style="margin-top:10px;">
                <div class="row justify-content-center">
                    <div class="col-4 imgUp">
                        
                            <div class="imagePreview text-center" style="height:75px;"></div>
                            <label class="btn btn-primary">
                            Photo<input type="file" class="uploadFile image img" name="image" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                            
                            </label>
                            <input type="submit" value="ajouter" class="AjoutphotoCarte btn btn-default">
                        
                    </div>


                </div>
            </div>
            <!--test-->
           <!-- <div class="row justify-content-center">
                <div class="col-md-8 imgUp">
                    <div class="imagePreview text-center" ></div>
                    <label class="btn btn-primary">
                     Photo<input type="file" class="uploadFile image AjoutphotoCarte" name="image" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                    </label>
                 </div>

             </div>
             -->
            
            <!-- ******-->
            <hr>
            <button  class="btn btn-success savePlaning pull-right m-2">Valider</button>
            <br>
             <br>
            
            </blockquote>    
         
            
            <br>
            <br>
            <hr>
            <div class="form-group" style="margin-top:20px;">
            <div class="table-responsive">
            <table class="table table-bordered table-striped display" id="myTable">
            <thead class=" table-dark">
              <tr>
                 <th>Date</th>
                 <th>Ville</th>
                 <th>Province</th>
                 <th>Quartier</th>
                 <th>Panier</th>
              </tr>
            </thead>
                <tbody class="tbody">
                </tbody>
            </table>
            </div>
<div id="monModal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title titre"></h4>
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            </div>
	            <div class="modal-body">
	                <p class="text-warning text-lg">Remplir les champs vides</p>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	            </div>
	        </div>
	    </div>
	</div>
</div>
</div>
</form>
</div>
</div>

<?php include "footer.php";?>