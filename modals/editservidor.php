<!-- Modal -->
<div class="modal fade" id="editservermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 5%;max-width: 900px;">
        <div class="modal-content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">EDITAR</h3>
                </div>

                <!-- Formulario -->
                <form id="miembroForm1" method="post" action="saves/edit_Server.php">
                    <div class="card-body">
                        <!-- Campo oculto para el ID -->
                        <input type="text" id="inputId" name="inputId" hidden>

                        <!-- Campo para el nombre -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="cedula">Cedula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required
                                    data-inputmask='"mask": "999-9999999-9"' data-mask>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre_edit" name="nombre_edit" placeholder=""
                                    required>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido_edit" name="apellido_edit" placeholder="">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="Host">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fechanacimiento_edit" name="fechanacimiento_edit"
                                    placeholder="Área">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Host">Género</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="sexo_edit" name="sexo_edit">
                                    <option value="">Seleccionar</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Host">Ocupación</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="ocupacion_edit"
                                    name="ocupacion_edit">
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
                                    <input type="text" class="form-control" id="telefono_edit" name="telefono_edit"
                                        data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Host">Célular</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="celular_edit" name="celular_edit"
                                        data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="area-input">Correo</label>
                                <input type="text" class="form-control" id="correo_edit" name="correo_edit" placeholder="correo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="provincia">Provincia</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="provincia_edit"
                                    name="provincia_edit">
                                    <option value="" selected="selected">Seleccionar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="area-input">Municipio</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="municipio_edit"
                                    name="municipio_edit">
                                    <option value="" selected="selected">Seleccionar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="apellido">Dirección</label>
                                <input type="text" class="form-control" id="direccion_edit" name="direccion_edit"
                                    placeholder="C/ Duarte #1">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100" name="edit_server">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>