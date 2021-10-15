<?php
session_start();


require 'database.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT ID, USER_NAME, img FROM user WHERE ID = :id');
    $records->bindValue(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}

$query = $conn->prepare('SELECT COUNT(ID) from post');
$query->execute();
$postAmout = $query->fetch(PDO::FETCH_ASSOC);

$countID = $postAmout['COUNT(ID)'];

$mysql = "SELECT title, img FROM post";
$query = $conn->prepare('SELECT title, img FROM post');
$query->execute();
//$var = $query->fetch(PDO::FETCH_ASSOC);
//$post = $var;
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
            <?php if (!empty($user)) : ?>
                <a href="profile.php"><img class="userI" style="width:50px; height:50px" src="img/profile/<?= $user['img'] ?>" alt="profile user image"></a>
                <button type="button" onclick="location.href='profile.php'"> <?= $user['USER_NAME'] ?></button>
                <button type="button" onclick="location.href='logout.php'"> Cerrar Sesion </button>
            <?php else : ?>
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

                <?php
                $i = 0;
                while($i < $countID){
                    $result = $query->fetch(PDO::FETCH_OBJ);
                    /* echo " |key-> ".$key. " VALOR -> ".$value; */
                    $block1 = '<div class="carousel-item">';
                    $block2 = '<h2 class="subtitulo">' . $result->title . '</h2>';
                    $key = 'img';
                    $block3 = '<img src="img/post/' . $result->img . '"  alt="project">';
                    $block4 = '</div>';

                    $finalBlock = $block1 . $block2 . $block3 . $block4;
                    echo $finalBlock;
                    $i++;
                }
                ?>
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