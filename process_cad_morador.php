<?php
require_once 'config.php';
session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Função para filtrar e validar os dados recebidos do formulário
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Receber e filtrar os dados do formulário
    $nome = test_input($_POST['nome']);
    $rg = test_input($_POST['rg']);
    $cpf = test_input($_POST['cpf']);
    $endereco = test_input($_POST['endereco']);
    $casa = test_input($_POST['casa']);
    $telefone = test_input($_POST['telefone']);

    try {
        // Verificar se o morador já existe no banco de dados pelo RG
        $stmt = $pdo->prepare("SELECT * FROM moradores WHERE rg = :rg");
        $stmt->bindParam(':rg', $rg);
        $stmt->execute();
        $morador = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($morador) {
            // Morador já existe no banco de dados, redirecionar com mensagem de erro
            header("Location: cad_morador.php?error=morador_existe");
            exit();
        }

        // Inserir os dados do novo morador no banco de dados
        $stmt = $pdo->prepare("INSERT INTO moradores (nome, rg, cpf, endereco, casa, telefone) VALUES (:nome, :rg, :cpf, :endereco, :casa, :telefone)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':casa', $casa);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();

        // Redirecionar com mensagem de sucesso
        header("Location: cad_morador.php?success=true");
        exit();
    } catch (PDOException $e) {
        // Tratar erros de conexão ou consulta ao banco de dados
        die("Erro no banco de dados: " . $e->getMessage());
    }
} else {
    // Caso a requisição não seja do tipo POST, redirecionar para a página de cadastro
    header("Location: cad_morador.php");
    exit();
}
?>
