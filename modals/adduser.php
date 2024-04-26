<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registrar Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="saves/adduser.php">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Código</label>
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder=""
                            readonly>
                        </div>
                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" id="rol" name="level">
                                <option value="3">Entrenador</option>
                                <option value="2">Usuario</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Entrenamiento Soporte</label>
                            <select class="form-control" id="entrenamiento" name="departamento">
                                <?php foreach ($distintosDepartamentos as $departamento): ?>
                                <option value="<?php echo $departamento; ?>"><?php echo ucwords($departamento); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="add_user">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>