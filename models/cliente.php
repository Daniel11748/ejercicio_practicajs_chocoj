<?php
require_once 'conexion.php';


class cliente extends Conexion
{
    public $cli_id;
    public $cli_nombre;
    public $cli_direccion;
    public $cli_telefono;
    public $cli_situacion;


    public function __construct($args = [])
    {
        $this->cli_id = $args['cli_id'] ?? null;
        $this->cli_nombre = $args['cli_nombre'] ?? '';
        $this->cli_direccion = $args['cli_direccion'] ?? '';
        $this->cli_telefono = $args['cli_telefono'] ?? '';
        $this->cli_situacion = $args['cli_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO clientes (cli_nombre, cli_direccion, cli_telefono) values ('$this->cli_nombre','$this->cli_direccion', '$this->cli_telefono')";
         echo  json_encode($sql); 
        $resultado = self::ejecutar($sql);
        return $resultado;
    }
    public function buscar()
    {
        $sql = "SELECT * from clientes where cli_situacion = 1 ";

        if ($this->cli_nombre != '') {
            $sql .= " and cli_nombre like '%$this->cli_nombre%' ";
        }

        if ($this->cli_direccion != '') {
            $sql .= " and cli_direccion like '%$this->cli_direccion%' ";
        }

        if ($this->cli_telefono != '') {
            $sql .= " and cli_telefono like '%$this->cli_telefono%' ";
        }

        if ($this->cli_id != null) {
            $sql .= " and cli_id = '$this->cli_id' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE clientes SET cli_nombre = '$this->cli_nombre', cli_direccion = '$this->cli_direccion', cli_telefono =$this->cli_telefono where cli_id = $this->cli_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }
//CUANDO SE USA UN UPDATE SIEMPRE SE DEBE VERIFICAR QUE LLEVE EL "WHERE" EN EL SQL PARA NO MODIFICAR TODOS LOS DARTOS DE NUESTRA TABLA.

    public function eliminar()
    {
        $sql = "UPDATE clientes SET cli_situacion = 0 where cli_id = $this->cli_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}

