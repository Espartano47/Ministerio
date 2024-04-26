<?php
$page_title = "Miembros";
require_once ('include/load.php');
if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}

include_once ('layouts/header.php'); ?>
<style>
tr:hover {
    background-color: #f5f5f5;
    /* Cambia el color de fondo al pasar el puntero */
    cursor: pointer;
    /* Cambia el cursor al pasar el puntero */
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de miembros</h1>
                </div><!-- /.col -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Miembros de la iglesia</h3>

                            <button type="button" class="btn btn-primary  ml-auto" data-toggle="modal"
                                data-target="#exampleModal">
                                Agregar nuevo
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--boton para Agregar servidor -->
                            <table id="table-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Cédula</th>
                                        <th style="text-align:center;">Nombre</th>
                                        <th style="text-align:center;">Sexo</th>
                                        <th style="text-align:center;">Teléfono</th>
                                        <th style="text-align:center;">Ocupación</th>
                                        <th style="text-align:center;">Correo</th>
                                        <th style="text-align:center;">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableentrenamientos">
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>



<!-- Agrega la librería Select2 JS -->

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<script>
$(document).ready(function(){
    // Función para llenar el dropdown de provincias
    function llenarDropdownProvincias() {
        // Realizar la solicitud GET a la API de provincias
        $.get("https://api.digital.gob.do/v1/territories/provinces", function(data) {
            // Verificar si la solicitud fue exitosa
            if (data && data.valid) {
                // Recorrer los datos de las provincias y agregar opciones al select
                data.data.forEach(function(provincia) {
                    var provinciaNombre = provincia.name.toUpperCase(); // Convertir a mayúsculas
                    $('#provincia').append($('<option>', {
                        value: provinciaNombre,
                        'data-name': provincia.name, // Atributo de datos para almacenar el nombre
                        text: provinciaNombre
                    }));
                });
                
                // Inicializar el select2 para el dropdown de provincias
                $('#provincia').select2({
                    theme: 'bootstrap4'
                });
            } else {
                alert('Error: No se pudieron cargar las provincias.');
            }
        });
    }
    
    // Llenar el dropdown de provincias al cargar la página
    llenarDropdownProvincias();
    
});

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
                    text: 'Ya existe un miembro con la cédula ingresada se llama '+data.nombre+' '+data.apellido,
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

// Consulta de la cédula
$(document).ready(function(){
    $('#cedula').on('input change', function() {
        var cedula = $(this).val().replace(/[-_]/g, '');
        var cedulaNoLimpia = $(this).val();
        console.log(cedula);
        if (cedula.length === 11) {
            getMiembroByCedula(cedulaNoLimpia)
            .then(function(existeMiembro) {
                if (!existeMiembro) {
                    return;
                }
                var url = 'proxy.php?cedula=' + cedula;
                $.get(url, function(data, status) {
                    $('#nombre').val(data.data.name);
                    $('#apellido').val(data.data.lastname);
                    // Obtener la fecha de nacimiento y establecerla en el campo de fecha de nacimiento
                    var fechaNacimiento = new Date(data.data.birthdate);
                    var dia = ("0" + fechaNacimiento.getDate()).slice(-2);
                    var mes = ("0" + (fechaNacimiento.getMonth() + 1)).slice(-2);
                    var fechaFormateada = fechaNacimiento.getFullYear() + "-" + mes + "-" + dia;
                    $('#fechanacimiento').val(fechaFormateada);
                    var provinciaDecodificada = decodeURIComponent(data.data.provinceName);
                    $('#provincia').val(provinciaDecodificada);
                    $('#municipio').val(data.data.municipioName);
                    $('#sexo').val(data.data.gender);
                    console.log("Status: " + status);
                });
            })
            .catch(function(error) {
                console.error(error);
            });
        
        }
    });
});


//convierte la cedula en un formato de 3-7-1
$(function (){
    $('[data-mask]').inputmask()
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


})
let datatable;
let datatableisinitialized = false;

const initDatatable = async () => {
    if (datatableisinitialized) {
        datatable.destroy();
        let datatableisinitialized = false;
    }
    await Lista_ent();

    datatable = $('#table-data').DataTable({
        "destroy": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#table-data_wrapper .col-md-6:eq(0)');
}

const Lista_ent = async () => {
    const res = await fetch('api/miembros.php?consulta=miembros&descripcion=miembros');
    const data = await res.json();
    const contdata = data.length;
    let template = '';
    for (const dataItem of data) {
        // data-id="${dataItem.id}" onclick="navigateToDetails(${dataItem.ID})"
        template += `
            <tr data-id="${dataItem.id}" data-cedula="${dataItem.cedula}" data-nombre="${dataItem.nombre}" data-apellido="${dataItem.apellido}" data-telefono="${dataItem.telefono}" data-ocupacion="${dataItem.ocupacion}" data-correo="${dataItem.correo}">
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.cedula}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.nombre} ${dataItem.apellido}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.sexo}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.telefono}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.ocupacion}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.correo}</td> 
                    <td style="text-align:center;">
        <a class="btn btn-secondary edit-btn" data-toggle="modal" data-target="#editservermodal">
            <i class="fas fa-marker"></i>
        </a>
        <button class="btn btn-danger" onclick="deleteEnt(${dataItem.id})">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
            </tr>
        `;
    }
    tableentrenamientos.innerHTML = template;
}


window.addEventListener('load', async () => {
    await initDatatable();
});

function navigateToDetails(id) {
    window.location.href = `perfil.php?id=${id}`;
}
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tr[data-id]');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            const id = row.getAttribute('data-id');
            window.location.href = `details_ent.php?id=${id}`;
        });
    });
});

</script>
<script src="js/miembroscrud.js"></script>
<?php 
include_once ('modals/addmiembro.php');
include_once ('modals/editservidor.php'); 
?>
</body>

</html>