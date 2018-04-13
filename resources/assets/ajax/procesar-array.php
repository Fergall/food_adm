<?php
$str1 = '';
$str2 = '';
if (!empty($_POST['ordenDetallePromociones'])) {
     // list is empty.
     $promociones = json_decode($_POST['ordenDetallePromociones'], true);
     if (!empty($promociones)) {
       $str1 = json_encode($promociones);
     }
}

if (!empty($_POST['ordenDetalleProductos'])) {
     // list is empty.
     $productos = json_decode($_POST['ordenDetalleProductos'], true);
     if (!empty($productos)) {
       $str2 = json_encode($productos);
     }
}

$str = $str1.$str2;
$str = str_replace("}{", ",", $str);
echo ($str);
 ?>
