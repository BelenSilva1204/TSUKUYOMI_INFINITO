<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna = $_POST["comuna_elegida"];
  #Se construye la consulta como un string
 	$query = "SELECT p.nombre, p.rut, p.edad, p.sexo FROM Personal AS p, Tiendas AS t, Direcciones as d WHERE p.rut = t.rut_jefe AND t.did = d.did AND d.dir_comuna = '$comuna';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Edad</th>
      <th>Sexo</th>
    </tr>
  
      <?php
        // echo $jefes;
        foreach ($jefes as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
