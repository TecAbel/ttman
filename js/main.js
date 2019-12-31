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
    
    if(document.getElementById('frmRegistroActividad')){
        const frm = $("#frmRegistroActividad");
        $("#btnRegistrar").click(function (e) { 
            e.preventDefault();
            validateFrmRegistroActividad(frm);
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

/* REGISTRO DE ACTIVIDADES */

function validateFrmRegistroActividad(frm) {
    var validator = frm.validate({
        rules: {
            txtFecha:{
                required: true
            },
            txtInicio:{
                required:true
            },
            txtSalida:{
                required: true
            },
            txtActividad:{
                required: true
            },
            txtDetalle:{
                required: true
            }
        },
        messages:{
            txtFecha:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtInicio:{
                required:'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtSalida:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtActividad:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtDetalle:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            }
        }
    });

    if(validator.form()){
        var fecha = $("#txtFecha").val();
        var inicio = $("#txtInicio").val();
        var salida = $("#txtSalida").val();
        var actividad = $("#txtActividad").val();
        var detalle = $("#txtDetalle").val();
        var transporte = $("#txtTransporte").val();
        swal({
            title: "Verifica tu información",
            text: `Fecha: ${fecha}\n
                   Inicio: ${inicio}\n
                   Salida: ${salida}\n 
                   Actividad: ${actividad}\n 
                   Detalle: ${detalle}\n
                   Transporte: $${transporte} ` ,
            icon: "warning",
            buttons: true,
          })
          .then(() => {
            $.ajax({
                type: "post",
                url: "../php/registro-actividad.php",
                data: frm.serialize(),
                success: function (response) {
                    swal(response);
                }
            });
          });

        /**/
    }
}