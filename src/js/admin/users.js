

$(document).ready(function(){


$('.js-delete-user').on('click',function(e){
    e.preventDefault();
    //$('.popin').append($('div').html('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'))

    var that = $(this);
    var userId = that.closest('tr').attr('id');
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
                url   :url,
                type  :'POST',
                data  :'token',
                dataType:'json',
                success : function(data){
                    //console.log(data);

                    console.log(data.success)


                    var msg, className;
                    try{

                        //try to parse JSON
                        //var encodedJson = $.parseJSON(data);

                        if(data.success!=""){
                            msg = data.success;
                            className='success';
                        }else{
                            msg = data.error;
                            className='danger';
                        }
                    }catch(error){
                        className='danger';
                        msg='une erreur est survenue, format de données incorrectes depuis le serveur';
                    }
                    resetModal();
                    $('#'+userId).remove();


                    $("#notification-bar").css('display','block !important');

                    $('#notification-bar').addClass(className + " fadeOut").html(msg);

                    setTimeout(function(){
                        $('#notification-bar').fadeOut();
                        $('#notification-bar').removeClass(className+" fadeOut");
                    },3000);
                    clearTimeout();
                }
            })
        }
    });

    $(btnCancel).attr({
            "class":"btn default"
        })
        .html('Annuler')
        .on('click',function() {
resetModal();
        });

    $(divHeader).html(header);
    $(divContent).html(content);

    $('.popin-dialog .popin-header').append(divHeader);
    $('.popin-dialog .popin-content').append(divContent);
    $('.popin-dialog .popin-footer').append(btnDelete);
    $('.popin-dialog .popin-footer').append(btnCancel);


      //  console.log('suppression');

    })


    setTimeout(function(){
        $('#notification-bar').fadeOut();
        $('#notification-bar').removeClass("success fadeOut");
    },3000);


})
function remove(userId){


}

function resetModal(){
    $('.popin').fadeOut('fast');
    $('.popin-dialog .popin-header').html('');
    $('.popin-dialog .popin-content').html('');
    $('.popin-dialog .popin-footer').html('');
    $('body').toggleClass('no-scroll');
}
