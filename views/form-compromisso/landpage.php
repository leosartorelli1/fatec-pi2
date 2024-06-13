<?php 
    include "../../classes/Conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de estágio</title>
</head>
<body>

<h1>Olá, bem-vindo!</h1>

<h2>O primeiro passo para cadastraro seu estágio é realizar o preenchimento do termo de compromisso abaixo :</h2>

<a href="remunerado/form-remunerado.php">Estágio Remunerado</a>
<a href="nao-remunerado/form.php">Estágio Não Remunerado</a>

<h2>Após preencher o termo, é necessário preencher o plano de atividades abaixo :</h2>

<a href="../form-atividade/form-atividade.php">Plano de atividades</a>

<h2>Após o preenchimento dos formulários e assinar, basta enviar os arquivos</h2>

<h3>Termo de compromisso :</h3>

<form action="../upload-docs/upload-termo.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
    </form>


<h3>Plano de atividades :</h3>

<form action="../upload-docs/upload-plano.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
    </form>






    
</body>
</html>