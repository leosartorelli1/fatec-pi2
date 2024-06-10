<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>InterHub - Login</title>
    <link rel="stylesheet" href="form-compromisso.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

<main>


    <h2>Preencha o termo de compromisso abaixo:</h2>

    <div class="container">
    <form id="termo" action="processar-atividade.php" method="post">

        <!-- Dados da empresa. -->
        <h2>Dados da Empresa:</h2>
        <label for="departamento">Departamento de Estágio:</label>
        <input type="text" id="departamento" name="departamento" required>

        <label for="telfone">Telefone:</label>
        <input type="text" id="telfone" name="telfone" required>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="site">Site:</label>
        <input type="text" id="site" name="site">

        <label for="cep">Cep:</label>
        <input type="text" id="cep" name="cep">

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado">



        <!-- Dados do representante da empresa. -->
        <h2>Dados do representante da Empresa:</h2>
        
        <label for="contato-representante">Contato do representante: (fone ou email)</label>
        <input type="text" id="contato-representante" name="contato-representante" required>
        
        

        <!-- Dados do estágio. -->
        <h3>Dados do estágio</h3>
        <label>Classificação :</label>
        <label>
        <input type="radio" name="obrigatoriedade" value="nao_obrigatorio">
        Não obrigatório
        </label>
        <br>
        <label>
        <input type="radio" name="obrigatoriedade" value="obrigatorio">
        Obrigatório
        </label>
        
        
        <!-- Horários do estágio. -->
        <h3>Período real de executação: </h3>
        <h3>Data de Vigência do Estágio</h3>
        <label for="data_inicio">Data de inicio:</label>
        <input type="date" id="data_inicio" name="data_inicio" required>

        <label for="data_termino">Data de termino:</label>
        <input type="date" id="data_termino" name="data_termino" required>

        <!-- plano de atividades -->
        <label for="atividade">Atividade:</label>
        <input type="text" id="atividade" name="atividade">

        <label for="descricao">Descrição da atividade:</label>
        <input type="text" id="descricao" name="descricao">

        <label for="descricao">Resultado ou objetivo esperado:</label>
        <input type="text" id="descricao" name="descricao">

        <label for="descricao">Periodo previsto (inicio e termino):</label>
        <input type="text" id="descricao" name="descricao">

        <!--Empresa-->
        <label for="data_denifida">DECLARAÇÃO: plano definido em</label>
        <input type="date" id="data_denifida" name="data_denifida" required>
        
  
       
        <!-- Envio. -->
        <button type="submit">Enviar</button>
    </form>
    </div>

 
</main>


</body>
</html>