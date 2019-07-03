var DataFormat= require('../features/DataFormat');
$(document).ready(function(){
console.log('page.js');
    $('#form-page').on('submit',function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        console.log(url);
        var errors=[];
        var name=$("input[name='name']").val();
        var alias=$("input[name='alias']").val();
        var content = tinymce.getContent('form-page-content');
        var published=$("#published").find('option:selected').val();


        if(!DataFormat.isValid(name,"small text")){
            errors.push({
                input:"name",
                msg:"Titre de la page incorrect"
            })
        }
        if(!DataFormat.isValid(lastname,"name")){
            errors.push({
                input:"lastname",
                msg:"Format de nom de famille incorrect"
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

        $.ajax({
            type      :'POST',
            url       :url,
            data      :page,
            dataType  :'json',
            success    :function(data){
                  console.log(data);
              }
        })
        return false
    })
})
