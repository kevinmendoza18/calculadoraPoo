<?php

require_once '../Models/calculadoraModel.php';

class calculadoraController
{


    public function __construct()
    {
        switch ($GET = "C") {
            case '1':
                self::store();
                break;

            default:
                # code...
                break;
        }
    }

    public function store()
    {

        $n1 = $_REQUEST['n1'];
        $n2 = $_REQUEST['n2'];
        $operacion = $_REQUEST['operacion'];

        $modelo = new CalculadoraModel($n1, $n2, $operacion);

        $modelo->store();
    }
}
