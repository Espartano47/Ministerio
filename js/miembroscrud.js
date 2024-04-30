function getMiembroByCedula(cedula) {
    return new Promise(function(resolve, reject) {
        //limpiar data
        $.get('api/miembros.php?consulta=miembrosbycedula&id=' + cedula, function(data) {
            if (data && data.id) {
                $('#nombre').val(data.nombre);
                //agregar un sweet alert diciendo que ya existe eperar 3 segundos y cerrar limpiar el campo de cedula y nombre
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ya existe un miembro con la cédula ingresada se llama ' + data
                        .nombre + ' ' + data.apellido,
                    showConfirmButton: false,
                    timer: 6000
                });

                resolve(false);
                $('#cedula').val('');
                $('#nombre').val('');
            } else {
                resolve(true);
            }
        }).fail(function() {
            reject("Error al consultar la base de datos");
        });
    });
}
function cargarMunicipios(provincia,selectMunicipio) {
    // Hacer la solicitud a la API
    fetch(`api/miembros.php?consulta=municipios&descripcion=${provincia}`)
        .then(response => response.json())
        .then(data => {
            selectMunicipio.innerHTML = ''; // Limpiar el contenido actual
            // Llenar el select con los municipios correspondientes
            data.forEach(municipio => {
                // Crea una nueva opción
                const option = new Option(municipio.name, municipio.name);
                // Agrega la opción al select
                selectMunicipio.add(option);
            });
        })
        .catch(error => console.error('Error al cargar los municipios:', error));
}

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
                $('#addmondal').modal('hide');  // Oculta el modal
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
        // Extrae el ID de la fila de la tabla
        var id = $(this).closest('tr').data('id');
        // Realiza una solicitud AJAX para obtener los detalles de la persona por su ID
        $.ajax({
            url: 'api/miembros.php?consulta=miembrosbyid&id='+id, // Reemplaza con la ruta correcta de tu API
            type: 'GET',
            success: function(response) {
                // convertir response.fecha_nacimiento en fecha
                response.fecha_nacimiento = new Date(response.fecha_nacimiento).toISOString().split('T')[0];
                // Si la solicitud es exitosa, coloca los valores en los campos del formulario del modal
                $('#inputId').val(response.id);
                $('#edit_cedula').val(response.cedula);
                $('#edit_nombre').val(response.nombre);
                $('#edit_apellido').val(response.apellido);
                $('#edit_telefono').val(response.telefono);
                $('#edit_ocupacion').val(response.ocupacion).change();
                $('#edit_correo').val(response.correo);
                $('#edit_fechanacimiento').val(response.fecha_nacimiento);
                $('#edit_celular').val(response.celular);
                
                $('#edit_sexo').val(response.sexo).change();
                $('#edit_provincia').val(response.provincia).trigger('change');
                $('#edit_direccion').val(response.direccion);
                setTimeout(function() {
                    $('#edit_municipio').val(response.municipio).trigger('change');
                }, 50);

            },
            error: function(xhr, status, error) {
                // Maneja errores si la solicitud AJAX falla
                console.error('Error al obtener los detalles de la persona:', error);
                // Puedes mostrar un mensaje de error o manejarlo de otra manera según tus necesidades
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#editMiembroForm');
    
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
                $('#editmodal').modal('hide');  // Oculta el modal
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
