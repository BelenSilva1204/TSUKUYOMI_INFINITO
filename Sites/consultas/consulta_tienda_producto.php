<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo= $_POST["tipo_producto_elegido"];
  #Se construye la consulta como un string
  if ($tipo == "no_comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, No_Comestibles AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }
  if ($tipo == "congelado")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, Congelados AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }
  if ($tipo == "conserva")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, Conservas AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }
  if ($tipo == "fresco")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) as cant FROM Tiendas AS t, Compras AS c, Frescos AS nc WHERE t.tid = c.tid AND c.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre ORDER BY cant DESC LIMIT 3;";
  }
  if ($tipo == "comestible")
  {
    $query = "SELECT x.tid, x.rut_jefe, x.did, x.nombre, SUM(x.Ventas) FROM (SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) AS Ventas FROM Tiendas AS t, Compras AS c, Congelados AS cg WHERE t.tid = c.tid AND c.pid = cg.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre UNION ALL SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) AS Ventas FROM Tiendas AS t, Compras AS c, Conservas AS co WHERE t.tid = c.tid AND c.pid = co.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre UNION ALL SELECT t.tid, t.rut_jefe, t.did, t.nombre, SUM(c.cant) AS Ventas FROM Tiendas AS t, Compras AS c, Frescos AS f WHERE t.tid = c.tid AND c.pid = f.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre) AS x GROUP BY x.tid, x.rut_jefe, x.did, x.nombre ORDER BY SUM(x.Ventas) DESC LIMIT 3;";
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