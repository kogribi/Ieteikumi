<?php
require 'php/connect.php';


$sql = file_get_contents('migrations.sql');


$statements = array_filter(array_map('trim', explode(';', $sql)));


foreach ($statements as $statement) {
    if (!empty($statement)) {
        if ($conn->query($statement) === TRUE) {
            echo "Executed: " . substr($statement, 0, 50) . "...\n";
        } else {
            echo "Error executing: " . $conn->error . "\n";
        }
    }
}

echo "Migration completed.\n";
?>