<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Estágio</title>
</head>
<body>
    <form action="processar-atividade.php" method="POST">
        <label for="departamento">Departamento de Estágio:</label>
        <input type="text" id="departamento" name="departamento" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        
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

        

        <h2>Dados do representante da Empresa:</h2>
        
        <label for="contato-representante">Contato do representante: (fone ou email)</label>
        <input type="text" id="contato-representante" name="contato-representante" required>
        
        <h3>Dados do estágio</h3>
        <label for="obrigatoriedade">Classificação :</label>
        <select id="obrigatoriedade" name="obrigatoriedade" required>
            <option value="nao_obrigatorio">Não obrigatório</option>
            <option value="obrigatorio">Obrigatório</option>
        </select>
        
        <h3>Período real de execução: </h3>
        <h3>Data de Vigência do Estágio</h3>
        <label for="data_inicio">Data de início:</label>
        <input type="date" id="data_inicio" name="data_inicio" required>

        <label for="data_termino">Data de término:</label>
        <input type="date" id="data_termino" name="data_termino" required>

        <label for="atividade">Atividade:</label>
        <input type="text" id="atividade" name="atividade">

        <label for="descricao">Descrição da atividade:</label>
        <input type="text" id="descricao" name="descricao">

        <label for="resultado">Resultado ou objetivo esperado:</label>
        <input type="text" id="resultado" name="resultado">

        <label for="periodo">Período previsto (início e término):</label>
        <input type="date" id="periodo" name="periodo">

        <label for="data_definida">DECLARAÇÃO: plano definido em</label>
        <input type="date" id="data_definida" name="data_definida" required>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
