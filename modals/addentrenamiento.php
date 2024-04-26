<div class="modal fade" id="addentrenamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registrar entrenamiento</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="saves/addclasificacion.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción</label>
                            <input type="text" class="form-control" name="full-name" id="nombre" placeholder="">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="add_clasificacion">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>