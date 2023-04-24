<?php

require_once '../Models/calculadoraModel.php';

$calculadora = new calculadoraController;

class calculadoraController
{
    public function __construct()
    {
        switch ($_REQUEST['c']) {
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
        $datos = [
            'n1' => $_REQUEST['n1'],
            'n2' => $_REQUEST['n2'],
            'operacion' => $_REQUEST['operacion'],
        ];

        $calculadora = new CalculadoraModel();
        $result = $calculadora->store($datos);

        if ($result) {
            echo 'Se ha agregado la nueva operación';
        }

        
        return $result;
    }
}
