<?php
require_once 'conexion.php';

class Servicio extends Conexion
{
    public $ser_id;
    public $ser_cli_id;
    public $ser_veh_id;
    public $ser_fecha;
    public $ser_descripcion;
    public $ser_costo;
    public $ser_situacion;

    public function __construct($args = [])
    {
        $this->ser_id = $args['ser_id'] ?? null;
        $this->ser_cli_id = $args['ser_cli_id'] ?? '';
        $this->ser_veh_id = $args['ser_veh_id'] ?? '';
        $this->ser_fecha = $args['ser_fecha'] ?? '';
        $this->ser_descripcion = $args['ser_descripcion'] ?? '';
        $this->ser_costo = $args['ser_costo'] ?? '';
        $this->ser_situacion = $args['ser_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO servicios (ser_cli_id, ser_veh_id, ser_fecha, ser_descripcion, ser_costo, ser_situacion) 
                VALUES ('$this->ser_cli_id', '$this->ser_veh_id', '$this->ser_fecha', '$this->ser_descripcion', '$this->ser_costo', '$this->ser_situacion')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }


    public function mostrarDatos()
    {
        $sql = "SELECT ser_id, ser_cli_id,
    servicios.ser_id AS ser_id, 
    clientes.cli_nombre AS ser_cli_id, 
    vehiculos.veh_marca AS ser_veh_id, 
    servicios.ser_fecha AS ser_fecha, 
    servicios.ser_descripcion AS ser_descripcion,
    servicios.ser_costo AS ser_costo

FROM 
    servicios
INNER JOIN 
    clientes ON servicios.ser_cli_id = clientes.cli_id
INNER JOIN 
    vehiculos ON servicios.ser_veh_id = vehiculos.veh_id
WHERE 
    servicios.ser_situacion = 1;";

        $resultado = self::servir($sql);
        return $resultado;
    }

    // public function buscar()
    // {
    //     $sql = "SELECT s.*, c.cli_nombre, v.veh_marca, v.veh_modelo 
    //             FROM servicios s
    //             INNER JOIN clientes c ON s.ser_cli_id = c.cli_id
    //             INNER JOIN vehiculos v ON s.ser_veh_id = v.veh_id
    //             WHERE s.ser_situacion = 1";

    //     if ($this->ser_cli_id != '') {
    //         $sql .= " AND s.ser_cli_id = '$this->ser_cli_id'";
    //     }

    //     if ($this->ser_veh_id != '') {
    //         $sql .= " AND s.ser_veh_id = '$this->ser_veh_id'";
    //     }

    //     if ($this->ser_fecha != '') {
    //         $sql .= " AND s.ser_fecha = '$this->ser_fecha'";
    //     }

    //     if ($this->ser_descripcion != '') {
    //         $sql .= " AND s.ser_descripcion LIKE '%$this->ser_descripcion%'";
    //     }

    //     if ($this->ser_id != null) {
    //         $sql .= " AND s.ser_id = '$this->ser_id'";
    //     }

    //     $resultado = self::servir($sql);
    //     return $resultado;
    // }

    public function modificar()
    {
        $sql = "UPDATE servicios 
                SET ser_cli_id = '$this->ser_cli_id', ser_veh_id = '$this->ser_veh_id', ser_fecha = '$this->ser_fecha', 
                    ser_descripcion = '$this->ser_descripcion', ser_costo = '$this->ser_costo', ser_situacion = '$this->ser_situacion'
                WHERE ser_id = $this->ser_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE servicios SET ser_situacion = 0 WHERE ser_id = $this->ser_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}
