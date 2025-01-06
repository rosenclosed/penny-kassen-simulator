<?php
// index.php

/**
 * PHP Admin Frontend for POS Database
 */

// Load configuration and database connection
require_once 'config.php';
require_once 'functions.php';

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Header
include 'templates/header.php';

// Include the requested page
switch ($page) {
    case 'categories':
        include 'pages/categories.php';
        break;
    case 'products':
        include 'pages/products.php';
        break;
    case 'discounts':
        include 'pages/discounts.php';
        break;
    case 'employee_cards':
        include 'pages/employee_cards.php';
        break;
    case 'penny_app':
        include 'pages/penny_app.php';
        break;
    default:
        include 'pages/dashboard.php';
        break;
}

// Footer
include 'templates/footer.php';

?>