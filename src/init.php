<?php

require_once __DIR__ . '/../src/autoload.php';

session_start();

require_once __DIR__ . "/../config.php";

if (DB_INITIALIZED == FALSE) {
    $db = new src\Models\Database;

    $db->initializeDB();
}
