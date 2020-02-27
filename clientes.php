<?php
include_once "config.php";
 include_once "entidades/cliente.entidad.php";
 $id ="";
 $clienteId = new cliente();
 if(isset ($_GET["idcliente"])&& $_GET["idcliente"] >= 0)
 {
 $id= $_GET["idcliente"];

 $clienteXId = $clienteId->obtenerId($id);

   $nombreClienteId = $clienteXId ->nombre;
   $cuitClienteId = $clienteXId->cuit;
   $emailClienteId = $clienteXId->correo;
   $telClienteId = $clienteXId->tel;

 }
// preguntar si viene boton enviar
if(isset($_POST))
{


  
 
  $objcliente = new cliente();

    if(isset($_POST["btnEnviar"]) )
    {

      //insertar en la base de datos

      //  llamar cliente
      // llamo a la carga de formulario
      $objcliente ->cargadesdeformulario($_REQUEST);
      // llamo para insertar el cliente
      $objcliente -> insertar();
    }

    else if(isset($_POST["btnAct"]) )
    {
      $objcliente ->cargadesdeformulario($_REQUEST);

      $objcliente -> actualizar();

    }

    else if(isset($_POST["btnBorrar"]) )
    {
      $objcliente ->cargadesdeformulario($_REQUEST);

      $objcliente -> borrar();

    }
    // // LE PASO EL CONTENIDO DE LA BBDD A UNA VARIABLE PARA DESPUES MOSTRAR
    // $arrayBBDD = $objcliente ->lista();

  }
    // LE PASO EL CONTENIDO DE LA BBDD A UNA VARIABLE PARA DESPUES MOSTRAR
   
   $objClienteFueraPOST =new cliente();
    $objlista = $objClienteFueraPOST ->listaPOO();
?>
<?php include("headerambventas.php"); ?>
    <div class="row">
    <div class="col-12">
    <br>
    <br>
    <h1>
    REGISTRO DE CLIENTES
    </h1>
    <br>
    <br>
    </div>
    </div>

    <div class="row">
    <div class="col-12">

    <div class="col-12">

    <form action="" method="POST"> 
          <br>
          <div class="row">
            <div class="col-6" >
             <label for="txtCuit" > Cuit*:</label>     
            </div>
            <div class="col-6" >         
              <label for="txtName" > Nombre*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >
                                                                                              
                  <input type="text" id="txtCuit" name="txtCuit" class="form-control   " value="<?php  echo isset($cuitClienteId)?$cuitClienteId : ""; ?>" required>    
                </div>
                <div class="col-6" >
                  <input type="text" id="txtName" name="txtName" class="form-control   " value="<?php  echo isset($nombreClienteId)? $nombreClienteId : ""; ?>" required>    
         </div>
         </div>
          <br>
          <div class="row">
            <div class="col-6" >
             <label for="txtTel" > TELEFONO*:</label>     
            </div>
            <div class="col-6" >         
              <label for="txtEmail" > CORREO*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >
                  
                  <input type="tel" id="txtTel" name="txtTel" class="form-control   " value="<?php  echo isset($telClienteId)? $telClienteId : ""; ?>" required>    
                </div>
                <div class="col-6" >
                  <input type="email" id="txtEmail" name="txtEmail" class="form-control   " value="<?php  echo isset($emailClienteId)? $emailClienteId : ""; ?>" required>
                  <br>    
         </div>
         </div>
    <div class="row">
              <div class="col-3" >
              <input type="submit" id = "btnEnviar" name="btnEnviar" value="Enviar"  class= " btn btn-primary"> 
              </div> 
              <div class="col-3" >
              <a href="index.php " class=" btn btn-secondary">Limpiar</a>
              <!-- <input type="reset" id = "btnLimpiar" name="btnLimpiar" value="Limpiar"  class=" btn btn-secondary">  -->
              </div> 
              <div class="col-3" >
              <input type="submit" id = "btnBorrar" name="btnBorrar" value="Borrar"  class="btn btn-danger"> 
              </div> 
              <div class="col-3" >
              <input type="submit" id = "btnAct" name="btnAct" value="Actualizar"  class="btn btn-success"> 
              </div> 

      </div>
          </form>
          </div> 

<br>
      <div class="col-12">
      <table class="table table-hover ">
    <tr>
            <td class="col-2"> ID </td>
            <td class="col-2"> NOMBRE </td>
            <td class="col-2"> CUIT </td>
            <td class="col-2"> TELEFONO </td>
            <td class="col-2"> EMAIL </td>
    </tr>

    <?php    

      foreach($objlista as $obj ):     ?>
        <tr>
        <td>
         <a  href="index.php?idcliente=<?php  echo $obj ->idcliente; ?> "> <?php  echo $obj ->idcliente?> </a>
        </td>
        <td>
             <?php  echo $obj->nombre ?>
        </td>
        <td>
        <a  href="index.php?idcliente=<?php  echo$obj ->idcliente; ?> "> <?php  echo $obj->cuit ?> </a>
        </td>
        <td>
             <?php  echo  $obj->tel?>
        </td>
        <td>
        <a  href="mailto<?php echo  $obj->correo ?>" > <?php echo $obj->correo?> </a>
        </td>
        
         <?php endforeach;



      ?>
  

       

    
      </table>
      </div> 
       </div>
      </div> 

  

        
     
    
    </div>
</body>
</html>