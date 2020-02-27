<?php

 include_once "config.php";
  include_once "entidades/producto.entidad.php";
  $id ="";
  if(isset ($_GET["idproducto"])&& $_GET["idproducto"] >= 0)
  {
  $id= $_GET["idproducto"];
 
    $objidproducto  = new producto();
    $productoXId = $objidproducto->obtenerId($id);
    $nombreProductoId = $productoXId->nombre;
    $cantidadProductoId =  $productoXId->cantidad ;
    $precioProductoId = $productoXId->precio;
    $descripProductoId = $productoXId->descripcion;
  
  }
 // preguntar si viene boton enviar
 if(isset($_POST))
 {
 
 
   
  
   $objproducto = new producto();
 
     if(isset($_POST["btnEnviar"]) )
     {
 
       //insertar en la base de datos
 
       //  llamar producto
       // llamo a la carga de formulario
       $objproducto ->cargadesdeformulario($_REQUEST);
       // llamo para insertar el producto
       $objproducto -> insertar();
     }
 
     else if(isset($_POST["btnAct"]) )
     {
       $objproducto ->cargadesdeformulario($_REQUEST);
 
       $objproducto -> actualizar();
 
     }
 
     else if(isset($_POST["btnBorrar"]) )
     {
       $objproducto ->cargadesdeformulario($_REQUEST);
 
       $objproducto -> borrar();
 
     }
     // LE PASO EL CONTENIDO DE LA BBDD A UNA VARIABLE PARA DESPUES MOSTRAR
 
   }
 
   $objproductoFueraPOST =new producto();
   $objlista = $objproductoFueraPOST ->listaPOO();



?>
<?php include("headerambventas.php"); ?>
    <div class="row">
    <div class="col-12">
    <br>
    <br>
    <h1>
    REGISTROS DE PRODUCTOS
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
             <label for="txtNameProducto" > NOMBRE DE PRODUCTO*:</label>     
            </div>
            <div class="col-6" >         
              <label for="numCan" > CANTIDAD*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >
                  
                  <input type="text" id="txtNameProducto" name="txtNameProducto" class="form-control   " value="<?php  echo isset($nombreProductoId)? $nombreProductoId : ""; ?>" required>    
                </div>
                <div class="col-6" >
                  <input type="number" id="numCan" name="numCan" class="form-control   " value="<?php  echo isset($cantidadProductoId)? $cantidadProductoId : ""; ?>" required>    
         </div>
         </div>
          <br>
          <div class="row">
            <div class="col-6" >
             <label for="numPrecio" > PRECIO*:</label>     
            </div>
            <div class="col-6" >         
              <label for="txtDesc" > DESCRIPCION*:</label>
            </div>
         </div>
          <div class="row">
          <div class="col-6" >
                  
                  <input type="number" id="numPrecio" name="numPrecio" class="form-control   " value="<?php  echo isset($precioProductoId)? $precioProductoId : ""; ?>" required>    
                </div>
                <div class="col-6" >
                  <input type="text" id="txtDesc" name="txtDesc" class="form-control   " value="<?php  echo isset($descripProductoId)? $descripProductoId : ""; ?>" required>
                  <br>    
         </div>
         </div>
    <div class="row">
              <div class="col-3" >
              <input type="submit" id = "btnEnviar" name="btnEnviar" value="Enviar"  class= " btn btn-primary"> 
              </div> 
              <div class="col-3" >
              <a href="productos.php " class=" btn btn-secondary">Limpiar</a>
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
            <td class="col-2"> PRODUCTO </td>
            <td class="col-2"> CANTIDAD </td>
            <td class="col-2"> PRECIO </td>
            <td class="col-2"> DESCRIPCION </td>
    </tr>
    <?php 
         foreach($objlista as $producto ):     ?>
    <tr>
    <td>
     <a  href="?idproducto=<?php  echo $producto->idproducto; ?> "> <?php  echo $producto->idproducto; ?> </a>
    </td>
    <td>
         <?php  echo $producto->nombre; ?>
    </td>
    <td>
         <?php  echo $producto->cantidad; ?>
    </td>
    <td>
         <?php  echo $producto->precio; ?>
    </td>
    <td>
        <?php  echo $producto->descripcion; ?>
    </td>
     <?php endforeach; ?>

       

    
      </table>
      </div> 
       </div>
      </div> 

  

        
     
    
    </div>
</body>
</html>