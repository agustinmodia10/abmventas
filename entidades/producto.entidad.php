<?php 

class producto
{
    private $idproducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $descripcion;

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

            $this->nombre=$formu["txtNameProducto"];
            $this->cantidad = $formu["numCan"];
            $this->precio= $formu["numPrecio"];
            $this->descripcion= $formu["txtDesc"];
            $this->idproducto= $formu["idproducto"];



    }
    public function insertar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("INSERT INTO productos (nombreproducto, cantidadproducto, precioproducto, descripcionproducto)
         VALUE ('$this->nombre', '$this->cantidad', '$this->precio', '$this->descripcion')");
    }
    public function actualizar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
          UPDATE  productos 
          SET 
          nombreproducto = '$this->nombre',
          cantidadproducto = '$this->cantidad', 
          precioproducto = '$this->precio' ,
          descripcionproducto  ='$this->descripcion'
          WHERE idproducto = '$this->idproducto'");
    }
    public function borrar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
         DELETE FROM productos
         WHERE idproducto = '$this->idproducto'");
    }
    public function lista()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $arrayBBDD = $mysql->query("SELECT * FROM productos");
         return $arrayBBDD;
    }

    public function listaPOO()
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM productos");
         $aProductos = array();
         if($resultado)
         {
             while($fila= $resultado->fetch_assoc())
             {
               $obj = new producto();
               $obj->nombre=$fila["nombreproducto"];
               $obj->cantidad = $fila["cantidadproducto"];
               $obj->precio= $fila["precioproducto"];
               $obj->descripcion= $fila["descripcionproducto"];
               $obj->idproducto= $fila["idproducto"];
              $aProductos[]= $obj;
             }

             return $aProductos;
         }
         
    }


    public function obtenerId($idcliente)
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM productos WHERE idproducto = '$idcliente'");
         if($resultado)
         {
             $fila= $resultado->fetch_assoc();
             $obj = new producto();
             $obj->nombre=$fila["nombreproducto"];
             $obj->cantidad = $fila["cantidadproducto"];
             $obj->precio= $fila["precioproducto"];
             $obj->descripcion= $fila["descripcionproducto"];
             $obj->idproducto= $fila["idproducto"];
             

             return $obj;
         }


    }
}





?>