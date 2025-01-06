<?php

$dbConfig = require './conf/conf.php';  // Make sure the path is correct

function queryDb($config)
{
    try {
        // Get database credentials from the config array
        $host = $config['DB_HOST'];
        $dbName = $config['DB_NAME'];
        $username = $config['DB_USER'];
        $password = $config['DB_PASSWORD'];

        // Set the content type to JSON
        header('Content-Type: application/json');

        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check for EAN13, EAN8, PLU, or NAN in the GET parameters
        $column = '';
        $value = '';

        if (isset($_GET['ean13'])) {
            $column = 'ean_13';
            $value = $_GET['ean13'];
        } elseif (isset($_GET['ean8'])) {
            $column = 'ean_8';
            $value = $_GET['ean8'];
        } elseif (isset($_GET['plu'])) {
            $column = 'plu';
            $value = $_GET['plu'];
        } elseif (isset($_GET['nan'])) {
            $column = 'nan';
            $value = $_GET['nan'];
        }

        if ($column && $value) {
            // Prepare the SQL query to search for the product by the selected column
            $stmt = $pdo->prepare("SELECT * FROM Products WHERE $column = :value");
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Output the JSON response
            echo json_encode([
                'success' => true,
                'data' => $result
            ]);
        } else {
            // If no valid code parameter is provided
            echo json_encode([
                'success' => false,
                'error' => 'No valid product code provided'
            ]);
        }
    } catch (PDOException $e) {
        // Handle database errors
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Database error: ' . $e->getMessage()
        ]);
    }
}

queryDb($dbConfig);
?>