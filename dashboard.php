<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Portaria</title>
</head>
<body>
<?php
    // Iniciar a sessão para acessar as informações do usuário autenticado
    session_start();
    // Verificar se o usuário está autenticado
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    // Obtém o ID do usuário autenticado da sessão
    $user_id = $_SESSION['user_id'];

    // Configurações do banco de dados
    require_once('config.php');
    try {
        // Conexão com o banco de dados usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Configuração para lançar exceções em caso de erros
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Consulta o banco de dados para obter informações do usuário autenticado
        $stmt = $pdo->prepare("SELECT * FROM porteiros WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar se o usuário existe no banco de dados
        if (!$userRow) {
            // Caso o usuário não seja encontrado, redirecionar para o login
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        // Trata erros de conexão ou consulta ao banco de dados
        die("Erro no banco de dados: " . $e->getMessage());
    }

    // Verificar o papel do usuário para exibir as opções corretas no dashboard
    if ($userRow['papel'] === "admin") {
        // Exibir as opções do administrador
        echo "Bem-vindo, Administrador " . $userRow['nome'] . "<br>";
        echo "Opções disponíveis para o Administrador:<br>";
        // Aqui você pode exibir os links para as páginas de gerenciamento do administrador
        echo "<a href='cad_morador.php'>Cadastrar Morador</a><br>";
        echo "<a href='cadVeiculo.php'>Cadastrar Veículo</a><br>";
        // Adicione mais opções do administrador conforme necessário
        
    } elseif ($userRow['papel'] === "porteiro") {
        // Exibir as opções do porteiro
        echo "<h1> Bem-vindo, Porteiro " . $userRow['nome'] . "</h1>";
        echo "<h2>Opções disponíveis para o Porteiro:</h2><br>";
        // Aqui você pode exibir os links para as páginas de gerenciamento do porteiro
        echo "<div class='botoes'>";
        echo "<a href='consultar_morador.php'><button>Consultar Morador</button></a><br>";
        echo "<a href='cadVisitante.php'><button>Cadastrar Visitante</button></a><br>";
        echo "</div>";
        // Adicione mais opções do porteiro conforme necessário

    } else {
        // Caso o papel do usuário não seja reconhecido, redirecionar para o login
        header("Location: index.php");
        exit();
    }
?>
</body>
</html>
