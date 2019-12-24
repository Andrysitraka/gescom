<?php 
$titre = "NOUVEAU PANIER";
include "header.php";

?>
<style>
        .ui-autocomplete{
            background:red;
            list-style-type:none;
            color:#fff;
        }
        .ui-autocomplete >li >a{
            color:#fff;
        }
                .produit{
        	background:white;
        	border-radius: 5px; 
        	min-height: 100;
        }
        label{
            font-size:14px;
            font-weight:normal!important;
        }
        blockquote{
            margin-right:0px!important;
            margin-left:0px!important;
        }
        th{
            font-size:14px;
            font-weight:normal!important;
        }
        td{
            font-size:10px;
        }
        
        td > i{
            font-size:16px!important;
            color:red!important;
        }

</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-top:5px;margin-right:0px!important;margin-left:0px!important;">
                    
                         <div class="col-md-12" style="background:#fff;padding:20px 5px">
                               <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12 col-12">
                                  <input type="text" class="form-control designation"  placeholder="Nom  du nouveau panier">
                                </div>
                                <div class="form-group col-md-8 col-sm-8 col-8">
                                  <input type="text" class="form-control code_produit produit"  placeholder="Produit du panier">
                                </div>
                                <div class="form-group col-md-4 col-sm-4 col-4">
                                    <buttom class="btn btn-primary action_ajout" style="font-size:12px;color:#fff;cursor:pointer;margin-top:3px">Ajouter</buttom>
                                </div>
                          </div>
                         </div>
                        <div class="table-responsive" style="padding:0px 10px;background:#fff">
                        <table class="table infoProduit">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Code </th>
                                  <th scope="col">Désignation</th>
                                  <th scope="col">Qtt</th>
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody>
                               
                              </tbody>
                            </table>
                          <hr>
                             <button type="submit" class="btn btn-success pull-right enregistre_panier pull-right mb-3">Créer le panier</button> 
                    </div>
            </div>
           
        </div>
    </div>
</div>


   <?php include "footer.php";?>
