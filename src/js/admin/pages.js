var DataFormat= require('../features/DataFormat');
$(document).ready(function(){

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
