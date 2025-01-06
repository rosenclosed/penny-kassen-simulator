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

        // Get the ean and eanType parameters from the GET request
        if (isset($_GET['code']) && isset($_GET['codeType'])) {
            $ean = $_GET['code'];
            $eanType = $_GET['codeType'];
            
            // Determine the column based on the eanType
            $column = '';
            switch ($eanType) {
                case 'ean13':
                    $column = 'ean_13';
                    break;
                case 'ean8':
                    $column = 'ean_8';
                    break;
                case 'plu':
                    $column = 'plu';
                    break;
                case 'nan':
                    $column = 'nan';
                    break;
                default:
                    echo json_encode([
                        'success' => false,
                        'error' => 'Invalid eanType provided'
                    ]);
                    exit;
            }

            // Prepare the SQL query to search for the product by the selected column
            $stmt = $pdo->prepare("SELECT * FROM Products WHERE $column = :ean");
            $stmt->bindParam(':ean', $ean, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //Check if result is empty
            if (sizeof($result) != 0) {
                // Output the JSON response
            echo json_encode([
                'success' => true,
                'data' => $result
            ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'error' => 'No database Entry found'
                    ]);
            }

        } else {
            // If no ean or eanType is provided
            echo json_encode([
                'success' => false,
                'error' => 'No valid ean or eanType provided'
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