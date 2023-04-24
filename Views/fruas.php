<?php
class Fruta{
    public $color;
    public $tamaño;
}

$miFruta = new Fruta ();

$miFruta->color  = 'verde';
$miFruta->tamaño  = 'pequeño';

echo 'el color es: ' . $miFruta ->color;
echo '<br>';
echo 'el tamaño de la fruta es: ' . $miFruta ->tamaño;
