<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Visitante</title>
    <link rel="stylesheet" href="css/cadVisitante.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Visitante</h1>
        <form action="processa_cadVisitante.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>
            
            <label for="rg">RG:</label>
            <input type="text" id="rg" name="rg" required><br><br>
            
            <label for="obs">Observação:</label>
            <textarea id="obs" name="obs" rows="4" cols="50"></textarea><br><br>
            
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
