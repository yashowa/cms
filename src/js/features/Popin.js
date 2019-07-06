class PopinAjax {
  constructor:(type,){
      this.createControls();
      this.btnAction ={
        class:"btn danger",
        name:"Validate",
        href:'',
      }
  }

createControls(){
  btnAction = document.createElement('button');
  btnCancel = document.createElement('button');
  divHeader = document.createElement('div');
  divContent = document.createElement('p');

  $(btnAction).attr({
  "class":this.btnAction.class,
  "href":this.btnAction.href,
  })
  .html(this.btnAction.name)
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
                  this.resetModal();
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
}
show(){


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
  }

  resetModal(){
    $('.popin').fadeOut('fast');
    $('.popin-dialog .popin-header').html('');
    $('.popin-dialog .popin-content').html('');
    $('.popin-dialog .popin-footer').html('');
    $('body').toggleClass('no-scroll');
  }
}
