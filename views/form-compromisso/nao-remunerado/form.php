<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>InterHub - Login</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

<main>


    <h2>Preencha o termo de compromisso abaixo:</h2>

    <div class="container">
    <form id="termo" action="processar-formulario.php" method="post">

        <!-- Dados da empresa. -->
        <h2>Dados da Empresa:</h2>
        <label for="nome_empresa">Nome da Empresa:</label>
        <input type="text" id="nome_empresa" name="nome_empresa" required>

        <label for="cnpj">CNPJ da Empresa:</label>
        <input type="text" id="cnpj" name="cnpj" required>
        
        <label for="endereco_empresa">Endereço da Empresa:</label>
        <input type="text" id="endereco_empresa" name="endereco_empresa" required>


        <!-- Dados do representante da empresa. -->
        <h2>Dados do representante da Empresa:</h2>
        <label for="nome_representante">Nome do Representante:</label>
        <input type="text" id="nome_representante" name="nome_representante" required>

        <label for="cargo_representante">Cargo do Representante:</label>
        <input type="text" id="cargo_representante" name="cargo_representante" required>
        
        <label for="cpf_representante">CPF do Representante:</label>
        <input type="text" id="cpf_representante" name="cpf_representante" required>
        
        
        <!-- Dados do estágio. -->
        <!-- Horários do estágio. -->
        <h2>Dados do estágio</h2>
        <h3>Horários de trabalho: </h3>
        <label for="horario_inicio">Horário de inicio:</label>
        <input type="time" id="horario_inicio" name="horario_inicio" required>

        <label for="horario_termino">Horário de término:</label>
        <input type="time" id="horario_termino" name="horario_termino" required>

        <label for="inicio_intervalo">Horário de inicio do Intervalo:</label>
        <input type="time" id="inicio_intervalo" name="inicio_intervalo" required>

        <label for="termino_intervalo">Horário de término do Intervalo:</label>
        <input type="time" id="termino_intervalo" name="termino_intervalo" required>

        <label for="total_horas">Total de horas semanais:</label>
        <input type="text" id="total_horas" name="total_horas" required>

        
        <!-- Data de vigência do estágio. -->
        <h3>Data de Vigência do Estágio</h3>
        <label for="data_inicio">Data de inicio:</label>
        <input type="date" id="data_inicio" name="data_inicio" required>

        <label for="data_termino">Data de termino:</label>
        <input type="date" id="data_termino" name="data_termino" required>

         <!-- Apolice. -->
         <label for="apolice">Numero da Apolice do Seguro:</label>
        <input type="text" id="apolice" name="apolice" required>

        <label for="seguradora">Nome da Seguradora:</label>
        <input type="text" id="seguradora" name="seguradora" required>

        <button type="submit">Enviar</button>
        </form>
    </div>

</main>


</body>
</html>