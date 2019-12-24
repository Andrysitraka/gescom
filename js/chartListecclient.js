$(document).ready(function(){
var html='<tr><td class="text-center"><div class="spinner-border spinner-border-sm"  style="width: 5rem; height: 5rem;" role="status"> <span class="sr-only">Loading...</span></div></td></tr>';
$('.contList').empty().append(html); 

    $.post('../fonction/listedesClient.php',function(data){
        $('.contList').empty().append(data);
    });
    
    
    	
    
});