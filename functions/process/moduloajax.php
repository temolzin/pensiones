<?php
  require_once '../controller/modulocontroller.php';

  $objModulo = new Modulo();
  $accion = $_POST['accion'];

  if($accion == 'read') {
    echo $objModulo->read();
  }
  if($accion == 'readbyidmodulo') {
    $idmodulo = $_POST['idmodulo'];
    echo $objModulo->readbyidmodulo($idmodulo);
  }

