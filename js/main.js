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

    if(document.getElementById('frmPerfil')){
        const frm = $("#frmPerfil");
        $("#btnActualizar").click(function (e) { 
            e.preventDefault();
            validateFrmPerfil(frm);
        });
    }

    if(document.getElementById('frmUpdateCalculo')){
        const frm = $("#frmUpdateCalculo");
        $("#btnActividadUpdate").click(function (e) { 
            e.preventDefault();
            validateFrmUpdateCalculo(frm);
        });
    }
    if(document.getElementById('frmPrevioReporte')){
        const frm = $("#frmPrevioReporte");
        $("#btnGenerarReporte").click(function (e) { 
            e.preventDefault();
            enviarReporte();
        });
    }


    if(document.getElementById('btnEliminarActividad')){
        var actEnc = $('#txtAct').val();
        var empEnc = $('#txtEmp').val();
        $("#btnEliminarActividad").click(function (e) { 
            e.preventDefault();
            swal({
                title: "Verifica tu acción",
                text: "¿Está seguro de querer eliminar esta actividad?" ,
                icon: "warning",
                buttons: true,
              }).then(()=>{
                $.ajax({
                    type: "post",
                    url: `../php/eliminar-actividad?killAct=${actEnc}`,
                    success: function (response) {
                        if(response == true){
                            swal({
                                title: "Eliminado con éxito",
                                text: "Se ha eliminado esta actividad exitosamente",
                                icon: "success"
                            }).then(()=>{
                                location.href = `actividades-control?emp=${empEnc}`;
                            });
                        }else{
                            swal({
                                title: "Hubo un error",
                                text: "Su información sigue intacta",
                                icon: "error"
                            })
                        }
                        //swal(response);
                    }
                });
              });
        });
    }
/**
 * Calculo de totales
 */
    if(document.getElementById('txtSubtotal')){
        const filasPrincipal = document.querySelectorAll('#tablaPrincipal tbody tr');
        const filasDetalles = document.querySelectorAll('#tablaDetalles tbody tr');
        var totalMonto = 0;
        //recorrer fila de monto
        filasPrincipal.forEach(function (e) {
            var monto = e.querySelector('span');
            totalMonto += parseInt(monto.textContent);
        });

        const subtotalDOM = document.querySelector('#txtSubtotal');
        subtotalDOM.textContent = totalMonto;

        //calculo de transporte
        var totalTransporte = 0;
        filasDetalles.forEach(function (e) {
            var montoTransporte = e.querySelector('span');
            totalTransporte += parseInt(montoTransporte.textContent);
        })

        const transporteDOM = document.querySelector('#txtTransporte');
        transporteDOM.textContent = totalTransporte;

        // calculo total de actividades
        var totalActividades = 0;
        const totalDom = document.querySelector('.total .monto-total');
        totalActividades = totalMonto + totalTransporte;
        totalDom.textContent = totalActividades;
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

/**
 * Cambios del perfil
 * 
 */
function validateFrmPerfil(frm) {
    var validator = frm.validate({
        rules:{
            txtTelefono:{
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            txtRFC:{
                minlength: 13,
                maxlength: 10
            },
            txtClabe:{
                minlength: 18,
                maxlength:18
            },
            txtBanco:{
                minlength:5
            }
        },
        messages:{
            txtTelefono:{
                digits: 'Solo números <i class="fas fa-exclamation-circle obligatorio"></i>',
                minlength: 'mín 10 <i class="fas fa-exclamation-circle obligatorio"></i>',
                maxlength: 'máx 10 <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtRFC:{
                minlength: 'mín 13 <i class="fas fa-exclamation-circle obligatorio"></i>',
                maxlength: 'máx 13 <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtClabe:{
                minlength: 'mín 18 <i class="fas fa-exclamation-circle obligatorio"></i>',
                maxlength: 'máx 18 <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtBanco:{
                minlength: 'mín 5 <i class="fas fa-exclamation-circle obligatorio"></i>'
            }
        }
    });

    if(validator.form()){
        $.ajax({
            type: "post",
            url: "../php/update-perfil.php",
            data: frm.serialize(),
            success: function (response) {
                if(response == true){
                    swal({
                        title: "Perfil actualizado",
                        text: "Tu información se ha actualizado exitosamente",
                        icon: "success"
                    });
                }else{
                    swal({
                        title: "Hubo un error",
                        text: "Tu información está intacta. Vuelve a intentarlo",
                        icon: "error"
                    });
                }
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
        var empEnc = $("#txtEmp").val();
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
                    if(response == true){
                        swal({
                            title: "Actividad registrada",
                            text: "Su actividad fue registrada exitosamente",
                            icon: "success"
                        }).then(()=>{
                            location.href = `actividades-control?emp=${empEnc}`;
                        });
                    }else{
                        swal({
                            title: "Hubo un error",
                            text: "Su actividad no se registró de forma correcta, vuelva a intentar",
                            icon: "error"
                        });
                    }
                }
            });
          });

        /**/
    }
}

/*
 * ACTUALIZAR CALCULO
 */
function validateFrmUpdateCalculo(frm){
    var empEnc = $('#txtEmp').val();
    var validator = frm.validate({
        rules:{
            txtInicio:{
                required: true
            },
            txtSalida:{
                required: true
            },
            txtDetalle:{
                required: true
            }
        },
        messages:{
            txtInicio:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtSalida:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            },
            txtDetalle:{
                required: 'Vacío <i class="fas fa-exclamation-circle obligatorio"></i>'
            }
        }
    });

    if(validator.form()){
        $.ajax({
            type: "post",
            url: "../php/update-calculo.php",
            data: frm.serialize(),
            success: function (response) {
                if(response == true){
                    swal({
                        title: "Actividad actualizada",
                        text: "Se ha actualizado correctamente la información de tu actividad",
                        icon: "success"
                    }).then(()=>{
                        location.href = `actividades-control?emp=${empEnc}`;
                    });
                }else{
                    swal({
                        title: "Hubo un error",
                        text: "Vuelva a intentarlo. Su información sigue intacta.",
                        icon: "error"
                    });
                }
                //swal(response);
            }
        });
    }
}

function enviarReporte() {
    const filasPrincipal = document.querySelectorAll('#tablaPrincipal tbody tr');
    const filasDetalles = document.querySelectorAll('#tablaDetalles tbody tr');
    var datosActividades = [];
    var datosDetalles =[];
    filasPrincipal.forEach(function (e) {
        var txtFecha = e.querySelector('#txtFecha_tb'); 
        var txtActividad = e.querySelector('#txtActividad_tb');
        var txtDetalle = e.querySelector('#txtDetalle_tb');
        var txtMonto = e.querySelector('#txtSubtotal_tb');
        //console.log(txtFecha);
        datosActividades.push({
            fecha: txtFecha.textContent,
            actividad: txtActividad.textContent,
            detalle: txtDetalle.textContent,
            monto: txtMonto.textContent
        });
    });
    filasDetalles.forEach(function (e) {
        var FechaDetalle = e.querySelector('#txtFechaDetalle'); 
        var horaEntDetalle = e.querySelector('#txtHoraEntDetalle');
        var horaSalidaDetalle = e.querySelector('#txtHoraSalDetalle');
        var transporte = e.querySelector('#txtTransporteDetalle');
        var totalHoras = e.querySelector('#txtHorasDetalle');
        //console.log(txtFecha);
        datosDetalles.push({
            fecha: FechaDetalle.textContent,
            horaEntrada: horaEntDetalle.textContent,
            horaSalida: horaSalidaDetalle.textContent,
            transporte: transporte.textContent,
            totalHoras: totalHoras.textContent
        });
    });
    
    
    var datosEnvio = {
        empEnc: $("#txtEmpEnc").val(),
        fecha: document.getElementById('txtFecha_reporte').textContent,
        nombre: document.getElementById('txtNombre').textContent,
        empleador: document.getElementById('txtNombreEmp').textContent,
        empresa: document.getElementById('txtEmpresa').textContent,
        banco: document.getElementById('txtBanco').textContent,
        clabe: document.getElementById('txtClabe').textContent,
        total: document.querySelector('.monto-total').textContent,
        actividades: datosActividades,
        datellesActividades: datosDetalles 
    };
    $.ajax({
        type: "post",
        url: "../php/reportes.php",
        data: datosEnvio, 
        success: function (response) {
            if(response == true){
                location.href = "../app/vista-reporte?emp="+$('#txtEmpEncjs').val();
            }else{
                swal(response);
            }
        }
    });
}