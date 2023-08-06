<?php
session_start();
session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
require_once "config.php";

// Obtém as credenciais enviadas pelo formulário de login
$user = $_POST['username'];
$pass = $_POST['password'];

try {
    // Consulta o banco de dados para verificar o usuário e senha
    $stmt = $pdo->prepare("SELECT * FROM porteiros WHERE usuario = :user");
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe no banco de dados e se a senha está correta
    if ($userRow && password_verify($pass, $userRow['senha'])) {
        // Login bem-sucedido, redireciona para o dashboard.php
        session_start();
        $_SESSION['user_id'] = $userRow['id'];
        $_SESSION['user_role'] = $userRow['papel']; // Armazena o papel do usuário na sessão
        header("Location: dashboard.php");
        exit();
    } else {
        // Credenciais inválidas, redireciona para index.php com mensagem de erro
        header("Location: index.php?error=1");
        exit();
    }
} catch (PDOException $e) {
    // Trata erros de conexão ou consulta ao banco de dados
    die("Erro no banco de dados: " . $e->getMessage());
}
?>
