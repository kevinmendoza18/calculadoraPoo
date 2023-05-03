<?php
include_once dirname(__FILE__) . '../../config/config_example.php';
require_once 'conexionModel.php';


class CalculadoraModel extends stdClass
{
    public $id;
    public $nun_uno;
    public $num_dos;
    public $operacion;
    public $resultado;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getbyId($id)
    {
        $operacion = [];

        try {
            $sql = "SELECT * FROM operaciones WHERE id = $id";
            $query  = $this->db->conect()->query($sql);


            while ($row = $query->fetch()) {
                $item            = new CalculadoraModel();
                $item->id        = $row['id'];
                $item->num_uno   = $row['num_uno'];
                $item->num_dos   = $row['num_dos'];
                $item->operacion = $row['operacion'];
                $item->resultado = $row['resultado'];

                array_push($operacion, $item);
            }

            return $operacion;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAll()
    {
        $items = [];

        try {
            
            $sql = 'SELECT operaciones.id, operaciones.num_uno, operaciones.num_dos, operacion.nombre AS operacion, operaciones.resultado FROM operaciones JOIN operacion  ON operaciones.operacion = operacion.id';
            $query  = $this->db->conect()->query($sql);
            

            while ($row = $query->fetch()) {
                $item            = new CalculadoraModel();
                $item->id        = $row['id'];
                $item->num_uno   = $row['num_uno'];
                $item->num_dos   = $row['num_dos'];
                $item->operacion = $row['operacion'];
                $item->resultado = $row['resultado'];

                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    
    public function store($datos)
    {
        try {
            $resultado = self::RealizarOperacion($datos);

            $sql = 'INSERT INTO operaciones(num_uno, num_dos, operacion, resultado) VALUES(:num_uno, :num_dos, :operacion, :resultado)';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'num_uno'        => $datos['num_uno'],
                'num_dos'        => $datos['num_dos'],
                'operacion' => $datos['operacion'],
                'resultado' => $resultado,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
            
    }

    public function editar($datos)
    {
        try {

            $resultado = self::RealizarOperacion($datos);
            $sql = 'UPDATE operaciones SET num_uno = :num_uno, num_dos = :num_dos, operacion = :operacion, resultado = :resultado WHERE id = :id';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'id'        => $datos['id'],
                'num_uno'   => $datos['num_uno'],
                'num_dos'   => $datos['num_dos'],
                'operacion' => $datos['operacion'],
                'resultado' => $resultado,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function eliminar($id)
    {
        try {
            
            
            $sql = "DELETE FROM operaciones WHERE id = :id";
            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'id'   => $id,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function RealizarOperacion($datos)
    {

        switch ($datos['operacion']) {
            case '1':
                return $datos['num_uno'] + $datos['num_dos'];
                break;
            case '2':
                return $datos['num_uno'] - $datos['num_dos'];
                break;
            case '3':
                return $datos['num_uno'] * $datos['num_dos'];
                break;
            case '4':
                return $datos['num_uno'] / $datos['num_dos'];
                break;
            default:
                return false;
                break;
        }
    }
}

