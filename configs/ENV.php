<?php

// global config
const BASE_URL = "http://localhost/assignment_ph57721_anld57721/";
const PATH_ROOT = __DIR__ . '/../';

// assets config
const ASSETS_UPLOAD_PATH = "assets/uploads/";

// views config
const PATH_VIEWS = PATH_ROOT . "views/";

const PATH_VIEWS_LAYOUT = PATH_ROOT . "views/Layout.php";

// controllers config
const PATH_CONTROLLERS = PATH_ROOT . "controllers/";

// models config
const PATH_MODELS = PATH_ROOT . "models/";

// routes config
const PATH_ROUTES = PATH_ROOT . "routes/";

// database config
const DB_HOST = 'localhost';
const DB_NAME = 'assignment_ph57721';
const DB_USER = 'root';
const DB_PASSWORD = '';

const DB_CHARSET = 'utf8';

const DB_OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];