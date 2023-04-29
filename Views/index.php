<?php

include_once  '../Models/calculadoraModel.php';



$datos = new calculadoraModel();
$registros = $datos->getAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e3c1a575a3.js" crossorigin="anonymous"></script>
    <title>calculadora</title>
</head>

<body class="m-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Calculadora</h1>
                <form action="../Controllers/calculadoraController.php" method="POST">
                    <input type="hidden" name="c" value="1">
                    <div class="mb-3">
                        <label for="" class="form-label">Número uno </label>
                        <input class="form-control" type="number" name="num_uno">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Número dos</label>
                        <input class="form-control" type="number" name="num_dos">
                    </div>
                    <div class="mb-3">
                        <label for="">Seleccione Operación</label>
                        <select class="form-select" name="operacion">
                            <option value="1">Sumar</option>
                            <option value="2">Restar</option>
                            <option value="3">Multiplicar</option>
                            <option value="4">Dividir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-sm btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
            </div>


            <table class="table">
                <thead>

                    <tr class="table table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Numero 1</th>
                        <th scope="col">Numero 2</th>
                        <th scope="col">Operación</th>
                        <th scope="col">Resultado</th>
                        <th scope="col" colspan="2">opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($registros) {

                        foreach ($registros as $row) {

                    ?>
                            <tr>
                                <td> <?= $row->id ?></td>
                                <td> <?= $row->num_uno ?></td>
                                <td> <?= $row->num_dos ?></td>
                                <td> <?= $row->operacion ?></td>
                                <td> <?= $row->resultado   ?></td>
                                <td>
                                    <a href="../Controllers/calculadoraController.php?c=3&id=<?= $row->getId() ?>" class="btn btn-small btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>

                                <td>
                                    <a href="../Controllers/calculadoraController.php?c=2&id=<?= $row->getId() ?>" name="btnDelete" class="btn btn-small btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>




            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        </div>
    </div>
</body>

</html>