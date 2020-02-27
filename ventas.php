<?php

 include_once "config.php";
 include_once "entidades/ventas.entidad.php";
 include_once "entidades/producto.entidad.php";
  $id ="";
  if(isset ($_GET["idventa"])&& $_GET["idventa"] >= 0)
  {
  $id= $_GET["idventa"];
 
     


  $objventaid  = new venta();
  $ventaid = $objventaid->obtenerIdVentas($id);

    $idVentaId =$ventaid->idventa;
    $importeVentaId = $ventaid->importe;
    $fechaVentaId = $ventaid->fecha;
    $clienteVentaId = $ventaid->fk_idCliente;
    $productoVentaId = $ventaid->fk_idProducto;
    $clienteVentaIdNombre = $ventaid->fk_nombreCliente;
    $productoVentaIdNombre = $ventaid->fk_nombreProducto;
  
  }
//  preguntar si viene boton enviar
 if(isset($_POST))
 {
 
 
   
  
   $objventa = new venta();
 
     if(isset($_POST["btnEnviar"]) )
     {
 
      //insertar en la base de datos
 
      //  llamar producto
      // llamo a la carga de formulario
      $objventa ->cargadesdeformulario($_REQUEST);
      // llamo para insertar el producto
       $objventa -> insertar();

     }
 
     else if(isset($_POST["btnAct"]) )
     {
       $objventa ->cargadesdeformulario($_REQUEST);
 
       $objventa -> actualizar();
 
     }
 
     else if(isset($_POST["btnBorrar"]) )
     {
       $objventa ->cargadesdeformulario($_REQUEST);
 
       $objventa -> borrar();
 
     }
     // LE PASO EL CONTENIDO DE LA BBDD A UNA VARIABLE PARA DESPUES MOSTRAR
     $listaVentas = $objventa ->listaVentas();
     $listaclientes = $objventa ->listaCliente();
    //  $listaProductos = $objventa ->listaProductos();
 
   }
 
 
 
   $objventaFueraPOST = new venta();
   $listaVentas = $objventaFueraPOST ->listaPOO();
   $listaclientes = $objventaFueraPOST ->listaCliente();
  //  $listaProductos = $objventaFueraPOST ->listaProductos();

   $objproducto = new producto();
   $listaProductos=  $objproducto->listaPOO();
?>
<?php include("headerambventas.php"); ?>
    <div class="row">
    <div class="col-12">
    <br>
    <br>
    <h1>
    REGISTROS DE VENTAS
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
             <label for="fechaVenta" > FECHA DE VENTA*:</label>     
            </div>
            <div class="col-6" >         
              <label for="numImporte" > IMPORTE*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >

          <input type="date" id="fechaVenta" name="fechaVenta" value="<?php  echo isset($fechaVentaId)? $fechaVentaId : ""; ?>">

          </div>
                <div class="col-6" >
                  <input type="number" id="numImporte" name="numImporte" class="form-control   " value="<?php  echo isset($importeVentaId)? $importeVentaId : ""; ?>" required>    
         </div>
         </div>
          <br>
          <div class="row">
            <div class="col-6" >
             <label for="idProducto" > PRODUCTO*:</label>     
            </div>
            <div class="col-6" >         
              <label for="idClienteV" > CLIENTE*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >
                  
          <select name="idProducto">
          <option selected value="<?php  echo isset($productoVentaId)? $productoVentaId : "";?> "> <?php  echo isset($productoVentaIdNombre)? $productoVentaIdNombre : "selecionar";?> </option>

          <?php 
         foreach($listaProductos as $producto ):
//           if($producto->idproducto== $idVentaId)
//           {
// echo          " <option selected value=" 'isset($$producto->idproducto)? $$producto->idproducto : '''; > isset($productoVentaIdNombre)? $productoVentaIdNombre : "selecionar";?> </option>

//           }
         ?>
          <option value="<?php  echo $producto->idproducto?>"> <?php  echo $producto->nombre?> </option>

          <?php endforeach; ?>
          </select>
          
          </div>
          
          
          
           <div class="col-6" >
          <select name="idClienteV">

          <option selected value="<?php  echo isset($clienteVentaId)? $clienteVentaId : ""; ?>"> <?php  echo isset($clienteVentaIdNombre)? $clienteVentaIdNombre : "selecionar";?> </option>

          <?php 
          
         foreach($listaclientes as $cliente ): ?>


          <option value="<?php echo $cliente["idcliente"]?>"> <?php echo $cliente["nombrecliente"]?> </option>

          <?php endforeach; ?>
          </select>


          <br>    
         </div>
         </div>
         <br>   
    <div class="row">
              <div class="col-3" >
              <input type="submit" id = "btnEnviar" name="btnEnviar" value="Enviar"  class= " btn btn-primary"> 
              </div> 
              <div class="col-3" >
              <a href="ventas.php " class=" btn btn-secondary">Limpiar</a>
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
            <td class="col-1"> # </td>
            <td class="col-1"> ID VENTA </td>
            <td class="col-2"> IMPORTE </td>
            <td class="col-2"> FECHA DE VENTA </td>
            <td class="col-1"> ID CLIENTE </td>
            <td class="col-1"> ID PRODUCTO </td>
            <td class="col-2"> NOMBRE DEL CLIENTE </td>
            <td class="col-2"> NOMBRE DEL PRODUCTO </td>
    </tr>

    <?php    
    $index= 0;
      foreach($listaVentas as $venta):    
      $index +=1;
      ?>
        <tr>
        <td>
         <a  href="?idventa=<?php  echo$venta->idventa; ?> "> <?php  echo $index ?> </a>
        </td>
        <td>
         <a  href="?idventa=<?php  echo$venta->idventa; ?> "> <?php  echo $venta->idventa ?> </a>
        </td>
        <td>
             <?php  echo "$ ". $venta->importe  ?>
        </td>
        <td>
             <?php  echo $venta->fecha?>
        </td>
        <td>
             <?php  echo $venta->fk_idCliente ?>
        </td>
        <td>
             <?php  echo $venta->fk_idProducto;?>          
        </td>
        <td>
        <?php echo  $venta->fk_nombreCliente; ?>
        </td>
        <td>
        <?php echo  $venta->fk_nombreProducto; ?>
        </td>
        
         <?php endforeach; ?>
  

       

    
      </table>
      </div> 
       </div>
      </div> 

  

        
     
    
    </div>
</body>
</html>