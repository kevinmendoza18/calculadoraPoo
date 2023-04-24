<?php

require_once 'conexionModel.php';

class CalculadoraModel
{
    public $n1;
    public $n2;
    public $operacion;

    public function __construct($n1, $n2, $operacion)
    {
        $this->n1 = $n1;
        $this->n2 = $n2;
        $this->operacion = $operacion;
    }

    public function RealizarOperacion()
    {
        switch ($this->operacion) {
            case '1':
                return $this->n1 + $this->n2;
                break;
            case '2':
                return $this->n1 - $this->n2;
                break;
            case '3':
                return $this->n1 * $this->n2;
                break;
            case '4':
                return $this->n1 / $this->n2;
                break;
            default:
                return false;
                break;
        }
    }

    public function store()
    {
        $resultado = self::RealizarOperacion();
        try {
            $sql = 'INSERT INTO operaciones(n1,n2,operaciones ) VALUES(:n1, :n2, :operaciones)';

            $prepare = $this->db->conect()->prepare($sql);
            $query = $prepare->execute([
                'n1'   => $this->n1,
                'n2' => $this->n2,
                'operacion' => $this->operacion,
            ]);
        } catch(PDOException $e){
            return $e->getMessage();
        }

        
        

        return $resultado;
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
