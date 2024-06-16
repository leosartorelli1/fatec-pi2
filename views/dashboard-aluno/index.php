<?php
    require "../usuarios/usuario-verifica.php";
    
    include "../../classes/Conexao.php";

if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do aluno não encontrado. Faça login novamente.";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT id_aluno, nome FROM tb_alunos WHERE fk_id_usuario = :id_usuario"; 
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario); 
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);


if ($resultado) {
    $id_aluno = $resultado['id_aluno'];
    $nome = $resultado['nome'];
} else {
    echo "Nenhum dado encontrado para o ID fornecido.";
    exit();
}
    ?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="../form-compromisso/landpage.php">Cadastrar Estagio</a></li>
                    <li><a href="../acompanhamento/index.php">Acompanhar Estagio</a></li>
                    <li><a href="../relatorio-final/index.php">Encerrar Estágio</a></li>
                    <li><a href="../relatorio-parcial/index.php">Relatório Parcial</a></li>
                </ul>
            </nav>
        </div>

        <div>
            <a href="../usuarios/usuario-logout.php">Logout</a>
        </div>
    </header>

    <div class="cps-principal">
    <h2>Olá, <strong><?php echo $nome; ?></strong>! Bem Vindo a Plataforma InternHub!</h2>

        <span class="divisor"></span>

        <div class="descricao">
            <p>
            Esta plataforma foi desenvolvida com o propósito de oferecer suporte aos alunos que estão dando início ao processo de estágio. Aqui, os estudantes têm a oportunidade de enviar suas documentações de estágio de forma digitalizada, simplificando e agilizando todo o processo administrativo associado ao estágio. Além disso, a plataforma possibilita o acompanhamento do estágio, proporcionando uma experiência mais eficiente e transparente para os alunos, instituições de ensino e empresas envolvidas.
            </p>
        </div>
    </div>

    <div class="cps-principal">
    <h2>Estágio</h2>
        <span class="divisor"></span>

        <div class="estagio">
            <p>
                O estágio é um conjunto de atividades de aprendizagem de cunho profissional, social e cultural que são proporcionadas aos estudantes pela participação em situações reais de vida e de trabalho relacionados a sua área.
            </p>
            <p>
                O aluno deve ver no estágio a oportunidade de vivenciar o que aprendeu nas aulas e, como consequência, diferenciar-se na sua formação e garantir sua empregabilidade.
            </p>

            <p><a href="https://www.planalto.gov.br/ccivil_03/_ato2007-2010/2008/lei/l11788.htm" target="_blank" id="lei">Lei do Estágio</a></p>
        </div>
    </div>
    <div class="cps-principal">
        <h3>Horário de Atendimento:</h3>
    <table>
        <thead>
            <tr>
                <th>Professor</th>
                <th>Curso</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>WLADIMIR JOSÉ CAMILLO MENEGASSI</td>
                <td>Gestão Empresarial</td>
                <td>
                    QUARTAS-FEIRAS DAS 17H ÀS 19H<br>
                    QUINTAS-FEIRAS DAS 18H ÀS 19H<br>
                    SEXTAS-FEIRAS DAS 18H ÀS 19H<br>
                    SÁBADOS DAS 11h10 ÀS 13h10
                </td>
            </tr>
            <tr>
                <td>HERMAS AMARAL GERMEK</td>
                <td>Gestão da Tecnologia da Informação</td>
                <td>
                    TERÇAS E QUARTAS-FEIRAS DAS 15H00 ÀS 18H00
                </td>
            </tr>
            <tr>
                <td>LUCIENE RELA ARAKAKI FUINI</td>
                <td>Gestão da Produção Industrial</td>
                <td>
                    SEGUNDAS-FEIRAS DAS 18H50 ÀS 20H50<br>
                    QUARTAS-FEIRAS DAS 14H00 ÀS 18H00<br>
                    QUARTAS-FEIRAS DAS 19H00 ÀS 22H30<br>
                    QUINTAS-FEIRAS DAS 18H00 ÀS 20H00
                </td>
            </tr>
            <tr>
                <td>JOSÉ GONÇALVES PINTO JUNIOR</td>
                <td>Desenvolvimento de Software Multiplataforma</td>
                <td>
                    TERÇAS-FEIRAS DAS 16H00 ÀS 22H00
                </td>
            </tr>
        </tbody>
    </table>
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
                <a href="https://www.facebook.com/fatecitapira" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/fatecdeitapira/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send?phone=5519989336291" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.youtube.com/channel/UChyGJgx8OzKqhHJBDaKdOZA" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

    <footer id="rodape_final">
        <div id="logo_rodape"><img src="../../img/logo-sp.png"></div>
    </footer>
    
</body>
</html>