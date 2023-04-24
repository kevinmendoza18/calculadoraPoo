<?php

require_once 'conexionModel.php';

class CalculadoraModel
{
    public $n1;
    public $n2;
    public $operacion;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function RealizarOperacion($datos)
    {

        switch ($datos['operacion']) {
            case '1':
                return $datos['n1'] + $datos['n2'];
                break;
            case '2':
                return $datos['n1'] - $datos['n2'];
                break;
            case '3':
                return $datos['n1'] * $datos['n2'];
                break;
            case '4':
                return $datos['n1'] / $datos['n2'];
                break;
            default:
                return false;
                break;
        }
    }

    public function store($datos)
    {
        $resultado = self::RealizarOperacion($datos);



        try {
            $sql = 'INSERT INTO operaciones(n1,n2,operacion, resultado ) VALUES(:n1, :n2, :operacion, :resultado)';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'n1'        => $datos['n1'],
                'n2'        => $datos['n2'],
                'operacion' => $datos['operacion'],
                'resultado' => $resultado,
            ]);

            if ($query) {
                return true;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
            exit();
        }
    }
}

// $n1 = $_REQUEST['n1'];
// $n2 = $_REQUEST['n2'];
// $operacion = $_REQUEST['operacion'];

// $calcular = new CalculadoraModel($n1, $n2, $operacion);
// $calcular->n1 =  ['n1'];
// $calcular->n2 =  ['n2'];
// $calcular->operacion =  ['operacion'];

// $calcular = new CalculadoraModel($n1, $n2, $operacion);
// $resultado = $calcular->RealizarOperacion();


// echo "el primer numnero es: " . $n1;
// echo "<br>";
// echo "el segundo numnero es: " . $n2;
// echo "<br>";
// echo "el resultado es: " . $resultado;
