<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo= $_POST["tipo_producto_elegido"];
  #Se construye la consulta como un string
  if ($tipo == "no_comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) FROM Tiendas AS t, Compras AS c, No_Comestibles AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre LIMIT 3;";
  }
  if ($tipo == "congelado")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) FROM Tiendas AS t, Compras AS c, Congelados AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre LIMIT 3;";
  }
  if ($tipo == "conserva")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) FROM Tiendas AS t, Compras AS c, Conservas AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre LIMIT 3;";
  }
  if ($tipo == "fresco")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) FROM Tiendas AS t, Compras AS c, Frescos AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre LIMIT 3;";
  }
  if ($tipo == "comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) FROM Tiendas AS t, Compras AS c, Congelados AS cg, Conservas AS co, Frescos AS f WHERE t.tid = c.tid AND (c.pid = cg.pid OR c.pid = co.pid OR c.pid = f.pid) GROUP BY t.tid, t.rut_jefe, t.did, t.nombre LIMIT 3;";
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