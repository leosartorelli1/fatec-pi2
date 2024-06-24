<?php 
    include "../../classes/Conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style-form.css">
    <title>Cadastro de estágio</title>
</head>
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
<h2>O primeiro passo para registrar seu estágio é preencher o termo de compromisso abaixo:</h2>

<span class="divisor"></span>
    <p>
    Um Termo de Compromisso de Estágio (TCE) é um documento formal que estabelece as condições, direitos, e responsabilidades do estagiário, da empresa concedente do estágio, e da instituição de ensino. Este documento é fundamental para regulamentar a relação de estágio, garantindo que todas as partes envolvidas estejam cientes de suas obrigações e benefícios.
    </p>
        <strong><p>
       Escolha qual modelo de estágio se aplica ao seu:
    </p></strong>
<a class="link" href="remunerado/form-remunerado.php">Estágio Remunerado</a>
/
<a class="link" href="nao-remunerado/form.php">Estágio Não Remunerado</a>


</div>



<div class="cps-principal">
<h2>Após preencher o termo, será necessário completar o plano de atividades a seguir:</h2>

<span class="divisor"></span>
<p>
Um Plano de Atividades para Estágio é um documento detalhado que especifica as tarefas e atividades que o estagiário realizará durante o período do estágio. Ele é desenvolvido conjuntamente pela empresa concedente do estágio e a instituição de ensino, e deve estar alinhado aos objetivos do curso do estagiário, garantindo que a experiência contribua para sua formação acadêmica e profissional.
</p>

<a href="../form-atividade/form-atividade.php" class="link">Plano de atividades</a>
</div>

<div class="cps-principal">
<h2>Após o preenchimento e assinatura dos formulários, basta enviar os arquivos:</h2>

<span class="divisor"></span>

<h3>Termo de compromisso:</h3>

<form action="../upload-docs/upload-termo.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
    </form>


<h3>Plano de atividades:</h3>

<form action="../upload-docs/upload-plano.php" method="post" enctype="multipart/form-data">
        <label for="file">Selecione um arquivo PDF:</label>
        <input type="file" name="file" id="file" accept="application/pdf" required>
        <input type="submit" name="submit" value="Upload">
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
                <a href="https://twitter.com/fitapira" target="_blank"><i class="fab fa-twitter"></i></a>
                <a  href="https://www.facebook.com/fatecitapira" target="_blank"><i class="fab fa-facebook"></i></a>
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