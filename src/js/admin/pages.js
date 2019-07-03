$(document).on('ready',function(){

    $('form-page').on('submit',function(e){
        e.preventDefault();
        var name=$("input[name='name']").val();
        var alias=$("input[name='alias']").val();
        var content = tinymce.getContent('form-page-content');
        var published=$("#profile").find('option:selected').val()


        if(!DataFormat.isValid(name,"text")){
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
        if(published==null || published=='')  {
            errors.push({
                input:"profile",
                msg:"Vous navez pas sélectionné l'etat de publication de la page"
            })
        }
    })
})