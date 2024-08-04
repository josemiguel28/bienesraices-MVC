<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'config/database.php';
require 'funciones.php';

//conectar a la db
$db = conectarDB();



ActiveRecord::setDB($db);
