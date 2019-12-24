<script>
function chartDoughnut(id){
        var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};
		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						randomScalingFactor(),
						randomScalingFactor()
					],
					backgroundColor: ['#D3D3D3','#e08396'
					],
					label: 'Dataset 1'
				}],
			},
			options: {
			    cutoutPercentage: 80,
				responsive: true,
				legend: {
					display: false,
				},
				title: {
					display: false,
					
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};

		
			var ctx = document.getElementById(id).getContext('2d');
			window.myDoughnut = new Chart(ctx, config);
}    
    
</script>
<?php
include_once('../include/include.php');
$sql="SELECT `codeClient`,`Nom`,`Prenom`,`codevp`,`contact`,`ville`,`quartier` FROM `clientTr` WHERE `codevp` LIKE ? ORDER By `Nom`";
$client=$main->queryAll($sql,array($_SESSION['matricule']));
                        if($client):
                         foreach ($client as $client):
                    
                        ?>
                                    <tr>
                                        <td class="text-center" style="padding:0px;">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">                
                                       <div class="row">
                                           <div">       
                                            
                                            <?php if(file_exists("../image/client/".$client['codeClient'].".jpg")){ ?>
                                                <a href="../image/client/<?=$client['codeClient']?>.jpg" data-lightbox="roadtrip" title="
                                                <div class='text-center'>
                                                    
                                                    <p class='text-center' style='font-size:12px;'>
                                                        <span class='text-center'><?=$client['codeClient']." ";?></span><br/><hr/>
                                                        <span class='text-info'>Nom  et Prénom <?=" : ".$client['Nom']." "?><?=" ".$client['Prenom']." "?></span><br/>
                                                        Contact : <?php 
                                                        $contact=str_split($client['contact']);
                                                        echo "+261"." ".$contact[1].$contact[2]." ".$contact[3].$contact[4]." ".$contact[5].$contact[6].$contact[7]." ".$contact[8].$contact[9];
                                                        
                                                        ?><br/>
                                                        Quartier:<?= $client['quartier'];?><br/>
                                                        Ville <?= " : ".$client['ville']." "?>
                                                    </p>
                                                </div> 
                                                ">
                                             
                                                        
                                                    <img src="../image/client//<?=$client['codeClient']?>.jpg" alt="Photo client sur terrain" class="img-thumbnail" style="width:100px;height:100px;">
                                                </a>
                                            <?php } else { ?>
                                                <a href="http://magesty.in-expedition.com/img/photoclient/CLT-pardefaut.jpg" data-lightbox="roadtrip" title="
                                                <div class='text-center'>
                                                    
                                                    <p class='text-center' style='font-size:12px;'>
                                                        <span class='text-center'><?= " ".$client['codeClient']." ";?></span><br/>
                                                        <a href='#'><span class='text-info'>Nom  et Prénom <?=" : ".$client['Nom']." "?><?=" ".$client['Prenom']." "?></span></a><br/>
                                                        Contact : <?php 
                                                        $contact=str_split($client['contact']);
                                                        echo "+261"." ".$contact[1].$contact[2]." ".$contact[3].$contact[4]." ".$contact[5].$contact[6].$contact[7]." ".$contact[8].$contact[9];
                                                        
                                                        ?><br/>Quartier:<?= $client['quartier'];?><br/>
                                                        Ville <?= " : ".$client['ville']." "?>
                                                    </p>
                                                </div>">
                                                    <img src="http://magesty.in-expedition.com/img/photoclient/CLT-pardefaut.jpg" alt="Photo client sur terrain" class="img-thumbnail" style="width:100px;height:100px;">
                                                </a>
                                                  
                                           
                                     </div>
                                       <div style="width:70px;" class="text-center">
                                           <span style="font-size:11px">Bronze</span>
                                              <canvas style="width:100%;" id="<?=$client['codeClient']?>"></canvas>
                                                 
 <script>
    var id="<?=$client['codeClient']?>";
    chartDoughnut(id);
</script>               
                                            </div><div style="padding:0px;">     
                                                
                                           <?=$client['codeClient']?><br/>
                                           <a href="?page=detailClientSurTerrain&codeClient=<?=$client['codeClient']?>"><?=$client['Nom'] ?> <?=" ".$client['Prenom']." "?></a><br/>
                                           <?=$client['ville']?><br/>
                                           <?= $client['quartier'];?><br/>
                                           <?php
                                                $contact=str_split($client['contact']);
                                                        echo "+261"." ".$contact[1].$contact[2]." ".$contact[3].$contact[4]." ".$contact[5].$contact[6].$contact[7]." ".$contact[8].$contact[9];
                                           ?>
                                           </div> 
                                      </div>       
                                           </div>
                                                 </li>
                                                </ul>
                                                
                               
                                          
	                                              
                              
                                            <?php } ?>    
                                        </td>
                                      
                                        
                                    <tr>
                       <script>
                           
                           
                       </script>
                            <?php
                             
                                  endforeach;
                                endif;
                            ?>
                           