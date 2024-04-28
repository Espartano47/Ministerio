<!-- Modal para el registro -->
<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 5%;max-width: 900px;">
        <div class="modal-content">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 26px;"><strong>REGISTRO</strong></h2>
            </div>
            <!-- /.card-header -->
            <!-- Formulario -->
            <form id="miembroForm" method="post" action="saves/new_miembro.php">
                <div class="card-body" style="padding:5%">
                    <!-- Campo para el nombre -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="cedula">Cedula</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" required
                                data-inputmask='"mask": "999-9999999-9"' data-mask>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                                placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Host">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento"
                                placeholder="Área">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Género</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="sexo" name="sexo">
                                <option value="">Seleccionar</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Ocupación</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="ocupacion"
                                name="ocupacion">
                                <option value="" selected="selected">Selecionar</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-md-4">
                            <label for="Host">Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Célular</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" id="celular" name="celular"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="area-input">Correo</label>
                            <input type="text" class="form-control" id="correo" name="correo" placeholder="correo">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="provincia">Provincia</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="provincia"
                                name="provincia">
                                <option value="" selected="selected">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="area-input">Municipio</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="municipio"
                                name="municipio">
                                <option value="" selected="selected">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="apellido">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                placeholder="C/ Duarte #1">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary flex-grow-1"
                            name="add_miembro" id="guardar">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>