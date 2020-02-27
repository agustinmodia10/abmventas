<?php 

class venta
{
    private $idventa;
    private $fecha;
    private $importe;
    private $fk_idCliente;
    private $fk_idProducto;
    private $fk_nombreCliente;
    private $fk_nombreProducto;

    public function __get($atributo)
    {
        return $this->$atributo;
    }
    public function __set($atributo,$valor)
    {
        $this->$atributo = $valor;
        return $this;
    }


    public function cargadesdeformulario($formu)
    {      
          //     print_r($formu);

            $this->fecha=$formu["fechaVenta"];
            $this->importe = $formu["numImporte"];
            $this->fk_idCliente= $formu["idClienteV"];
            $this->fk_idProducto= $formu["idProducto"];
           $this->idventa= isset ($formu["idventa"])? $formu["idventa"]:0;




    }
    public function insertar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("INSERT INTO ventas (fechaventa, importeventa, fk_idclienteventa, fk_idproductoventa)
         VALUE ('$this->fecha', '$this->importe', '$this->fk_idCliente', '$this->fk_idProducto')");
    }
    public function actualizar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
          UPDATE  ventas 
          SET 
          fechaventa = '$this->fecha',
          importeventa = '$this->importe', 
          fk_idclienteventa = '$this->fk_idCliente' ,
          fk_idproductoventa  ='$this->fk_idProducto'
          WHERE idventa = '$this->idventa'");
    }
    public function borrar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
         DELETE FROM ventas
         WHERE idventa = '$this->idventa'");
    }
    public function listaProductos()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $arrayBBDD = $mysql->query("SELECT * FROM productos");
         return $arrayBBDD;
         
    }   
    
    public function listaCliente()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $arrayBBDD = $mysql->query("SELECT * FROM clientes");
         return $arrayBBDD;
         
    }
    public function listaVentas()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $arrayBBDD = $mysql->query("SELECT * FROM ventas");
         return $arrayBBDD;
         
    }

    public function listaPOO()
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM ventas");
     $aVentas = array();
         if($resultado)
         {
             while($fila= $resultado->fetch_assoc())
             {
               $obj = new venta();
               $obj->fecha=$fila["fechaventa"];
               $obj->importe = $fila["importeventa"];
               $obj->fk_idCliente= $fila["fk_idclienteventa"];
               $obj->fk_idProducto= $fila["fk_idproductoventa"];
              $obj->idventa= $fila["idventa"];
               $nombreClienteId =  $obj->obtenerIdCliente($obj->fk_idCliente);
               $obj->fk_nombreCliente = $nombreClienteId;
               $nombreProductoId =  $obj->obtenerIdProducto($obj->fk_idProducto);
               $obj->fk_nombreProducto = $nombreProductoId;
              $aVentas[]= $obj;
             }

             return $aVentas;
         }
         
    }


    public function obtenerIdCliente($idcliente)
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM clientes WHERE idcliente = '$idcliente'");
     $nombre = "";
          if($resultado)
         {
             $fila= $resultado->fetch_assoc();
             $nombre=$fila["nombrecliente"];

             

             return $nombre;
         }
    }
    public function obtenerIdProducto($id)
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM productos WHERE idproducto = '$id'");
     $nombre = "";
          if($resultado)
         {
             $fila= $resultado->fetch_assoc();
             $nombre=$fila["nombreproducto"];

             

             return $nombre;
         }
    }

    public function obtenerIdVentas($id)
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM ventas WHERE idventa = '$id'");
            if($resultado)
         {
             $fila= $resultado->fetch_assoc();
             $obj = new venta();
             $obj->idventa = $id;
               $obj->fecha=$fila["fechaventa"];
               $obj->importe = $fila["importeventa"];
               $obj->fk_idCliente= $fila["fk_idclienteventa"];
               $obj->fk_idProducto= $fila["fk_idproductoventa"];
              $obj->idventa= $fila["idventa"];
               $nombreClienteId =  $obj->obtenerIdCliente($obj->fk_idCliente);
               $obj->fk_nombreCliente = $nombreClienteId;
               $nombreProductoId =  $obj->obtenerIdProducto($obj->fk_idProducto);
               $obj->fk_nombreProducto = $nombreProductoId;
             

             return $obj;
         }


    }






}





?>