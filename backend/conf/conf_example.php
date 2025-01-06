<?php
// Prevent direct access
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('Direct access not allowed');
}

// Your configuration code here
return [
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'your_database_name',
    'DB_USER' => 'your_username',
    'DB_PASSWORD' => 'your_password',
];