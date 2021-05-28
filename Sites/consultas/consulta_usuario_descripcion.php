<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $descripcion = $_POST["descripcion_producto"];
  #Se construye la consulta como un string
 	$query = "SELECT u.uid, u.rut, u.nombre, u.sexo, u.edad FROM Usuarios AS u, Productos AS p, Compras AS c WHERE u.rut = c.rut_user AND c.pid = p.pid AND p.descripcion LIKE '%$descripcion%' GROUP BY u.uid, u.rut, u.nombre, u.sexo, u.edad;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Edad</th>
      <th>Sexo</th>
    </tr>
  
      <?php
        // echo $jefes;
        foreach ($usuarios as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>