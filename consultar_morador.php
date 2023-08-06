<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Moradores - Condomínio Lagrimant's</title>
    <link rel="stylesheet" href="css/conmora.css">
</head>
<body>
    <div class="container">
        <h1>Consultar Moradores</h1>
        <form action="consultar_morador.php" method="get">
            <label for="search">Pesquisar:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Buscar">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Número da Casa</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Configurações do banco de dados
                require_once('config.php');
                session_start();
                if (!isset($_SESSION['user_id'])) {
                    header("Location: index.php");
                    exit();
                }

                // Filtrar e validar o valor de pesquisa
                $search = isset($_GET['search']) ? test_input($_GET['search']) : '';

                try {
                    // Consulta o banco de dados para obter a lista de moradores com base na pesquisa
                    $stmt = $pdo->prepare("SELECT * FROM moradores WHERE 
                        nome LIKE :search OR 
                        rg LIKE :search OR 
                        cpf LIKE :search OR 
                        endereco LIKE :search OR 
                        casa LIKE :search OR 
                        telefone LIKE :search");
                    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
                    $stmt->execute();
                    $moradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Exibe os moradores na tabela
                    foreach ($moradores as $morador) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($morador['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($morador['rg']) . "</td>";
                        echo "<td>" . htmlspecialchars($morador['cpf']) . "</td>";
                        echo "<td>" . htmlspecialchars($morador['endereco']) . "</td>";
                        echo "<td>" . htmlspecialchars($morador['casa']) . "</td>";
                        echo "<td>" . htmlspecialchars($morador['telefone']) . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    // Trata erros de conexão ou consulta ao banco de dados
                    die("Erro no banco de dados: " . $e->getMessage());
                }

                // Função para filtrar e validar dados
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
