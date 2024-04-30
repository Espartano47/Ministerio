<?php
$page_title = "Miembros";
require_once ('include/load.php');
if (!$session->isUserLoggedIn()) { redirect('index.php', false);}
$ocupaciones = find_all_ocupaciones();
$provincias = find_all_by_table('provincias');
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
                                data-target="#addmondal">
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
                                        <th style="text-align:center;">Género</th>
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
<?php include_once ('layouts/footer.php'); ?>

<script>
// Consulta de la cédula
$(document).ready(function() {
    $('#edit_provincia').on('change', function() {
        const provinciaSeleccionada = this.value;
        const selectMunicipio = document.getElementById('edit_municipio');
        console.log(provinciaSeleccionada);
        if (provinciaSeleccionada) {
            cargarMunicipios(provinciaSeleccionada,selectMunicipio);
        } else {
            // Si no se selecciona ninguna provincia, limpiar el select de municipios
            
            selectMunicipio.innerHTML = '<option value="" selected="selected">Seleccionar</option>';
        }
    });
    $('#provincia').on('change', function() {
        const selectMunicipio = document.getElementById('municipio');
        const provinciaSeleccionada = this.value;
        console.log(provinciaSeleccionada);
        if (provinciaSeleccionada) {
            cargarMunicipios(provinciaSeleccionada,selectMunicipio);
        } else {
            // Si no se selecciona ninguna provincia, limpiar el select de municipios
            selectMunicipio.innerHTML = '<option value="" selected="selected">Seleccionar</option>';
        }
    });

    $('#cedula').on('input change', function() {
        var cedula = $(this).val().replace(/[-_]/g, '');
        var cedulaNoLimpia = $(this).val();
        console.log(cedula);
        if (cedula.length === 11) {
            //pupop cargando
            Swal.fire({
                title: 'Cargando',
                html: 'Buscando miembro...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });

            getMiembroByCedula(cedulaNoLimpia)
                .then(function(existeMiembro) {
                    if (!existeMiembro) {
                        return;
                    }
                    var url = 'proxy.php?cedula=' + cedula;
                    $.get(url, function(data, status) {
                        
                        if (!data.success) {
                            swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se encontró personas con la cédula ingresada.',
                            });
                         }else{
                        Swal.close();
                        $('#nombre').val(data.data.name);
                        $('#apellido').val(data.data.lastname);
                        // Obtener la fecha de nacimiento y establecerla en el campo de fecha de nacimiento
                        var fechaNacimiento = new Date(data.data.birthdate);
                        var dia = ("0" + fechaNacimiento.getDate()).slice(-2);
                        var mes = ("0" + (fechaNacimiento.getMonth() + 1)).slice(-2);
                        var fechaFormateada = fechaNacimiento.getFullYear() + "-" + mes +
                            "-" + dia;
                        $('#fechanacimiento').val(fechaFormateada);
                        var provinciaDecodificada = decodeURIComponent(data.data
                            .provinceName);
                        $('#provincia').val(provinciaDecodificada).trigger('change');;
                        
                        $('#sexo').val(data.data.gender);
                        setTimeout(function() {
                            $('#municipio').val(data.data.municipioName).trigger('change');
                        }, 50);
                        console.log("Status: " + status);
                    }
                });
                })
                .catch(function(error) {
                    console.error(error);
                    // Cerrar SweetAlert de carga en caso de error
                });
        }
    });
});


//convierte la cedula en un formato de 3-7-1
$(function() {
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
        "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#table-data_wrapper .col-md-6:eq(0)');
}

const Lista_ent = async () => {
    const res = await fetch('api/miembros.php?consulta=miembrosv2');
    const data = await res.json();
    const contdata = data.length;
    let template = '';
    for (const dataItem of data) {
     //si dataItem.ocupacion_descripcion es null
        if (dataItem.ocupacion_descripcion == null) {
            dataItem.ocupacion_descripcion = "";
        }
        //si data 
        template += `
            <tr data-id="${dataItem.id}" data-cedula="${dataItem.cedula}" data-nombre="${dataItem.nombre}" data-apellido="${dataItem.apellido}" data-telefono="${dataItem.telefono}" data-ocupacion="${dataItem.ocupacion}" data-correo="${dataItem.correo}">
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.cedula}</td>
                <td onclick="navigateToDetails(${dataItem.id})">${dataItem.nombre} ${dataItem.apellido}</td>
    
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.sexo}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.telefono} ${dataItem.celular}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.ocupacion_descripcion}</td>
                <td style="text-align:center;" onclick="navigateToDetails(${dataItem.id})">${dataItem.correo}</td> 
                    <td style="text-align:center;">
        <a class="btn btn-secondary edit-btn" data-toggle="modal" data-target="#editmodal">
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
include_once ('modals/editmiembro.php'); 
include_once ('modals/addmiembro.php');

?>
</body>

</html>