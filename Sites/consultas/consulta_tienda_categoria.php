<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo= $_POST["tipo_producto_elegido"];
  #Se construye la consulta como un string
  if ($tipo == "no_comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, No_Comestibles AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "congelado")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Congelados AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "conserva")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Conservas AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "fresco")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Frescos AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "comestible")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Congelados AS cg WHERE p.tid = t.tid AND p.pid = cg.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre UNION SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Conservas AS co WHERE p.tid = t.tid AND p.pid = co.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre UNION SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Frescos AS f WHERE p.tid = t.tid AND p.pid = f.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
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

    </tr>
  
      <?php
        // echo $jefes;
        foreach ($tiendas as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>