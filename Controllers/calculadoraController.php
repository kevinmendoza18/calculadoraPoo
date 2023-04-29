<?php

require_once '../Models/calculadoraModel.php';

$calculadora = new calculadoraController;

class calculadoraController
{
    private $calculadora;


    public function __construct()
    {
        $this->calculadora = new CalculadoraModel;
        if (isset($_REQUEST['c'])) {
            switch ($_REQUEST['c']) {
                case 1:
                    self::store();
                    break;
                case 2:
                    self::eliminar();
                    break;
                case 3:
                    self::show();
                    break;
                case 4:
                    self::editar();
                default:
                    # code...
                    break;
            }
        }
    }


    public function index()
    {
        return $this->calculadora->getAll();
    }

    public function store()
    {
        // if (isset($_REQUEST)) {
        //     if (isset($_REQUEST['operacion']) && ($_REQUEST['operacion'] != 0) && isset($_REQUEST['num_uno']) && isset($_REQUEST['num_dos'])) {

        $datos = [
            'num_uno' => $_REQUEST['num_uno'],
            'num_dos' => $_REQUEST['num_dos'],
            'operacion' => $_REQUEST['operacion'],
        ];


        $result = $this->calculadora->store($datos);

        if ($result) {
            header("Location: ../Views/index.php");
            exit();
        }

        return $result;
    }




    public function eliminar()
    {
        $id = $_REQUEST['id'];
        $result = $this->calculadora->eliminar($id);
        if ($result) {
            header("Location: ../Views/index.php");
            exit();
        }
    }

    public function show()
    {
        $id = $_REQUEST['id'];
        header("Location: ../Views/editar.php?id=$id");
    }

    public function editar()
    {
        $datos = [
            'id'        => $_REQUEST['id'],
            'num_uno'   => $_REQUEST['num_uno'],
            'num_dos'   => $_REQUEST['num_dos'],
            'operacion' => $_REQUEST['operacion']
        ];

        $result = $this->calculadora->editar($datos);
        if ($result) {
            header("Location: ../Views/index.php");
            exit();
        }
    }
}
