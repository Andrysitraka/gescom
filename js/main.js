$(document).ready(function(){
    /*$('.btn-login').on('click',function(event){
        event.preventDefault();
         var idVP=$('.input-user').val();
         var pass=$('.input-mot-pass').val();
     if (idVP=="" || pass=="") {
          $('.alert-login').slideDown();
     }else{
        $.post('fonction/login.php',{idVP:idVP,pass:pass},function(data){
              if(data=="false"){
                $('.alert-login-false').slideDown();
              }
         });
     }
});*/
     $('.input-login').on('focus',function(){
        $('.alert-login').slideUp();
        $('.alert-login-false').slideUp();
        $(this).val("");
     });
     
/*******************PRIVILEGE**********************************/

statutBimestiel();

function statutBimestiel(){
    var statutBimestriel=$('.statutBimestriel').text();
    if(statutBimestriel=='Beginner'){
         text=$('.beg').html();
        $('.privStatBimestriel').empty().append(text);
        
    }else if(statutBimestriel=='Intermediate'){
         text=$('.inter').html();
        $('.privStatBimestriel').empty().append(text);
    }else if(statutBimestriel=='Advanced'){
          text=$('.adv').html();        
         $('.privStatBimestriel').empty().append(text);
    }else if(statutBimestriel=='Confirmed'){
         text=$('.conf').html();
        $('.privStatBimestriel').empty().append(text);
    }else if(statutBimestriel=='Professionnal'){
         text=$('.pro').html();
        $('.privStatBimestriel').empty().append(text);
    }else if(statutBimestriel=='Expert'){
        text=$('.exp').html();
        $('.privStatBimestriel').empty().append(text);
    }
}

$('#privilege2').on('click',function(event){
    event.preventDefault();
     var statAn=$('.statAnnuelle').text();
     console.log(statAn);
    if(statAn=='Natural'){
         text=$('.nat').html();
        $('.privStatAnnuelle').empty().append(text);
        
    }else if(statAn=='Bronze'){
         text=$('.br').html();
        $('.privStatAnnuelle').empty().append(text);
        
    }else if(statAn=='Silver'){
         text=$('.sil').html();
        $('.privStatAnnuelle').empty().append(text);
    }else if(statAn=='Gold'){
         text=$('.gold').html();
        $('.privStatAnnuelle').empty().append(text);
    }
});

//////STATUT COULEUR ACTIVER

activer('.proStat');

function activer(progress){
    
    var statB=$('.statB').text();
    var statA=$('.statA').text();
  // console.log(statB);
    
   $(progress).each(function(){
       //console.log($(this).text()==statB);
       
      if($.trim($(this).text())==$.trim(statB) || $.trim($(this).text())==$.trim(statA)){
     
           $(this).attr('style',$(this).attr('style')+';opacity:1;color:white!important;width:50%;border-bottom: 1px solid;padding:3px;box-shadow: 0px 0px 5px 0px #888888;');
           
           if( $.trim($(this).text())=='Beginner'){
                $('.privStatut').empty().append("<li>Réduction de sanctions téléphoniques:20% </li>");    
           }else if( $.trim($(this).text())=='Intermediate'){
               $('.privStatut').empty().append("<li>Reduction de sanctions téléphoniques:30% </li><li>Réduction de sanctions sur absence:20%</li><li>Réduction de Malus:20%</li>");    
           }
           else if( $.trim($(this).text())=='Advcanced'){
               $('.privStatut').empty().append("<li>Bonus mensuel:5 000,00 AR </li><li>Jour de repos supplémentaire après mission*: 1 jour</li><li>Réduction de sanctions téléphoniques:40%</li><li>Réduction de sanctions sur absence:30%</li><li>Réduction de Malus:30%</li>");    
           }           
           else if( $.trim($(this).text())=='Confirmed'){
               $('.privStatut').empty().append("<li>Bonus mensuel:10 000,00 AR </li><li>Jour de repos supplémentaire après mission*: 2 jours</li><li>Réduction de sanctions téléphoniques:60%</li><li>Réduction de sanctions sur absence:50%</li><li>Réduction de Malus:50%</li><li>Réduction de frais de transport en cas  d'abandon sur mission:20%</li>");    
           }
          else if( $.trim($(this).text())=='Professionnal'){
               $('.privStatut').empty().append("<li>Bonus mensuel:20 000,00 AR </li><li>Jour de repos supplémentaire après mission*: 3 jours</li><li>Réduction de sanctions téléphoniques:70%</li><li>Réduction de sanctions sur absence:70%</li><li>Réduction de Malus:80%</li><li>Réduction de frais de transport en cas  d'abandon sur mission:40%</li>");    
           }           
          else if( $.trim($(this).text())=='Expert'){
               $('.privStatut').empty().append("<li>Bonus mensuel:30 000,00 AR </li><li>Jour de repos supplémentaire après mission*: 5 jours</li><li>Réduction de sanctions téléphoniques:75%</li><li>Réduction de sanctions sur absence:75%</li><li>Réduction de Malus:100%</li><li>Réduction de frais de transport en cas  d'abandon sur mission:60%</li><li>Priorité sur avances sur salaire à hauteur de _ _ pourcent du salaire en cours:60%</li>");    
           }
           else{

           }           
  
       }else{
           $(this).attr('style',$(this).attr('style')+';opacity:0.2');
           
          
           
               var test=$.trim($(this).text());
               
                var res = test.substring(0, 3);
               //console.log(res);
            $(this).empty().append(res);     

              /*var long=test.length; 
              var x=test.split("B");
               console.log(x[1]);*/
           
       } 
    });
}



privAnnuelle();

//FONCTION MONPRIVILEGE ANNUELLE

function privAnnuelle(){


           
           if( $.trim($('.statA').text())=='Natural'){
                $('.privStatut1').empty().append("<li>Aucun</li>");    
           }else if( $.trim($('.statA').text())=='Bronze'){
               $('.privStatut1').empty().append("<li>Avances spéciales annuelles remboursables sur 2 mois:50 000,00 Ar</li>");    
           }
           else if( $.trim($('.statA').text())=='Silver'){
               $('.privStatut1').empty().append("<li>Avances spéciales annuelles remboursables sur 4 mois:100 000,00 Ar</li>");    
           }           
           else if( $.trim($('.statA').text())=='Gold'){
               $('.privStatut1').empty().append("<li>Avances spéciales annuelles remboursables sur 6 mois: 360 000,00 Ar</li>");    
           }else{
                $('.privStatut1').empty().append("<li>Avances spéciales annuelles remboursables sur 6 mois: 360 000,00 Ar</li>");    
           }
}




/*******FIN DE READY**************/
});
