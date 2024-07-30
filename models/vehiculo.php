<?php
require_once 'conexion.php';


class vehiculo extends Conexion
{
    public $veh_id;
    public $veh_marca;
    public $veh_modelo;
    public $veh_matricula;
    public $veh_situacion;


    public function __construct($args = [])
    {
        $this->veh_id = $args['veh_id'] ?? null;
        $this->veh_marca = $args['veh_marca'] ?? '';
        $this->veh_modelo = $args['veh_modelo'] ?? '';
        $this->veh_matricula = $args['veh_matricula'] ?? '';
        $this->veh_situacion = $args['veh_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO vehiculos (veh_marca, veh_modelo, veh_matricula) values ('$this->veh_marca','$this->veh_modelo', '$this->veh_matricula')";
         echo  json_encode($sql); 
        $resultado = self::ejecutar($sql);
        return $resultado;
    }
    public function buscar()
    {
        $sql = "SELECT * from vehiculos where veh_situacion = 1 ";

        if ($this->veh_marca != '') {
            $sql .= " and veh_marca like '%$this->veh_marca%' ";
        }

        if ($this->veh_modelo != '') {
            $sql .= " and veh_modelo like '%$this->veh_modelo%' ";
        }

        if ($this->veh_matricula != '') {
            $sql .= " and veh_matricula like '%$this->veh_matricula%' ";
        }

        if ($this->veh_id != null) {
            $sql .= " and veh_id = '$this->veh_id' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE vehiculos SET veh_marca = '$this->veh_marca', veh_modelo = '$this->veh_modelo', veh_matricula =$this->veh_matricula where veh_id = $this->veh_id";
        $resultado = self::ejecutar($sql);
        return $resultado;    
        json_encode($sql);

    }

//CUANDO SE USA UN UPDATE SIEMPRE SE DEBE VERIFICAR QUE LLEVE EL "WHERE" EN EL SQL PARA NO MODIFICAR TODOS LOS DARTOS DE NUESTRA TABLA.

    public function eliminar()
    {
        $sql = "UPDATE vehiculos SET veh_situacion = 0 where veh_id = $this->veh_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}

