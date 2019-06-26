

$(document).ready(function(){


$('.js-delete-user').on('click',function(e){
    e.preventDefault();
    //$('.popin').append($('div').html('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'))

    var that = $(this);
    var url = that.attr('href');
    var header="Voulez vous supprimer l'utilisateur suivant?";
    var content="";
    var btnDelete = document.createElement('button');
    var btnCancel = document.createElement('button');
    var divHeader = document.createElement('div');
    var divContent = document.createElement('p');

    $('.popin').fadeIn();
    $('body').toggleClass('no-scroll');
    $(btnDelete).attr({
    "class":"btn danger",
    "href":url,
    })
    .html('Supprimer l\'utilisateur')
    .on('click',function(){
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
    });

    $(btnCancel).attr({
            "class":"btn default"
        })
        .html('Annuler')
        .on('click',function() {
            $('.popin').fadeOut('fast');
            $('.popin-dialog .popin-header').html('');
            $('.popin-dialog .popin-content').html('');
            $('.popin-dialog .popin-footer').html('');
            $('body').toggleClass('no-scroll');
        });

    $(divHeader).html(header);
    $(divContent).html(content);

    $('.popin-dialog .popin-header').append(divHeader);
    $('.popin-dialog .popin-content').append(divContent);
    $('.popin-dialog .popin-footer').append(btnDelete);
    $('.popin-dialog .popin-footer').append(btnCancel);


        console.log('suppression');

    })

})
function remove(userId){


}
