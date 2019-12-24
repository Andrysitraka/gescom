$(document).ready(function(){
    var   Heb , Rest, Carb, Autre, description;
    $('#Heb').on('change',function(){
      var Hbmt = $('.Hbmt').html();
      $('#Fact1').empty().append(Hbmt);
    });
    $('#Rest').on('change',function(){
       var Rest = $('.Rest').html();
       $('#Fact2').empty().append(Rest);
    });
    $('#Carb').on('change',function(){
       var carb = $('.carb').html();
       $('#Fact3').empty().append(carb);
    });
    $('#Autre').on('change',function(){
       var aut = $('.aut').html();
       $('#Fact4').empty().append(aut);
    });
    $('.annu').on('click',function(){
                      $('#Fact1').html('');
                      $('#Fact2').html('');
                      $('#Fact3').html('');
                      $('#Fact4').html('');

    });
    $('.enregistrer').on('click',function(ev){
        ev.preventDefault();
        if($('#Heb').val()==='' || $('#Rest').val()==='' || $('#Carb').val()==='' || $('#Autre').val()==='' ){
            $.alert('Veuillez remplir tous les champs');
        }else if(Heb < 0 || Rest < 0 || Carb < 0 || Autre < 0 || Heb > 999999 || Rest > 999999 || Carb > 999999 || Autre > 999999){
             $.alert('Montant invalide');
         }

         description = $('.description').val();
         Heb = $('#Heb').val();
         Rest= $('#Rest').val();
         Carb= $('#Carb').val();
         Autre = $('#Autre').val();  
         
       if(description.length < 20){
           $.alert('Description trop courte');
       }else{
           $.confirm({
                title: 'Confirmation',
                content: 'Etes-vous sûre de vouloir enregistrer?',
                buttons: {
                    Oui: function () {
                      var Fact1 = $('#Fact1').html();
                      var Fact2 = $('#Fact2').html();
                      var Fact3 = $('#Fact3').html();
                      var Fact4 = $('#Fact4').html();
                      var tabFact= [Fact1,Fact2,Fact3,Fact4];
                        $.post('../fonction/ajout_depense_total.php',{Heb:Heb,Rest:Rest,Carb:Carb,Autre:Autre,description:description,tabFact:tabFact},function(data){
              if(data){
                 // $('#infos').modal('show');
                 // return data;
              }else{
                  $.alert('Non enregistré');
              }
          });
                $('.description').val('');
                $('#Heb').val('');
                $('#Rest').val('');
                $('#Carb').val('');
                $('#Autre').val('');
                $('.im').html('');
                $('#Fact1').html('');
                $('#Fact2').html('');
                $('#Fact3').html('');
                $('#Fact4').html('');  
           
                        $.dialog({
                                    title: '',
                                    content: 'Merci ! <i class="fa fa-check text text-success" aria-hidden="true"></i>',
                                });
                    },
                    Non: function () {
                        $.alert('Veuillez réessayer');
                    }
                }
                });
           
       }
    });

    

    
    //Depense du jour
  /*             var j=1;
               var designation,cout,type;
    $('.ajout_dps').on('click',function(e){
        e.preventDefault();
     if($('.type').val() === '' || $('.cout').val() === '' || $('.Description').val() === '' ){
            alert("Veuillez remplir les champs vides");
        }else if($('.cout').val() < 100 || $('.cout').val() > 99999){
            alert('Montant invalide');
        }
        else if($('.Description').val().length<15){
            alert('Description trop courte ');
        }else{
       designation=$('.Description').val(),cout=$('.cout').val(), type=$('.type').val();
        $('.Description').val(' ');
        $('.cout').val(' ');
        $('.type').val(' ');
        
         var files = $('.uploadFile')[0].files[0];
         var reader = new FileReader();
            reader.readAsDataURL(files);
            reader.onload = function(){
        $('.tbody').append("<tr class='depenseTot'><td class='text-center'><img class='img' src='"+reader.result+"' style='height: 25px; width: 25px;'><input type='file' name='Mafichier'  hidden class='img' value='"+reader.result+"' style='width: 0px;height: 0px;overflow: hidden;'></td><td class='text-center'>"+j+"</td><td class='text-center motifs'>"+type+"</td><td hidden>"+designation+"</td><td class='text-center'>"+cout+" Ar </td><td class='text-center'><i class='close deleDep'>&times;</i></td></tr>");
            j+=1;
            };
   
        }
        deletetable();
   });*/
   
   $('.objet').on('change',function(){

    if($(this).val()=="Produit"){
        $('.contProduit').collapse('show');

    }else{
        $('.contProduit').collapse('hide');
    }
});

var pro;
   
 $('.ajout_dp').click(function (e) {
     e.preventDefault();
        var objet=$(".objet").val();
        var cout=$(".cout").val();
        var designation =$(".designation").val().split('|');
        var comment=$(".comment").val();

if($(".objet").val()=="Produit"){
    var qttProTab=$(".qttProTab").val();
    var idproduitTab=$(".idproduitTab").val().split('|');
    pro=idproduitTab[0] +" : "+qttProTab;
}else{
     pro ="null";

}


     $(".tbody").append('<tr><td class="description">'+designation[0]+'</td><td>'+objet+'</td><td>'+pro+'</td><td>'+cout+'</td><td><a href="#"><i  class="fa fa-close dark deleDep"></i></a></td></tr>');
     deleDep();

 });
 
$(".idproduit .idUsers").focus(function(){
    alert();
});
 
 $('.idproduit').autocomplete({
    source:"../fonction/retourProduit.php"
});
$('.idUsers').autocomplete({
    source:"../fonction/retourPersonnel.php"
});

 $('.btn-manque').on('click',function (e) {
     e.preventDefault();
 $('.description').each(function(){
    var type="",description="",matricule="",montant="",idproduit="";
    matricule=$(this).html();
    type=$(this).next().html();
    idproduit=$(this).next().next().html();
    description=$(this).next().next().next().html();
    montant=$(this).next().next().next().html();
  $.post("../fonction/manque.php",{type:type,description:description,matricule:matricule,montant:montant,idproduit:idproduit},function(){
      
  });  
  
});
 });
 
 //COLLAPSE DEPENSE
$('.R').on('click',function(){
    $('.form-depence').collapse('toggle');
});
//BOUTON ANNULER DEPENSE 
$('.Suppr').on('click',function(){
    j=1;
    $('.tbody').html('');
});





function deleDep(){
 $('.deleDep').on('click',function(e)  {
    e.preventDefault();
    $(this).parent().parent().parent().remove();
});
}
   
   

   
  /*  $('.sauver').on('click',function(event){
        event.preventDefault();
        var val = confirm("Voulez-vous enregistrer?");
        if(val === true){
          ajouter_depense();  
           $('.tbody').html(' ');
        }else{
            alert('Revoir votre document');
        }
    });
    function ajouter_depense(){
       $('.motifs').each(function(){
           var type=$(this).html();
           var cout=$(this).next().next().html();
            var Description = $(this).next().html();
            console.log(Description);
          $.post('../fonction/ajout_depense_total.php',{type:type,cout:cout,Description:Description},function(data){
              if(data.erreur=='true'){
                  alert('Impossible d\'enregistrer');
              }else{
                  $('#infos').modal('show');
              }
          });
       }); 
    }
function deletetable(){
     $('.deleDep').on('click',function(e){
        e.preventDefault();
        j-=1;
        $(this).parent().parent().remove();
        if(j<1){
         j=1;   
        }
        
    });
} */
                // PAGINATION DES MANQUES
              var $pagination = $('#pagination'),
            totalRecords = 0,
            records = [],
            displayRecords = [],
            recPerPage = 6,
            page = 1,
            totalPages = 0;
            $.ajax({
                  url: "../fonction/historique_des_manques.php",
                  async: true,
                  dataType: 'json',
                  success: function (data) {
                              records = data;
                              totalRecords = records.length;
                              totalPages = Math.ceil(totalRecords / recPerPage);
                              apply_pagination();
                  }
            });
              
              function generate_table() {
                  var tr,j=1,p=1;
                  var test="";
                 
                  $('#emp_body').html('');
                  for (var i = 0; i < displayRecords.length; i++) {
                        tr = $('<tr/>');
                        if(test==displayRecords[i].date){
                            test="";
                            test=displayRecords[i].date;
                            tr.append("<td>&nbsp;</td><td>" + displayRecords[i].heure + "</td> <td>" + displayRecords[i].type + "</td> <td>" + displayRecords[i].description + "</td> <td>" + displayRecords[i].ca_journaliere + "</td> <td>" + displayRecords[i].id_coach + "</td>");
                            p++;
                            
                        }else{
                             var col=".col"+j;
                            

                            p=1;
                             tr.append("<td class='col"+j+"'>" + displayRecords[i].date + "</td><td>" + displayRecords[i].heure + "</td> <td>" + displayRecords[i].type + "</td> <td>" + displayRecords[i].description + "</td> <td>" + displayRecords[i].ca_journaliere + "</td> <td>" + displayRecords[i].id_coach + "</td>");
                            //   tr.append("<td>" + displayRecords[i].employee_salary + "</td>");
                           // tr.append("<td>" + displayRecords[i].employee_age + "</td>");
                             test="";
                            test=displayRecords[i].date;
                            $(''+col+'').attr('rowspan',''+p+'');
                            console.log($().html());
                             j++;
                        }
                     $('#emp_body').append(tr);    
                  }
            }
              
              function apply_pagination() {
                  $pagination.twbsPagination({
                        totalPages: totalPages,
                        visiblePages: 3,
                        prev:'<',
                        next:'>',
                        first:'<<',
                        last:'>>',
                        onPageClick: function (event, page) {
                              displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                              endRec = (displayRecordsIndex) + recPerPage;
                              displayRecords = records.slice(displayRecordsIndex, endRec);
                              generate_table();
                        }
                  });
            }  
                
    
});