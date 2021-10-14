<?php 

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /php-login');
    }

    require 'database.php';



    if (!empty($_POST['user']) && !empty($_POST['pass'])) {
        $records = $conn->prepare('SELECT ID, USER_NAME, PASS FROM user WHERE user_name LIKE :user_name');
        $records->bindValue(':user_name', $_POST['user']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);


        $message = "";
        
        if (count($results) > 0 && password_verify($_POST['pass'], $results['PASS']) ) {
            $_SESSION['user_id'] = $results['ID'];
            header('Location: /blog%20BETA');
        }else {
            $message = "Sorry, user name or password are incorrect";
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog del programador | Log-in</title>
    <link rel="stylesheet" href="css/stylesingin.css">

</head>
<body>
    <header>
        <a id="home" href="index.php"><img src="img/home.png" alt="home"></a>
        <h1>Iniciar sesión</h1>
        <p><a href="signup.php">or sign up</a></p>
    </header>
    <div id="result">

    </div>

    <?php if(!empty($message)):?>
        <p align="center"><?= $message ?></p>
    <?php endif; ?>
    
    <section class="login">
        <form class="data" action="signin.php" method="POST">
            <label for="user">
                <strong>Nombre de usuario </strong>
                <input type="text" name="user" id="loginUser">
            </label>
            <br><br><br>
            <label for="pass">
                <strong>Contraseña </strong>
                <input type="password" name="pass" id="loginPass">
            </label><br>
            <button id="buttonLogin" type="submit"><strong>Log in</strong></button>
        </form>
    </section>
    
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