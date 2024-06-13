<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Parcial</title>
</head>
<body>
    <h1>O relatório parcial</h1>

    <h3>O relatório parcial deve ser entregue a cada 6 meses. Para preencher o relatório parcial, clique no botão abaixo</h3>
    <a href="relatorio.php">Clique aqui</a>

    <h3>Upload do relatorio preenchido e assinado :</h3>

    <form   form action="../upload-docs/upload-parcial.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>