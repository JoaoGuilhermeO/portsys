<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Morador - Condomínio Lagrimant's</title>
    <link rel="stylesheet" href="css/process.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Morador</h1>
        <form action="process_cad_morador.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="rg">RG:</label>
            <input type="text" id="rg" name="rg" required><br>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required><br>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required><br>

            <label for="casa">Número da Casa:</label>
            <input type="text" id="casa" name="casa" required><br>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required><br>

            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
