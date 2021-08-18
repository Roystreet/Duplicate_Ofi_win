$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function() {

  $("#formPassword").validate({
    
         submitHandler: function(form) {

       alertify.confirm('<div align="center">¡Cambio de contraseña de WIN Rideshare!</div>', '<div align="center">\t\t ¿Confirmas que deseas cambiar tu contraseña? <br><br> ¡Recuerde que este cambio también afecta a la aplicación! </div>',
       function(){
         form.submit();

       }
       , function(){}).set('labels', {ok:'Continuar', cancel:'Cancelar'});
   }

  });

});