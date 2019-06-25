

$('.js-delete-user').on('click',function(e){

var that = $(this);
var url = that.attr('href');
    e.preventDefault();
$('.popin').fadeIn();
var header="Voulez vous supprimer l'utilisateur suivant?";
var content="?";
var footer=document.createElement('button');
$('.popin .popin-header').append($("h2").html(header);
$('.popin .popin-content').append($("h2").html(content);
$('.popin .popin-footer').append($("button").addClass('btn').on('click',function(){
  if(url!=""){
       $.ajax({
           'url'   :url,
           'type'  :'POST',
           'data'  :'token',
           success : function(data, statut){
               console.log(data);
           }
       })
   }
}).html("Supprimer l\'utilisateur");

$('.popin .popin-footer').append($(button).addClass('btn').on('click',function(){
  $('.popin').fadeOut();
}).html('Annuler')

    console.log('suppression');
    var url = $(this).attr('href');

   if(url!=""){
        $.ajax({
            'url'   :url,
            'type'  :'POST',
            'data'  :'token',
            success : function(data, statut){
                console.log(data);
            }
        })
    }
    return false;
})




function remove(userId){


}
