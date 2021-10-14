<?php 
    if (isset($_POST['registerButton'])) {


        if(empty($_POST['name'])){
            echo "<p class='error'>* Complete your user name</p>";
        }else if(strlen($_POST['name']) > 25){
            echo "<p class='error'>* Your name is too large</p>";
        }
        if(empty($_POST['pass'])){
            echo "<p class='error'>* Complete your password</p>";
        }
    }
?>