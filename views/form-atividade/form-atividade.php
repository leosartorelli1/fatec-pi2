<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Estágio</title>
</head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style-atividade.css">
<body>
<header>
        <div>
            <img src="../../img/fatec-logo.svg" width="150" height="60">
            <img src="../../img/cps-logo.svg" width="150" height="60">
        </div>

        <div>
            <nav>
                <ul>
                    <li><a href="../dashboard-aluno/index.php">Home</a></li>
                    <li><a href="../form-compromisso/landpage.php">Cadastrar Estágio</a></li>
                    <li><a href="../acompanhamento/index.php">Acompanhar Estágio</a></li>
                    <li><a href="../relatorio-final/index.php">Encerrar Estágio</a></li>
                    <li><a href="../relatorio-parcial/index.php">Relatório Parcial</a></li>
                </ul>
            </nav>
        </div>

        <div class="logout">
          <a href="../usuarios/usuario-logout.php"> <img src="../../img/logout.svg" title="Sair da página"></a>
        </div>
    </header>

        <div class="cps-principal">

        <h2>Plano de Atividades</h2>

        <span class="divisor"></span>

    <form action="processar-atividade.php" method="POST">

        <div class="cps-principal-empresa">
        <h2>Dados da empresa</h2>
        <label for="departamento">Departamento de Estágio:</label>
        <input type="text" id="departamento" name="departamento" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        
        <div><label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="site">Site:</label>
        <input type="text" id="site" name="site">

        <label for="cep">Cep:</label>
        <input type="text" id="cep" name="cep"></div>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado">
        </div>

        <div class="cps-principal-empresa">
        <h3>Dados do representante da Empresa:</h3>
        
        <label for="contato-representante">Contato do representante: (fone ou email)</label>
        <input type="text" id="contato-representante" name="contato-representante" required></div>
        
        <div class="cps-principal-empresa">
        <h3>Dados do estágio</h3>
        <label for="obrigatoriedade">Classificação :</label>
        <select id="obrigatoriedade" name="obrigatoriedade" required>
            <option value="nao_obrigatorio">Não obrigatório</option>
            <option value="obrigatorio">Obrigatório</option>
        </select>

        <h3>Data de Vigência do Estágio</h3>
        <label for="data_inicio">Data de início:</label>
        <input type="date" id="data_inicio" name="data_inicio" required>

        <label for="data_termino">Data de término:</label>
        <input type="date" id="data_termino" name="data_termino" required></div>

        <div class="cps-principal-empresa">
        <h3>Tabela de atividades</h3>
        
        <table>
            <tr>
                <td><label for="atividade">Atividade:</label></td>
                <td><input type="textarea" id="atividade" class="text-area" name="atividade"></td>
            </tr>
            <tr>
                <td><label for="descricao">Descrição da atividade:</label></td>
                <td><input type="textarea" id="descricao" class="text-area" name="descricao"></td>
            </tr>
            <tr>
                <td><label for="resultado">Resultado ou objetivo esperado:</label></td>
                <td><input type="textarea" id="resultado" class="text-area" name="resultado"></td>
            </tr>
        </table>
    

        <label for="periodo">Período previsto (início):</label>
        <input type="date" id="periodo" name="periodo"></div>

        <label for="periodo_termino">Período previsto (término):</label>
        <input type="date" id="periodo_termino" name="periodo_termino"></div>

        <div class="cps-principal-empresa">

        <div><label for="data_definida">DECLARAÇÃO:</div>plano definido em</label>
        <input type="date" id="data_definida" name="data_definida" required>
        </div>

        <div class="button"><button type="submit" >Enviar</button></div>
    </form>
    </div>
   
    
    
    
    <div id="info_fatec">
    <div id="cps-rodape__redes-e-infos">
        <div id="infos">
            <h6>Fatec Ogari de Castro Pacheco</h6>
            <p>Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista - CEP: 13974-080</p>
            <h6>Telefone</h6>
            <p>(19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <h6>Horário de Funcionamento</h6>
            <p>Seg. a Sex. 7h - 23h, Sáb 7h - 13h</p>
        </div>
        <div id="redes_fatec">
            <h6>Redes</h6>
            <div id="redes-icones" class="icones">
                <a class="link" href="https://twitter.com/fitapira" target="_blank"><i class="fab fa-twitter"></i></a>
                <a class="link" href="https://www.facebook.com/fatecitapira" target="_blank"><i class="fab fa-facebook"></i></a>
                <a  href="https://www.instagram.com/fatecdeitapira/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a  href="https://api.whatsapp.com/send?phone=5519989336291" target="_blank"><i class="fab fa-whatsapp"></i><a href="https://www.youtube.com/channel/UChyGJgx8OzKqhHJBDaKdOZA" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

    <footer id="rodape_final">
        <div id="logo_rodape"><img src="../../img/logo-sp.png"></div>
    </footer>
    
</body>
</html>



</body>
</html>
