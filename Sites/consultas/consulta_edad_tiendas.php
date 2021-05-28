<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna = $_POST["comuna_elegida"];
  #Se construye la consulta como un string
 	$query = "SELECT d.dir_comuna, AVG(p.edad) FROM Personal AS p, Direcciones AS d, Trabaja_en AS te, Tiendas as t WHERE te.rut = p.rut AND te.tid = d.did AND LOWER(d.dir_comuna) = LOWER('$comuna') GROUP BY d.dir_comuna;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$edad = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Comuna</th>
      <th>Edad promedio</th>
    </tr>
  
      <?php
        // echo $jefes;
        foreach ($edad as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>