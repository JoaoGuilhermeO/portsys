<?php
// Configurações do banco de dados
$host = "localhost";
$dbname = "portsys";
$username = "root";
$password = "";

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configuração para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Trata erros de conexão
    die("Erro no banco de dados: " . $e->getMessage());
}
?>
