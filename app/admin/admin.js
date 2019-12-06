(function () {
    
})();

$(function(){
    /**Menu responsive */
    $(".menu-movil").click(function () { 
        $(".navegacion-principal").slideToggle();
        console.log('cliclk en menu');
    });
});
if(document.getElementById('frmAdmin')){
    function validateForm() {
        var validator = $('#frmAdmin').validate({
            rules:{
                txtUsuario:{
                    required: true
                },
                txtPase:{
                    required: true
                }
            },
            messages:{
                txtUsuario:{
                    required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
                },
                txtPase:{
                    required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
                }
            }
        });  
        
        if(validator.form()){
            $.ajax({
                type: "post",
                url: "admin-conn.php",
                data: $('#frmAdmin').serialize(),
                success: function (respuesta) {
                    //swal(respuesta);
                    if(respuesta == true){
                        location.href = 'admin-usuarios';
                    }/*else if(respuesta==false){
                        swal('Usuario o contraseña incorrectos','Intente de nuevo','error');
                    }*/else{
                        swal('Usuario o contraseña incorrectos','Intente de nuevo','error');
                    }
                }
            });
        }
    }
    
    $('#btnEntrar').click(function () { 
        validateForm();
    });
}