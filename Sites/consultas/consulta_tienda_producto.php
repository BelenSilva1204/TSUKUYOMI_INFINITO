<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo= $_POST["tipo_producto_elegido"];
  #Se construye la consulta como un string
  if ($tipo == "comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, No_Comestibles AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }
  else
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, $tipo AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Rut jefe</th>
      <th>ID Direccion</th>
      <th>Nombre</th>
      <th>Cantidad de productos vendidos</th>

    </tr>
  
      <?php
        // echo $jefes;
        foreach ($tiendas as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>