var DataFormat= require('../features/DataFormat');

$(document).ready(function(){


document.cookie = "notification=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";

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




    $("#form-user").on('submit',function(e){

      e.preventDefault();

        var url = $(this).attr('action')
        console.log(url)
        var errors=[];
        var firstname=$("input[name='firstname']").val();
        var lastname=$("input[name='lastname']").val();
        var email=$("input[name='email']").val();
        var password=$("input[name='password']").val();
        var profile=$("#profile").find('option:selected').val()
        console.log(profile,"oko");


        if(!DataFormat.isValid(firstname,"name")){
          errors.push({
            input:"firstname",
            msg:"Format de Prénom incorrect"
          })
        }
        if(!DataFormat.isValid(lastname,"name")){
          errors.push({
            input:"lastname",
            msg:"Format de nom de famille incorrect"
          })
        }
        if(!DataFormat.isValid(email,"email")){
          errors.push({
            input:"email",
            msg:"Format d'email incorrect"
          })
        }
        if(!DataFormat.isValid(password,"password")){
          errors.push({
            input:"password",
            msg:"Format de Mot de passe incorrect (celui-ci doit comporter au moins 4 caractères alphanumériques)"
          })
        }
        if(profile==0 ||  profile==null || profile=='')  {
          errors.push({
            input:"profile",
            msg:"Vous navez pas sélectionné de profil"
          })
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
        }else{
        // e.currentTarget.submit();

      /*  var dataTosend={
             firstname:$("input[name='firstname']").val(),
             lastname:$("input[name='lastname']").val(),
             email:$("input[name='email']").val(),
             password:$("input[name='password']").val(),
             profile:$("select[name='profile']").val(),
        }
        $.ajax({
          url   :url,
          type  :'POST',
          data  :dataTosend,
          dataType:'json',
          success : function(data){
              console.log(data)
              console.log(data.message)


              var msg, className;
              try{

                  //try to parse JSON
                  //var encodedJson = $.parseJSON(data);

                  if(data.message!=""){
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

document.cookie='notification='+JSON.stringify(data);

window.location ="/admin/user"

              $("#notification-bar").css('display','block !important');
              $('#notification-bar').addClass(className + " fadeOut").html(msg);
              setTimeout(function(){
                  $('#notification-bar').fadeOut();
                  $('#notification-bar').removeClass(className+" fadeOut");
              },3000);
              clearTimeout();
            }
        })*/
      }
    })



/*check datas from form user*/




//console.log(document.cookie.notifications);
/*console.log(document.cookie)
var notification = JSON.parse(document.cookie);

var msg, className;
try{

    //try to parse JSON
    //var encodedJson = $.parseJSON(data);

    if(notification.message!=""){
        msg = notification.message;
        className='success';
    }else{
        msg = notification.error;
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
},3000);
clearTimeout();





document.cookie = "notification=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
*/
})

/*create user btn*/






function remove(userId){


}

function resetModal(){
    $('.popin').fadeOut('fast');
    $('.popin-dialog .popin-header').html('');
    $('.popin-dialog .popin-content').html('');
    $('.popin-dialog .popin-footer').html('');
    $('body').toggleClass('no-scroll');
}
