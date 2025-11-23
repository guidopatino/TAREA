<?php
include("conexion.php");
include("listado_usuarios.php");

//proceso de visualización de usuarios
$pagina = $_GET['pag'];
$correo = $_GET['correo'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$usunom = $mostrar['nom'];
	$usucorreo = $mostrar['correo'];
}
?>
<html>

<body>
	<div class="caja_popup2">
		<form class="contenedor_popup" method="POST">
			<table>
				<tr>
					<th colspan="2">Ver usuario</th>
				</tr>
				<tr>
					<td><b>Nombre:</b></td>
					<td><?php echo $usunom; ?></td>
				</tr>

				<tr>
					<td><b>Correo: </b></td>
					<td><?php echo $usucorreo; ?></td>
				</tr>
				<tr>

					<td colspan="2">
						<?php echo "<a class='BotonesUsuarios' href=\"listado_usuarios.php?pag=$pagina\">Regresar</a>"; ?>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>