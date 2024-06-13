<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encerramento de estágio</title>
</head>
<body>
    <h1>Bem-vindo</h1>
    <h3>Para cadastrar o encerramento do estágio, é necessário preencher o relatório final</h3>

    <p>Clique no botão abaixo para preencher o relatório</p>
    <a href="relatorio.php">Clique aqui</a>

    <h3>Upload do relatorio preenchido e assinado :</h3>

<form action="../upload-docs/upload-final.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
    </form>
    
</body>
</html>