<?php
/**
 * Database logic
 */

/**
 * Creates and returns a PDO connection to the AGH MySQL database.
 *
 * @return PDO
 * @throws RuntimeException if connection fails
 */
function get_pdo() {
    try{
        require_once(__DIR__ . '/db_config.php');
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e){
        throw new RuntimeException("DB connection failed: " . $e->getMessage());
    }
}
?>