<?php 
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT ID, USER_NAME, AGE, COUNTRY, BDATE, USER_DESC, img FROM user WHERE ID = :id');
        $records->bindValue(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0){
           $user = $results; 
        }
        $img = $user['ID'];
    }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil </title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header>
        <a id="home" href="index.php"><img src="img/home.png" alt="home"></a>
        <span id="title">
            <h1>Blog del programador</h1>
        </span>
        
        <section id="logoutButton">
            <button type="button" onclick="location.href='logout.php'"> Cerrar Sesion </button>
        </section>
        <hr>
    </header>

    <section class="userInfo">
        <div class="profilePoto"><img style="width:170px; height:170px;" src="img/profile/<?=$user['img']?>" alt="user profile img"></div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" id="profImg">
            <button type="submit" name="refresh" >Actualizar</button>
        </form>
        <?php 
            if (isset($_POST['refresh'])) {
                $type = 'png';
                $imgPath = $_FILES['avatar']['tmp_name'];

                $name = $user['ID'].'.'.$type;
                if (is_uploaded_file($imgPath)) {
                    $route = 'img/profile/'.$name;
                    $nameA = $name;
                    copy($imgPath,$route);
                }else{
                    $nameA = $user['img'];
                }
                $id = $user['ID'];

                $values[0] = "'" . $nameA . "'";

                $sql = "UPDATE user SET img = ".implode(', ', $values) ." WHERE ID = ". $id;
                $stmt = $conn->prepare($sql);

                $stmt->execute();
            } 
        ?>
        <div class="userData">
            <article id="info">
                <p id='user_name'>Nombre de usuario: <?= $user['USER_NAME']?></p>
                <p id='age'>Edad: <?= $user['AGE']?></p>
                <p id='country'>Pais: <?= $user['COUNTRY']?></p>
                <p id='bdate'>Fecha de nacimiento: <?= $user['BDATE']?></p>
                <p id='desc'>Descripcion: <?= $user['USER_DESC']?></p>
            </article>
        </div>

        <div class="userPosts">

        </div>
    </section>

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
</body>
</html>