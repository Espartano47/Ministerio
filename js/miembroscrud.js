document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#miembroForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);

        // Realiza una solicitud POST usando fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (response.ok) {
                return response.json();  // Obtén la respuesta como JSON
            } else {
                throw new Error('Hubo un problema con la respuesta del servidor');
            }
        })
        .then(data => {
            if (data.success) {
                form.reset();
                $('#exampleModal').modal('hide');  // Oculta el modal
                Lista_ent(); 
                //notificacion con sweetalert2 y que se desaparesca en 2 segundos
                //esperar 2 segundos antes de mostrar la notificación
                setTimeout(function() {
                    //mostrar notificación
                    Swal.fire({
                        title: '¡Guardado!',
                        text: 'El registro ha sido guardado exitosamente.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }, 500);
                
            } else {
                alert('Hubo un error al guardar el servidor: ' + data.message);
                //alerta con sweetalert2
                //esperar 2 segundos antes de mostrar la notificación
                setTimeout(function() {
                    //mostrar notificación
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Hubo un error al guardar el servidor',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }, 500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al guardar el servidor');
            setTimeout(function() {
                //mostrar notificación
                Swal.fire({
                    title: '¡Error!',
                    text: 'Hubo un error al guardar el servidor',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 500);
        });
    });
});


$(document).ready(function() {
    // Evento de clic en el botón de edición
    $('#table-data').on('click', '.edit-btn', function() {
        // Encuentra la fila (<tr>) más cercana donde está el botón
        var $tr = $(this).closest('tr');
        
        // Extrae los valores de los atributos data-* de la fila
        var id = $tr.data('id');
        var cedula = $tr.data('cedula');
        var nombre = $tr.data('nombre');
        var apellido = $tr.data('apellido');
        var telefono = $tr.data('telefono');
        var correo = $tr.data('correo');
        var ocupacion = $tr.data('ocupacion');
        

        // Coloca los valores en los campos del formulario del modal
        $('#editservermodal').find('#inputId').val(id);
        $('#editservermodal').find('#cedula').val(cedula);
        $('#editservermodal').find('#nombre').val(nombre);
        $('#editservermodal').find('#apellido').val(apellido);
        $('#editservermodal').find('#telefono').val(telefono);
        $('#editservermodal').find('#ocupacion').val(ocupacion);
        $('#editservermodal').find('#correo').val(correo);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#miembroForm1');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        console.log('ID:', form.elements['inputId'].value);

        // Realiza una solicitud POST usando fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        
        .then(response => {
            if (response.ok) {
                return response.json();  // Obtén la respuesta como JSON
                //alerta con sweetalert2
                //esperar 2 segundos antes de mostrar la notificación
                setTimeout(function() {
                    //mostrar notificación
                    Swal.fire({
                        title: '¡Guardado!',
                        text: 'El registro ha sido guardado exitosamente.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }, 500);
            } else {
                throw new Error('Hubo un problema con la respuesta del servidor');
            }
        })
        .then(data => {
            if (data.success) {
                form.reset();
                $('#editservermodal').modal('hide');  // Oculta el modal
                Lista_ent();  // Actualiza la tabla solo si la solicitud fue exitosa
            } else {
                alert('Hubo un error al guardar el servidor: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al guardar el servidor');
        });
    });
});
// Función para eliminar un elemento dado su ID
function deleteData(id) {
   console.log('ID1:', id);  // Envía el ID en el cuerpo de la solicitud
    // Enviar una solicitud de eliminación al servidor
    fetch(`saves/eliminar_miembro.php`, {
        method: 'POST',  // Cambia el método a POST
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id }),
        
    })
    
    .then(response => {
        // Verifica si la respuesta es exitosa
        if (response.ok) {
            //alertar con sweetalert2
            //esperar 2 segundos antes de mostrar la notificación
            setTimeout(function() {
                //mostrar notificación
                Swal.fire({
                    title: '¡Eliminado!',
                    text: 'El registro ha sido eliminado exitosamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 500);
            // Elimina el elemento de la interfaz de usuario
           // Envía el ID en el cuerpo de la solicitud
           Lista_ent();
        } else {
            //alertar con sweetalert2
            //esperar 2 segundos antes de mostrar la notificación
            setTimeout(function() {
                //mostrar notificación
                Swal.fire({
                    title: '¡Error!',
                    text: 'Hubo un error al eliminar el registro',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }, 500);
        }
    })
    .catch(error => {
        // Manejar errores de red u otros problemas
        console.error('Error:', error);
        alert('Hubo un problema al eliminar el elemento.');
    });
}

function deleteEnt(id) {
    // Usa SweetAlert2 para mostrar un cuadro de diálogo de confirmación estilizado

    console.log('ID:', id);
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás deshacer esta acción.',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, eliminar',
        customClass: {
            popup: 'swal2-popup-custom',  // Añade tu propia clase para personalización adicional
        }
    }).then((result) => {
        // Si el usuario confirma, result.isConfirmed será true
        if (result.isConfirmed) {
            // Aquí puedes realizar la lógica de eliminación, por ejemplo, una solicitud AJAX para eliminar el dato del servidor
            deleteData(id);

            
        }
    });
}
