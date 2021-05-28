<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Mi Tienda Web </h1>
  <p style="text-align:center;">Aquí podrás encontrar toda la información relacionada con las tiendas.</p>

  <br>

  <h3 align="center"> Comunas a las cuales las tiendas hacen despachos:</h3>

  <form align="center" action="consultas/consulta_tienda_comunas.php" method="post">
    <br/><br/>
    <input type="submit" value="Mostrar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar todos los jefes de tiendas ubicadas en una comuna?</h3>

  <form align="center" action="consultas/consulta_jefe_comuna.php" method="post">
    Comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres buscar todas las tiendas que venden al menos un producto de dicha categoria?</h3>

  <form align="center" action="consultas/consulta_tienda_categoria.php" method="post">
    Tipo de producto:
    <select id="tipo_producto_elegido" name="tipo_producto_elegido">    
    <option value="comestible">Comestible</option>}  
    <option value="no_comestible">No comestible</option>  
    <option value="congelado">Congelado</option>  
    <option value="conserva">Conserva</option>  
    <option value="fresco">Fresco</option>  
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">¿Quieres encontrar todos los usuarios que compraron un producto con dicha descripción?</h3>

  <form align="center" action="consultas/consulta_usuario_descripcion.php" method="post">
    Descripción del producto:
    <input type="text" name="descripcion_producto">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">¿Quieres saber la edad promedio de los trabajadores de tienda en una comuna?</h3>

<form align="center" action="consultas/consulta_edad_tiendas.php" method="post">
  Comuna:
  <input type="text" name="comuna_elegida">
  <br/><br/>
  <input type="submit" value="Buscar">
</form>
<br>
<br>
<br>

<h3 align="center">¿Quieres encontrar todas las tiendas que han registrado la venta de la mayor cantidad de productos del tipo seleccionado?</h3>

<form align="center" action="consultas/consulta_tienda_producto.php" method="post">
  Tipo de producto:
  <select>  
  <option value="comestible">Comestible</option>}  
  <option value="no_comestible">No comestible</option>  
  <option value="congelado">Congelado</option>  
  <option value="conserva">Conserva</option>  
  <option value="fresco">Fresco</option>  
  </select>
  <br/><br/>
  <input type="submit" value="Buscar">
</form>
<br>
<br>
<br>

</body>
</html>
