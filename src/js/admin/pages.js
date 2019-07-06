var DataFormat= require('../features/DataFormat');
$(document).ready(function(){


/*delete a page  on js-delete-page button click*/

$('.js-delete-page').on('click',function(e){
    e.preventDefault();
    var that = $(this);
    var pageId = that.closest('tr').attr('id');
    var url = that.attr('href');
    var header="Voulez vous supprimer la page suivante? (Toute suppression sera définitive)";
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
    .html('Supprimer la page')
    .on('click',function(){
        if(url!=""){
            $.ajax({
                url   :url,
                type  :'POST',
                data  :'token',
                dataType:'json',
                success : function(data){
                    console.log(data.success)
                    var msg, className;
                    try{
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
                    $('#'+pageId).remove();
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

    })

console.log('page.js');
    /*behaviour of launch page form update or create*/
    $('#form-page').on('submit',function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        console.log(url);
        var errors=[];
        var name=$("input[name='name']").val();
        var alias=$("input[name='alias']").val();
        var content = tinymce.get('form-page-content').getContent();
        var published=$("#published").find('option:selected').val();

        if(!DataFormat.isValid(name,"alias")){
            errors.push({
                input:"name",
                msg:"Format d'alias incorrect (Espace et caracteres speciaux acceptes(- ou _)"
            })
        }

        if(published==null || published=='')  {
            errors.push({
                input:"published",
                msg:"Vous navez pas sélectionné l'etat de publication de la page"
            })
        }

        var page={
          name:name,
          alias:alias,
          content:content,
          published:published
        }



        if(errors.length>0){
            var a =document.createElement('a');
            $('#notification-bar').html('').append($(a).addClass('js-close-notification').on('click',function(e){
                    e.preventDefault();
                    console.log('i')
                    $('#notification-bar').fadeOut();
                })
            );
            var ul = document.createElement('ul');
            $.each(errors,function(k,v){
                var li = document.createElement('li');
                $(li).append(v.msg);
                $(ul).append($(li));
            })
            $('#notification-bar').addClass('danger').append($(ul)).css('display','block');
            return false;
        }else{
            $.ajax({
                type      :'POST',
                url       :url,
                data      :page,
                dataType  :'json',
                success    :function(data){
                    console.log(data);
                    var msg, className;

                    try{

                        //try to parse JSON
                        //var encodedJson = $.parseJSON(data);

                        if(data.success!=""){
                            msg = data.message;
                            className='success';
                        }else{
                            msg = data.error;
                            className='danger';
                        }
                    }catch(error){
                        className='danger';
                        msg='une erreur est survenue, format de données incorrectes depuis le serveur';
                    }
                    $("#notification-bar").css('display','block !important');
                    $('#notification-bar').addClass(className + " fadeOut").html(msg);

                    setTimeout(function(){
                        $('#notification-bar').fadeOut();
                        $('#notification-bar').removeClass(className+" fadeOut");
                        document.location.href="/admin/page";
                    },3000);
                    clearTimeout();
                }
            })
        }











        return false;
    });


    /*generation of alias automatically*/
    $("input[name='name']").on('keyup',function(e){
        var nv;
        var name =$(this).val();
        var alias = name.replace(/\s/g,'-').toLowerCase();
        console.clear();
        console.log(alias)
        $("input[name='alias']").val(alias);
    })
})

function resetModal(){
    $('.popin').fadeOut('fast');
    $('.popin-dialog .popin-header').html('');
    $('.popin-dialog .popin-content').html('');
    $('.popin-dialog .popin-footer').html('');
    $('body').toggleClass('no-scroll');
}
