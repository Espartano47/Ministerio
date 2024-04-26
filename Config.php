<?php
  $page_title = 'Usuarios';
  require_once('include/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
  $all_users = find_all_user();
  $all_Categorias = find_all('categories');
  
include_once('layouts/header.php'); ?>
<style>
#filtro {
    margin-bottom: 10px;
}

#filtro {
    margin-bottom: 10px;
}

#filtro .form-group {
    margin-bottom: 10px;
}

#example1_wrapper {
    margin-top: 10px;
}

.dataTables_wrapper .dataTables_filter {
    display: none;
}

tr:hover {
    background-color: #f5f5f5;
    /* Cambia el color de fondo al pasar el puntero */
    cursor: pointer;
    /* Cambia el cursor al pasar el puntero */
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php echo display_msg($msg); ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Opciones del Sistema</h1>
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
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-usuario-tab" data-toggle="pill"
                                        href="#custom-tabs-one-usuario" role="tab"
                                        aria-controls="custom-tabs-one-usuario" aria-selected="true">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-matriz-tab" data-toggle="pill"
                                        href="#custom-tabs-one-matriz" role="tab" aria-controls="custom-tabs-one-matriz"
                                        aria-selected="false">Categorías</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-usuario" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-usuario-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Lista de Usuarios</h3>
                                        </div>

                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div id="filtro" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="text" id="search" class="form-control">
                                                    </div>

                                                    <div class="form-group ml-2">
                                                        <select id="departamento" class="form-control">
                                                            <option value="">Filtrar por departamento</option>
                                                            <option value="Knitting">Departamento 1</option>
                                                            <option value="Departamento 2">Departamento 2</option>
                                                            <option value="Departamento 3">Departamento 3</option>
                                                        </select>
                                                    </div>
                                                    <!---boton primary--->
                                                    <div class="form-group ml-2">
                                                        <div class="form-group ml-2">
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#exampleModal">
                                                                Agregar Usuario
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre</th>
                                                            <th>Usuario</th>
                                                            <th>Roll</th>
                                                            <th>Estatus</th>
                                                            <th>último Login</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($all_users as $user): ?>
                                                        <tr>
                                                            <td><?php echo count_id();?></td>
                                                            <td><?php echo remove_junk($user['name'])?></td>
                                                            <td><?php echo remove_junk($user['username'])?></td>
                                                            <td><?php echo remove_junk(ucwords($user['group_name']))?>
                                                            </td>
                                                            <td><?php if($user['status'] === '1'): ?>
                                                                <span
                                                                    class="label label-success"><?php echo "Activo"; ?></span>
                                                                <?php else: ?>
                                                                <span
                                                                    class="label label-danger"><?php echo "Inactivo"; ?></span>
                                                                <?php endif;?>
                                                            </td>
                                                            </td>
                                                            <td><?php echo read_date($user['last_login'])?></td>
                                                            <td><a href="#" class="text-muted mr-2">
                                                                    <!-- Agregamos una clase de Bootstrap 'mr-2' para agregar un margen derecho -->
                                                                    <i class="fas fa-pen"></i>
                                                                </a>
                                                                <a href="delete_user.php?id=<?php echo (int)$user['id'];?>"
                                                                    class="text-muted">
                                                                    <!-- Mantenemos el segundo enlace sin cambios -->
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-matriz" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-matriz-tab">
                                        <div class="row">
                                            <?php foreach($all_Categorias as $Categoria): ?>
                                            <div class="col-md-4">
                                                <!-- Primer card -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title"><?php echo remove_junk($Categoria['name'])?></h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="filtro" class="form-inline">
                                                            <div class="form-group">
                                                                <input type="text" id="search" class="form-control">
                                                            </div>
                                                            <div class="form-group ml-2">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#exampleModal">
                                                                    Agregar
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Categoría</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($Categorias as $Categoria ):?>
                                                                <tr>
                                                                    <td><?php echo remove_junk($Categoria['name'])?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="text-muted mr-2">
                                                                            <i class="fas fa-pen"></i>
                                                                        </a>
                                                                        <a href="#" class="text-muted">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach;?>
                                                            </tbody>
                                                            <tfoot>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach;?>
                                    <!-- /.card -->
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-mandatorio" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-mandatorio-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Lista de los diferentes tipos de entrenamientos
                                                mandatorios</h3>
                                        </div>

                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div id="filtro" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="text" id="search" class="form-control">
                                                    </div>

                                                    <div class="form-group ml-2">
                                                        <select id="departamento" class="form-control">
                                                            <option value="">Filtrar por departamento</option>
                                                            <option value="Knitting">Departamento 1</option>
                                                            <option value="Departamento 2">Departamento 2</option>
                                                            <option value="Departamento 3">Departamento 3</option>
                                                        </select>
                                                    </div>
                                                    <!---boton primary--->
                                                    <div class="form-group ml-2">
                                                        <div class="form-group ml-2">
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" id="btnaddent">
                                                                Agregar Entrenamiento
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Descripción</th>
                                                            <th>Tipo</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach($all_mand_ent as $mand_ent): ?>
                                                        <tr>
                                                            <td><?php echo count_id();?></td>
                                                            <td><?php echo remove_junk($mand_ent['descripcion'])?></td>
                                                            <td><?php echo remove_junk($mand_ent['tipo'])?></td>
                                                            <td><a href="#" class="text-muted mr-2">
                                                                    <!-- Agregamos una clase de Bootstrap 'mr-2' para agregar un margen derecho -->
                                                                    <i class="fas fa-pen"></i>
                                                                </a>
                                                                <a href="#" class="text-muted">
                                                                    <!-- Mantenemos el segundo enlace sin cambios -->
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                    </tbody>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->


                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            </div>
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
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
<!-- Date range picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- Dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- Bootstrap Color Picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<?php include_once('modals/adduser.php'); ?>
<script>
$(document).ready(function() {


    // Inicializa la tabla DataTable
    var table = $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "select": true
    });

    // Agrega un evento keyup al campo de búsqueda personalizado
    $('#search').on('keyup', function() {
        table.search(this.value).draw(); // Realiza la búsqueda y redibuja la tabla
    });

    // Agrega un evento change al dropdown para filtrar la tabla
    $('#departamento').on('change', function() {
        var value = $(this).val(); // Obtiene el valor seleccionado del dropdown
        table.column(2).search(value ? '^' + value + '$' : '', true, false)
            .draw(); // Realiza la búsqueda y redibuja la tabla
    });
});

$(document).ready(function() {
    // Cuando se cambia el valor del campo de código
    $('#codigo').on('input', function() {
        // Obtener el valor del código ingresado
        var codigo = $(this).val();

        // Realizar búsqueda en la variable $all_Empl
        // Supongamos que $all_Empl es un array de objetos con propiedades 'CODIGO' y 'NOMBRE'
        var empleado = <?php echo json_encode($all_Empl); ?>;

        // Buscar el empleado por el código
        var empleadoEncontrado = empleado.find(function(emp) {
            return emp.CODIGO === codigo;
        });

        // Si se encuentra el empleado, llenar el campo de nombre
        if (empleadoEncontrado) {
            $('#nombre').val(empleadoEncontrado.NOMBRE);
        } else {
            // Si no se encuentra, dejar el campo de nombre vacío
            $('#nombre').val('');
        }
    });
});
btnaddent.addEventListener('click', function() {
    addentrenamiento.show();
});


$(document).ready(function() {
    $('#myForm').submit(function(event) {
        // Evitar el envío predeterminado del formulario
        event.preventDefault();

        // Recopilar los datos del formulario
        var formData = $(this).serialize();

        // Enviar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'saves/adduser.php',
            data: formData,
            success: function(response) {
                // Manejar la respuesta del servidor aquí
                console.log(response);
                // Por ejemplo, puedes mostrar un mensaje de éxito o redirigir a otra página
            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<!-- Modal -->
<?php include_once('modals/addentrenamiento.php'); ?>
</body>

</html>