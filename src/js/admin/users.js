

$('.js-delete-user').on('click',function(e){

    e.preventDefault();
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