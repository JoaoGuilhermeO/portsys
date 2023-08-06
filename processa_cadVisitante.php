<?php
// Configurações do banco de dados
require_once 'config.php';
session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $obs = $_POST['obs'];

    try {
        // Prepara a declaração SQL com placeholders
        $stmt = $pdo->prepare("INSERT INTO visitantes (nome, rg, obs) VALUES (:nome, :rg, :obs)");

        // Vincula os parâmetros com os valores do formulário
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':obs', $obs);

        // Executa a declaração preparada para inserir os dados no banco de dados
        $stmt->execute();

        // Redireciona para a página de sucesso após o cadastro
        header("Location: successVist.php");
        exit();
    } catch (PDOException $e) {
        // Trata erros de conexão ou consulta ao banco de dados
        die("Erro no banco de dados: " . $e->getMessage());
    }
}
?>
