<?php

require('database.php');

if (isset($_POST['registerButton'])) {

    if (!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['age']) && !empty($_POST['bdate']) && !empty($_POST['gender']) && !empty($_POST['country']) && !empty($_POST['comentario'])) {

        $matches = array('8');

        $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);

        $values[0] = "'" . $_POST['name'] . "'";
        $values[1] = "'" . $password . "'";
        $values[2] = $_POST['age'];
        $values[3] = "'" . $_POST['bdate'] . "'";
        $values[4] = "'" . $_POST['gender'] . "'";
        $values[5] = "'" . $_POST['country'] . "'";
        $values[6] = "'" . $_POST['comentario'] . "'";
        $values[7] = "'default.png'";

        $sql = "INSERT INTO user (USER_NAME, PASS, AGE, BDATE, GENDER, COUNTRY, USER_DESC, img) VALUES (" . implode(', ', $values) . ")";
        $stmt = $conn->prepare($sql);


        if ($stmt->execute()) {
            $message = "Registration succeed";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog del programador | Registro</title>
    <link rel="stylesheet" href="css/stylesignup.css">
</head>

<body>
    <header>
        <a id="home" href="index.php"><img src="img/home.png" alt="home"></a>
        <h1>Registrar usuario</h1>
        <p><a href="signin.php">or log in</a></p>
    </header>
    <!--  -->
    <form class="personalDetail" action="signup.php" method="POST">
        <label for="name"><strong>Nombre <span class="dot">*</span></strong></label>
        <br>
        <input type="text" name="name" id="name" placeholder="Nombre completo">
        <br>
        <br>

        <label for="pass"><strong>Contraseña <span class="dot">*</span></strong></label>
        <br>
        <input type="password" name="pass" id="pass">
        <br>
        <br>

        <label for="age"><strong>Edad <span class="dot"></span></strong></label>
        <br>
        <input type="number" name="age" id="age">
        <br>
        <br>

        <label for="bdate"><strong>Fecha de nacimiento</strong></label>
        <br>
        <input type="date" name="bdate" id="bdate">
        <br>
        <br>


        <label><strong>Sexo</strong></label><br>
        <section class="gender">
            <label>
                <input type="radio" name="gender" value="man"> Hombre
            </label>
            <br>
            <label>
                <input type="radio" name="gender" value="woman"> Mujer
            </label>
            <br>
            <label>
                <input type="radio" name="gender" value="other"> Otro
            </label>
            <br>
            <label>
                <input type="radio" name="gender" value="nn"> Prefiero no decirlo
            </label>
            <br><br>
        </section>

<!--         <label><strong>Foto de perfil</strong></label>
        <br>
        <input type="file" name="profileImg" id="profileImg">
        <br><br> -->

        <label><strong>Pais de nacimiento</strong></label><br>
        <select name="country" id="country">
            <option>Argentina</option>
            <option>Brasil</option>
            <option>Chile</option>
            <option>Uruguay</option>
            <option>Paraguay</option>
            <option>Peru</option>
            <option>Bolivia</option>
            <option>Colombia</option>
            <option>Venezuela</option>
            <option>Otro</option>
        </select>
        <br>
        <br>

        <label for="comentario"><strong>Descripcion</strong></label><br>
        <textarea name="comentario" id="comentario" cols="30" rows="10" placeholder="Ingrese una breve descripción"></textarea>
        <br>
        <br>

        <button type="submit" name="registerButton" id="boton">Cargar usuario</button>
        <button type="reset" class="resetButton" class="boton">Borrar</button>
        <br><br>
        <?php include('form-validation.php') ?>
    </form>

    <footer>
        <hr>
        <div id="backToTop">
            <a href="#home">Volver al inicio</a>
        </div>

        <div id="author">
            <label>Autor: Joaquin Vasquez</label>
        </div>

        <div id="contact">
            <a href="mailto:joacovas@hotmail.com">Contáctanos</a>
        </div>
        <p id="copyrigth">@Copyrigth 2021</p>
    </footer>
</body>

</html>