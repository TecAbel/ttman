if(document.getElementById('frmCambioPass')){
    function validateForm() {
        const frm = $('#frmCambioPass');
        var validator = frm.validate({
            rules:{
                txtPase:{
                    required: true
                },
                txtPase1:{
                    required:true,
                    equalTo: '#txtPase'
                }
            },
            messages:{
                txtPase:{
                    required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
                },
                txtPase1:{
                    required:'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>',
                    equalTo: 'No coincide <i class="fas fa-exclamation-circle color-amarillo"></i>'
                }
            }
        });

        if(validator.form()){
            $.ajax({
                type: "post",
                url: "../php/update-password.php",
                data: frm.serialize(),
                success: function (response) {
                    if(response = true){
                        swal({title:'Cambio exitoso',text:'La contraseña se ha cambiado exitosamente',icon:'success'}).then(function(){
                            location.reload();
                        });
                    }else{
                        swal({title:'Error',text: response,icon:'error'}).then(function(){
                            location.reload();
                        });
                    }
                }
            });
        }
    }

    $('#btnCambio').click(function () { 
        validateForm();
    });
}