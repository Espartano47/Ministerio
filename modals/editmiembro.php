<!-- Modal para editar -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 5%;max-width: 900px;">
        <div class="modal-content">
            <div class="card-header">
                <h2 class="card-title" style="font-size: 26px;"><strong>EDITAR</strong></h2>
            </div>
            <!-- Formulario -->
            <form id="editMiembroForm" method="post" action="saves/edit_miembro.php">
                <div class="card-body" style="padding:5%">
                    <!-- Campos -->
                    <!-- Asegúrate de cambiar los IDs y los `for` en las etiquetas label para que coincidan con los nuevos IDs -->
                    <!-- Ejemplo: -->
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="edit_cedula">Cédula</label>
                            <input type="text" class="form-control" id="edit_cedula" name="edit_cedula" required
                                data-inputmask='"mask": "999-9999999-9"' data-mask>
                            <input type="hidden" id="inputId" name="inputId">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="edit_nombre" name="edit_nombre" placeholder=""
                                required>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="edit_apellido" name="edit_apellido"
                                placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Host">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="edit_fechanacimiento"
                                name="edit_fechanacimiento" placeholder="Área">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Género</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="edit_sexo"
                                name="edit_sexo">
                                <option value="">Seleccionar</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Ocupación</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="edit_ocupacion"
                                name="edit_ocupacion">
                                <option value="" selected="selected">Seleccionar</option>
                                <?php foreach ($ocupaciones as $ocupacion) : ?>
                                    <option value="<?php echo $ocupacion['id']; ?>"><?php echo $ocupacion['descripcion']; ?></option>
                                <?php endforeach; ?>
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
                                <input type="text" class="form-control" id="edit_telefono" name="edit_telefono"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Host">Célular</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" id="edit_celular" name="edit_celular"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="area-input">Correo</label>
                            <input type="text" class="form-control" id="edit_correo" name="edit_correo"
                                placeholder="edit_correo">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="provincia">Provincia</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="edit_provincia"
                                name="edit_provincia">
                                <option value="" selected="selected">Seleccionar</option>
                                <?php foreach ($provincias as $provincia) : ?>
                                    <option value="<?php echo $provincia['name']; ?>"><?php echo $provincia['name']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="area-input">Municipio</label>
                            <select class="form-control select2bs4" style="width: 100%;" id="edit_municipio"
                                name="edit_municipio">
                                <option value="" selected="selected">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="apellido">Dirección</label>
                            <input type="text" class="form-control" id="edit_direccion" name="edit_direccion"
                                placeholder="C/ Duarte #1">
                        </div>
                    </div>
                    <!-- Continúa actualizando otros campos de manera similar -->

                    <!-- Botón -->
                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary flex-grow-1" name="edit_miembro"
                            id="edit_guardar">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>