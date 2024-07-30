
<?php

include_once '../../includes/header.php'; ?>
<div class="container">
    <h1 class="text-center">Formulario de vehiculos</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="veh_id" id="veh_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="veh_marca">Marca del Vehiculo</label>
                    <input type="text" name="veh_marca" id="veh_marca" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="veh_modelo">Modelo del Vehiculo</label>
                    <input type="text" name="veh_modelo" id="veh_modelo" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="veh_matricula">Matricula del Vehiculo</label>
                    <input type="text" name="veh_matricula" id="veh_matricula" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-secondary w-100">Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-secondary w-100">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">Listado de Vehiculos</h2>
            <table class="table table-bordered table-hover bg-light" id="tablaVehiculos">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Matricula</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">No hay Clientes registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="../../src/js/funciones.js"></script>
<script defer src="../../src/js/vehiculos/index.js"></script>
<?php include_once '../../includes/foother.php'; ?>
