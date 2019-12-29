(function () {
    if(document.getElementById('frmIngreso')){
        const frm = $('#frmIngreso');
        $("#btnEntrar").click(function (e) { 
            e.preventDefault();
            validateFrmIngreso(frm);
        });
    }

    if(document.getElementById('frmNewEmpleador')){
        const frm = $("#frmNewEmpleador");
        $("#btnRegistrar").click(function (e) { 
            e.preventDefault();
            validateFrmNewEmpleador(frm);
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
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtPase:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
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

/*REGISTRO DE EMPLEADORES*/
function validateFrmNewEmpleador(frm) {
    var validator = frm.validate({
        rules:{
            txtNombre:{
                required: true
            },
            txtCuota:{
                required:true
            },
            txtTelefono:{
                maxlength: 10
            }
        },
        messages:{
            txtNombre:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtCuota:{
                required:'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>',
                min: 'Tiene que ser mayor a $1 <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtTelefono:{
                maxlength: 'máx 10 dígitos <i class="fas fa-exclamation-circle obligatorio"></i>'
            }
        }
    });

    if(validator.form()){
        $.ajax({
            type: "post",
            url: "../php/registro-empleador.php",
            data: frm.serialize(),
            success: function (response) {
                if(response == true){
                    swal({title:'Empleador añadido',text:'¡Felicidades por tu nuevo éxito profesional!',icon:'success'}).then(function(){
                        location.href = '../app/empleadores';
                    });
                }else{
                    swal('Hubo un error','Intente de nuevo, si el problema sigue contáctenos','error');
                    $("#frmIngreso")[0].reset();
                }
                
                //alert(response);
            }
        });
    }
}