<?php 
    session_start();


    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT ID, USER_NAME FROM user WHERE ID = :id');
        $records->bindValue(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0){
           $user = $results; 
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog del programador</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <!-- Materialize
    Only with internet connection -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>
    <header>
        <span id="title">
            <h1>Blog del programador</h1>
        </span>

        <section class="buttons">
            <?php if (!empty($user)): ?>
                <button type="button"> <?= $user['USER_NAME'] ?></button>
                <button type="button" onclick="location.href='logout.php'"> Cerrar Sesion </button>
            <?php else: ?>
                <button type="button" onclick="location.href='signin.php'"><strong>Iniciar sesion</strong></button>
                <button type="button" onclick="location.href='signup.php'"><strong>Registrarse</strong></button>
            <?php endif; ?>
        </section>
        
        
            
        
        <hr>
    </header>

    <section class="searchBar">
    BARRA DE BUSQUEDA
            <button id="searchButton" type="submit">Buscar</button>
            <input type="text" id="searchInput" name="searchInput">
            <br>
    </section>
    <br><br>
    <section class="container">
        <div class="col s14">
            <div class="carousel center-align">
                <div class="carousel-item">
                    <h2 class="subtitulo">Project Name</h2>
                    <img src="img/coffee.png"  alt="coffee">
                </div>

                <div class="carousel-item">
                    <h2 class="subtitulo">Project Name</h2>
                    <img src="img/guitarra.png" alt="guitar">
                </div>

                <div class="carousel-item">
                    <h2 class="subtitulo">Project Name</h2>
                    <img src="img/fondo.jpg" alt="wallpaper">
                </div>

                <div class="carousel-item">
                    <h2 class="subtitulo">Project Name</h2>
                    <img src="img/monster.png" alt="monster">
                </div>

                <div class="carousel-item">
                    <h2 class="subtitulo">Project Name</h2>
                    <img src="img/backtotop.png" alt="upArrow">
                </div>
            </div>
        </div><br>
    </section>
    <br><br><br><br><br><br>
    <footer>
        <hr>
        
        <div id="backToTop">
            <a href="#title">Subir</a>
        </div>
        <div id="author">
            <label>Autor: Joaquin Vasquez</label>
        </div>
        <div id="contact">
            <a href="mailto:joacovas@hotmail.com">Contáctanos</a>
        </div>
        
        
        <p id="copyrigth">@Copyrigth 2021</p>
    </footer>

    <!-- Materialize js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="index.js"></script>
</body>
</html>