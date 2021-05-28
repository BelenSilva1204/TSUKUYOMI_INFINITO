<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo= $_POST["tipo_producto_elegido"];
  #Se construye la consulta como un string
  if ($tipo == "no_comestibles")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, No_Comestibles AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "congelados")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Congelados AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "conservas")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Conservas AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "frescos")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Frescos AS nc WHERE p.tid = t.tid AND p.pid = nc.pid GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }
  if ($tipo == "comestibles")
  {
    $query = "SELECT t.tid, t.rut_jefe, t.did, t.nombre FROM Productos AS p, Tiendas AS t, Congelados AS cg, Conservas AS co, Frescos AS f  WHERE p.tid = t.tid AND (p.pid = cg.pid OR p.pid = co.pid OR p.pid = f.pid) GROUP BY t.tid, t.rut_jefe, t.did, t.nombre;";
  }

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre</th>
      <th>Rut jefe</th>
      <th>Direccion</th>
      <th>Comuna</th>

    </tr>
  
      <?php
        // echo $jefes;
        foreach ($tiendas as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>