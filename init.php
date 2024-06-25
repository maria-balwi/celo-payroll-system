<?php

    // INCLUDE THE CONFIGURATION FILE
    include 'config/config.php';

    // DEFINE CONSTANTS FOR DATABASE CONFIGURATION
    define('HOST', $host);
    define('USER', $username);
    define('PASSWORD', $password);
    define('DATABASE', $database);

    require 'backend/Database.php';
    require 'backend/Users.php';
    // require 'backend/Tickets.php';

    $database = new Database;
    $users = new Users;
    // $tickets = new Tickets;

?>