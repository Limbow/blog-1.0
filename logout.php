<?php 
    session_start();

    session_unset();

    session_destroy();

    header('Location: /blog%20BETA');

?>