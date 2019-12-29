(function () {
    if(document.getElementById('frmIngreso')){
        const frm = $('#frmIngreso');
        $("#btnEntrar").click(function (e) { 
            e.preventDefault();
            validateFrmIngreso(frm);
        });
    }
})();

$(function(){
    /**Menu responsive */
    $(".menu-movil").click(function () { 
        $(".navegacion-principal").slideToggle();
        console.log('cliclk en menu');
    });
});

function validateFrmIngreso(frm) {
    var validator = frm.validate({
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
            url: "../php/validar-inicio.php",
            data: frm.serialize(),
            success: function (response) {
                if(response == true){
                    location.href = '../app/empleadores';
                }else{
                    swal('Usuario o contraseña incorrectos','Intente de nuevo','error');
                    $("#frmIngreso")[0].reset();
                }
                //alert(response);
            }
        });
    }
}