<?php

namespace src\Models;

use PDO;
use PDOException;

class Database
{
    private $DB;
    private $config;
    private $pdo;


    public function __construct()
    {
        $this->config = __DIR__ . '/../../config.php';
        require_once $this->config;

        $this->connexionDB();

        $host = 'localhost';
        $dbname = 'gestion_apprenants';
        $user = 'gestion_apprenants';
        $password = 'Password123';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getDB()
    {
        return $this->DB;
    }

    private function connexionDB(): void
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->DB = new PDO($dsn, DB_USER, DB_PWD);
        } catch (PDOException $error) {
            echo "Quelque chose s'est mal passé : " . $error->getMessage();
        }
    }

    public function initializeDB(): string
    {

        if ($this->testIfTablePassExists()) {
            return "La base de données semble déjà remplie.";
            die();
        }
        try {
            $sql = file_get_contents(__DIR__ . "/../Migrations/gestion-apprenants.sql");

            $this->DB->query($sql);
            if ($this->MiseAJourConfig()) {
                return "installation de la Base de Données terminée !";
                die();
            }
        } catch (PDOException $erreur) {
            return "impossible de remplir la Base de données : " . $erreur->getMessage();
            die();
        }
    }

    private function testIfTablePassExists(): bool
    {
        $existant = $this->DB->query('SHOW TABLES FROM ' . DB_NAME . ' like \'asy_pass\'')->fetch();

        if ($existant !== false && $existant[0] == "asy_pass") {
            return true;
        } else {
            return false;
        }
    }

    private function MiseAJourConfig(): bool
    {

        $fconfig = fopen($this->config, 'w');

        $contenu = "<?php
    // lors de la mise en open source, remplacer les infos concernant la base de données.
    
    define('DB_HOST', '" . DB_HOST . "');
    define('DB_NAME', '" . DB_NAME . "');
    define('DB_USER', '" . DB_USER . "');
    define('DB_PWD', '" . DB_PWD . "');
    define('HOME_URL', '/');
    
    // Ne pas toucher :
    
    define('DB_INITIALIZED', TRUE);";


        if (fwrite($fconfig, $contenu)) {
            fclose($fconfig);
            return true;
        } else {
            fclose($fconfig);
            return false;
        }
    }
    public function getPDO()
    {
        return $this->pdo;
    }
}
