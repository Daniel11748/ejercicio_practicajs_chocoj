<?php include_once '../../includes/header.php';

require '../../models/cliente.php';
$cliente = new cliente($_GET);
$clientes = $cliente -> buscar();

require '../../models/vehiculo.php';
$vehiculo = new vehiculo($_GET);
$vehiculos = $vehiculo -> buscar();

 ?>

<div class="container">
    <h1 class="text-center">Formulario de Servicios</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="ser_id" id="ser_id">
            <div class="col">
                <label for="ser_cli_id">CLIENTE</label>
                <select name="ser_cli_id" id="ser_cli_id" class="form-select" required>
                    <option value="" selected>SELECCIONAR UN CLIENTE</option>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente['cli_id']; ?>"><?php echo $cliente['cli_nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="ser_veh_id">VEHICULO</label>
                    <select name="ser_veh_id" id="ser_veh_id" class="form-select" required>
                        <option value="" selected>SELECCIONAR UN VEHICULO</option>
                        <?php foreach ($vehiculos as $vehiculo) : ?>
                            <option value="<?php echo $vehiculo['veh_id']; ?>"><?php echo $vehiculo['veh_marca']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="ser_fecha">Fecha del Servicio</label>
                    <input type="date" name="ser_fecha" id="ser_fecha" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="ser_descripcion">Descripcion del Servicio Realizado</label>
                    <input type="text" name="ser_descripcion" id="ser_descripcion" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="ser_costo">Costo del Servicio Realizado</label>
                    <input type="text" name="ser_costo" id="ser_costo" class="form-control" required>
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
            <h2 class="text-center">Listado de Servicios</h2>
            <table class="table table-bordered table-hover bg-light" id="tablaServicios">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Cliente</th>
                        <th>Vehiculo</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7">No hay Servicios registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="../../src/js/funciones.js"></script>
<script defer src="../../src/js/servicios/index.js"></script>
<?php include_once '../../includes/foother.php'; ?>