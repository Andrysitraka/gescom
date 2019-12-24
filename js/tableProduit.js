$(document).ready(function () {

retourProduit("Tout","Tout");


$('.fammille').on('change',function(){
    var famille=$(this).val();
    $.post('../fonction/groupeProduit.php',{famille:famille},function(data){
        $('.groupe').html('').append(data);
    });
    retourProduit("Tout",famille);
});

$('.groupe').on('change',function(){
   var famille=$('.fammille').val();
   var groupe=$(this).val();
   
   retourProduit(groupe,famille);
   
});



function retourProduit(groupe,famille){
 $.ajax({
        url: "../fonction/listeProduit.php",
        async: true,
        type :"GET",
        dataType: 'json',
        data:"groupe="+groupe+"&famille="+famille,
        success: function (data) {
                 $('#emp_body').html('');
                  for (var i = 0; i < data.length; i++) {
                    tr = $('<tr/>');
                    tr.append("<td style='padding:5px 0px 0px 0px;'><ul class='list-group'><li class='list-group-item'><div class='row'><div class='col-8 text-left'> <a href='?page=information_sur_produit&codeProduit="+data[i].idProduit+"'><p style='font-size:11px;'><strong>" + data[i].idProduit +"</strong><br/>"+ data[i].designation+"<br/>"+ data[i].quantite +"</a></p></div><div class='col-4'><a href='../image/produit/"+data[i].idProduit +".jpg' data-lightbox='roadtrip' title='"+data[i].designation+"'><img id='myImg' class='img-thumbnail img-fluid img-produit' src='../image/produit/"+data[i].idProduit +".jpg' alt=Snow' style='width: 71px; height: 71px; padding: 3px;'></a></div></div></li></ul></td>");
                    $('#emp_body').append(tr);
                    demo();  
                } 
                    
        
                  
        }
  });
   
   
 function demo(){
$("#demo").on("keyup", function() {
  var value = $(this).val().toLowerCase();
  $("#emp_body tr").filter(function() {
     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});
}
demo();  
   
}                    










});

