
$(document).ready(function(){
console.log('page.js');
    $('#form-page').on('submit',function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        console.log(url);
        var errors=[];
        var name=$("input[name='name']").val();
        var alias=$("input[name='alias']").val();
        var content = tinymce.get('form-page-content').getContent();

        return false;
        var published=$("#published").find('option:selected').val();


        if(!DataFormat.isValid(name,"small text")){
            errors.push({
                input:"name",
                msg:"Titre de la page incorrect"
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
    });

    $("input[name='name']").on('keyup',function(e){
        var nv;
        var name =$(this).val().replace("/ +/",'-').toLowerCase();
        $("input[name='alias']").val(name)
    })
})
