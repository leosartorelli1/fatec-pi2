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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style-Nremunerado.css">
</head>
<body>
<header>
        <div>
            <img src="../../../img/fatec-logo.svg" width="150" height="60">
            <img src="../../../img/cps-logo.svg" width="150" height="60">
        </div>

        <div>
            <nav>
                <ul>
                    <li><a href="../../dashboard-aluno/index.php">Home</a></li>
                    <li><a href="../../form-compromisso/landpage.php">Cadastrar Estágio</a></li>
                    <li><a href="../../acompanhamento/index.php">Acompanhar Estágio</a></li>
                    <li><a href="../../relatorio-final/index.php">Encerrar Estágio</a></li>
                    <li><a href="../../relatorio-parcial/index.php">Relatório Parcial</a></li>
                </ul>
            </nav>
        </div>

        <div class="logout">
          <a href="../usuarios/usuario-logout.php"> <img src="../../../img/logout.svg" title="Sair da página"></a>
        </div>
    </header>

    <div class="cps-principal">

    <h2>Termo de compromisso (Não remunerado):</h2>

    <span class="divisor"></span>

    <form id="termo" action="processar-formulario.php" method="post">

        <!-- Dados da empresa. -->
         <div class="cps-principal-empresa">
        <h2>Dados da Empresa:</h2>
        <label for="nome_empresa">Nome da Empresa:</label>
        <input type="text" id="nome_empresa" name="nome_empresa" required>

        <label for="cnpj">CNPJ da Empresa:</label>
        <input type="text" id="cnpj" name="cnpj" required>
        
        <div><label for="endereco_empresa">Endereço da Empresa:</label>
        <input type="text" id="endereco_empresa" name="endereco_empresa" required></div>
        </div>

        <!-- Dados do representante da empresa. -->
        <div class="cps-principal-empresa">
        <h2>Dados do representante da Empresa:</h2>
        <label for="nome_representante">Nome do Representante:</label>
        <input type="text" id="nome_representante" name="nome_representante" required>

        <label for="cargo_representante">Cargo do Representante:</label>
        <input type="text" id="cargo_representante" name="cargo_representante" required>
        
        <div><label for="cpf_representante">CPF do Representante:</label>
        <input type="text" id="cpf_representante" name="cpf_representante" required></div>
        </div>
        
        <!-- Dados do estágio. -->
        <!-- Horários do estágio. -->
        <div class="cps-principal-empresa">
        <h2>Dados do estágio</h2>
        <h3>Horários de trabalho: </h3>
        <label for="horario_inicio">Horário de inicio:</label>
        <input type="time" id="horario_inicio" name="horario_inicio" required>

        <label for="horario_termino">Horário de término:</label>
        <input type="time" id="horario_termino" name="horario_termino" required>

        <div><label for="inicio_intervalo">Horário de inicio do Intervalo:</label>
        <input type="time" id="inicio_intervalo" name="inicio_intervalo" required>

        <label for="termino_intervalo">Horário de término do Intervalo:</label>
        <input type="time" id="termino_intervalo" name="termino_intervalo" required>
        </div>

        <label for="total_horas">Total de horas semanais:</label>
        <input type="text" id="total_horas" name="total_horas" required>
        </div>
        
        <!-- Data de vigência do estágio. -->
        <div class="cps-principal-empresa">
        <h3>Data de Vigência do Estágio</h3>
        <div><label for="data_inicio">Data de inicio:</label>
        <input type="date" id="data_inicio" name="data_inicio" required>

        <label for="data_termino">Data de termino:</label>
        <input type="date" id="data_termino" name="data_termino" required></div>

         <!-- Apolice. -->
         <label for="apolice">Numero da Apolice do Seguro:</label>
        <input type="text" id="apolice" name="apolice" required>

        <label for="seguradora">Nome da Seguradora:</label>
        <input type="text" id="seguradora" name="seguradora" required></div>

        
        </form>
        </div>

        <div class="button"><button type="submit">Enviar</button></div>

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
        <div id="logo_rodape"><img src="../../../img/logo-sp.png"></div>
    </footer>
    
</body>
</html>



</body>
</html>