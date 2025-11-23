<?php
session_start();
include('conexion.php');
if (isset($_SESSION['usuarioingresando'])) {
  header('location: principal.php');
}
?>

<html>

<head>
  <title>SPORT UTPL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>

<style>
  .captcha {
    width: 50%;
    text-align: center;
    background-color: green;
    font-size: 24px;
    font-weight: 700;
    padding: 10px;
    border-radius: 5px;
    /*padding-right: 130px;*/
    margin: 10px;
  }

  .captcha-code {
    width: 50%;
    padding: 10px;
    font-size: 1em;
    border-radius: 5px;
    border: 1px solid black;
    color: black;
  }
</style>

<!-- proceso del CAPTCHA -->
<?php
$rand = rand(9999, 1000);
if (isset($_REQUEST['btningresar'])) {
  $txtcorreo = $_REQUEST['txtcorreo'];
  $txtpassword = md5($_REQUEST['txtpassword']);
  $captcha = $_REQUEST['captcha'];
  $capcharandom = $_REQUEST['captcha-rand'];
  if ($captcha != $capcharandom) {
    ?>
    <script type="text/javascript">
      alert("Inválido captcha value");
    </script>
    <?php
  } else {
    $select_query = mysqli_query($conn, "select * from usuarios where correo='$txtcorreo' and pass='$txtpassword' ");
    $result = mysqli_num_rows($select_query);
    if ($result > 0) {
      ?>
      <script type="text/javascript">
        alert("Login success");
      </script>
      <?php
    } else {
      ?>
      <script type="text/javascript">
        alert("Inválido correo o password");
      </script>
      <?php
    }
  }
}

?>

<body>

  <div class="FormCajaLogin">

    <div class="FormLogin">
      <form method="POST">
        <h1>Login</h1>
        <br>

        <div class="TextoCajas">Correo</div>
        <input type="text" name="txtcorreo" class="CajaTexto" required>

        <div class="TextoCajas">Password</div>
        <input type="password" id="txtpassword" name="txtpassword" class="CajaTexto" required>

        <div class="CheckBox1">
          <input type="checkbox" onclick="verpassword()">Mostrar password
        </div>

        <div class="TextoCajas">Captcha Code
          <input type="text" id="captcha" name="captcha" placeholder="Enter Captcha" required
            data-parsley-trigger="keyup" class="captcha-code">
          <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">
        </div>


        <div class="TextoCajas">Captcha Code

          <div class="captcha"><?php echo $rand; ?></div>
        </div>

        <div>
          <input type="submit" value="Iniciar sesión" class="BtnLogin" name="btningresar">
        </div>
        <hr>
        <br>

        <div>
          <a href="registrar_usuarios.php" class="BtnRegistrar">Crea nueva cuenta</a>
        </div>

    </div>
    </form>
  </div>

</body>
<script>

//ver contraseña
  function verpassword() {
    var tipo = document.getElementById("txtpassword");
    if (tipo.type == "password") {
      tipo.type = "text";
    }
    else {
      tipo.type = "password";
    }
  }
</script>

</html>

<!-- proceso del login-->
<?php

if (isset($_POST['btningresar'])) {
  $correo = $_POST["txtcorreo"];
  $pass = $_POST["txtpassword"];

  $buscandousu = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '" . $correo . "' and pass = '" . $pass . "'");
  $nr = mysqli_num_rows($buscandousu);

  if ($nr == 1) {
    $_SESSION['usuarioingresando'] = $correo;
    header("Location: principal.php");
  } else if ($nr == 0) {
    echo "<script> alert('Usuario no existe');window.location= 'index.php' </script>";
  }
}


?>