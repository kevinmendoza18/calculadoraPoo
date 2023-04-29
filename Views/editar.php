<?php
require_once('../Models/conexionModel.php');
include_once  '../Models/calculadoraModel.php';

$datos = new calculadoraModel();

$id = $_REQUEST['id'];
$registros = $datos->getbyId($id);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e3c1a575a3.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body class="m-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Editar Datos</h1>
                <form action="../Controllers/calculadoraController.php" method="POST">

                    <?php
                    if ($registros) {

                        foreach ($registros as $row) {

                    ?>
                            <input type="hidden" name="c" value="4">
                            <input type="hidden" name="id" value="<?= $row->getId() ?>">

                            <div class="mb-3">
                                <label for="" class="form-label">Número uno </label>
                                <input class="form-control" type="number" name="num_uno" id="num_uno" value="<?= $row->num_uno ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Número dos</label>
                                <input class="form-control" type="number" name="num_dos" id="num_dos" value="<?= $row->num_dos ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Seleccione Operación</label>
                                <select class="form-select" name="operacion" value="<?= $row->operacion ?>">
                                    <option value="1">Sumar</option>
                                    <option value="2">Restar</option>
                                    <option value="3">Multiplicar</option>
                                    <option value="4">Dividir</option>
                                </select>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="mb-3">
                        <button class="btn btn-sm btn-primary" type="submit">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>