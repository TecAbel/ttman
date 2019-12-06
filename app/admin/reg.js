function validateForm() {
    var validator = $('#frmAdminUsers').validate({
        rules:{
            txtNombre:{
                required: true
            },
            txtCorreo:{
                required: true,
                email: true
            },
            txtTelefono:{
                required: true
            },
            txtCorreoC:{
                required: true,
                email: true,
                equalTo: '#txtCorreo'
            },
            txtPase:{
                required: true
            },
            txtPaseC:{
                required: true,
                equalTo: '#txtPase'
            }

        },
        messages:{
            txtNombre:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
            },
            txtTelefono:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
            },
            txtCorreo:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>',
                email: 'Debe ser un correo <i class="fas fa-exclamation-circle color-amarillo"></i>'
            },
            txtCorreoC:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>',
                email: 'Debe ser un correo <i class="fas fa-exclamation-circle color-amarillo"></i>',
                equalTo: 'No coincide <i class="fas fa-exclamation-circle color-amarillo"></i>'
            },
            txtPase:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>'
            },
            txtPaseC:{
                required: 'Vacío <i class="fas fa-exclamation-circle color-amarillo"></i>',
                equalTo: 'No coincide <i class="fas fa-exclamation-circle color-amarillo"></i>'
            }
        }
    });

    if(validator.form()){
        $.ajax({
            type: "post",
            url: "admin-reg.php",
            data: $('#frmAdminUsers').serialize(),
            success: function (response) {
                //swal(response);
                if(response==true){
                   
                    document.getElementById('frmAdminUsers').reset();
                    swal('Cuenta añadida','Ya puede hacer uso de esta cuenta','success');
                   
                }
            }
        });
    }
}

$('#btnRegistro').click(function () { 
    validateForm();
});