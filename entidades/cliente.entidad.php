<?php 

class cliente
{
    private $idcliente;
    private $cuit;
    private $correo;
    private $tel;
    private $nombre;

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

            $this->cuit=$formu["txtCuit"];
            $this->correo = $formu["txtEmail"];
            $this->nombre= $formu["txtName"];
            $this->tel= $formu["txtTel"];
            $this->idcliente= $formu["idcliente"];



    }
    public function insertar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("INSERT INTO clientes (cuitcliente, nombrecliente, telefonocliente, correocliente)
         VALUE ('$this->cuit', '$this->nombre', '$this->tel', '$this->correo')");
    }
    public function actualizar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
          UPDATE  clientes 
          SET 
          cuitcliente = '$this->cuit',
          nombrecliente = '$this->nombre', 
          telefonocliente = '$this->tel' ,
          correocliente  ='$this->correo'
          WHERE idcliente = '$this->idcliente'");
    }
    public function borrar()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $mysql->query("
         DELETE FROM clientes
         WHERE idcliente = '$this->idcliente'");
    }

    // public function lista()
    // {
    //      $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
    //      $arrayBBDD = $mysql->query("SELECT * FROM clientes");
    //       return $arrayBBDD;
    // }

    public function listaPOO()
    {
         $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
         $resultado = $mysql->query("SELECT * FROM clientes");
         $aclientes = array();
         if($resultado)
         {
             while($fila= $resultado->fetch_assoc())
             {
                 $obj = new cliente();
                 $obj ->idcliente = $fila["idcliente"];
                 $obj->nombre = $fila["nombrecliente"];
              $obj->cuit =  $fila["cuitcliente"];
              $obj->tel = $fila["telefonocliente"];  
              $obj->correo = $fila["correocliente"] ;
              $aclientes[]= $obj;
             }

             return $aclientes;
         }
         
    }


    public function obtenerId($idcliente)
    {
     $mysql = new mysqli(BBDD::BBDD_HOST, BBDD::BBDD_USUARIO, BBDD::BBDD_PASS,BBDD::BBDD_NOMBRE);
     $resultado = $mysql->query("SELECT * FROM clientes WHERE idcliente = '$idcliente'");
         if($resultado)
         {
             $fila= $resultado->fetch_assoc();
             $obj = new cliente();
                 $obj ->idcliente = $fila["idcliente"];
                 $obj->nombre = $fila["nombrecliente"];
              $obj->cuit =  $fila["cuitcliente"];
              $obj->tel = $fila["telefonocliente"];  
              $obj->correo = $fila["correocliente"] ;
             

             return $obj;
         }


    }








}





?>