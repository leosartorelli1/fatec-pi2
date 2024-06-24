<?php 
include "../../classes/Conexao.php";

session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do aluno não encontrado. Faça login novamente.";
    exit();
}

//Dados do aluno 
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT id_aluno, nome, ra, curso FROM tb_alunos WHERE fk_id_usuario = :id_usuario"; 
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario); 
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $id_aluno = $resultado['id_aluno'];
    $nome = $resultado['nome'];
    $ra = $resultado['ra'];
    $curso = $resultado['curso'];

} else {
    echo "Nenhum dado de aluno encontrado para o ID fornecido.";
    exit();
}

//Dados do estágio 
$sql_estagio = "SELECT fk_id_empresa FROM tb_estagios WHERE fk_id_aluno = :id_aluno"; 
$stmt_estagio = $conexao->prepare($sql_estagio);
$stmt_estagio->bindParam(':id_aluno', $id_aluno); 
$stmt_estagio->execute();
$resultado_estagio = $stmt_estagio->fetch(PDO::FETCH_ASSOC);

if ($resultado_estagio) {

    $fk_id_empresa = $resultado_estagio['fk_id_empresa'];

} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}

//Dados da empresa
$sql_empresa = "SELECT nome FROM tb_empresas WHERE id_empresa = :fk_id_empresa"; 
$stmt_empresa = $conexao->prepare($sql_empresa);
$stmt_empresa->bindParam(':fk_id_empresa', $fk_id_empresa); 
$stmt_empresa->execute();
$resultado_empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);

if ($resultado_empresa) {
    $nome_empresa = $resultado_empresa['nome'];
} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}
?> 

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style-final.css">
    <title>Relatório Final</title>
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
            
            <h2>Relatório Final</h2>

              <span class="divisor"></span>

    <form action="processar-relatorio-final.php" method="POST">

        <h2>Olá, <strong><?php echo $nome; ?></strong>!</h2> 
        <h2>Antes de emitirmos o seu relatório final, precisamos confirmar algumas informações</h2> 
        
        <div class="cps-principal-aluno">
        <h3>Seus dados :</h3> 
        
        <div>Seu nome : <strong><?php echo $nome; ?></strong> </div>
        <div>Seu curso : <strong><?php echo $curso; ?></strong></div>
        <div>Seu RA : <strong><?php echo $ra; ?></strong></div>
        </div>
    
        <div class="cps-principal-empresa">
      <h3>Dados da empresa :</h3>

      Nome da empresa : <strong><?php echo $nome_empresa; ?></strong>

      <div><label for="nome_supervisor">Nome do Supervisor:</label>
        <input type="text" id="nome_supervisor" name="nome_supervisor" required></div>

        <div><label for="cargo_supervisor"> Cargo do Supervisor:</label>
        <input type="text" id="cargo_supervisor" name="cargo_supervisor" required></div>

       <label for="data_inicio"> Data de inicio:</label>
        <input type="text" id="data_inicio" name="data_inicio" required>

        <label for="data_termino"> Data de término:</label>
        <input type="text" id="data_termino" name="data_termino" required>
        </div>

        <div class="button"><button type="submit">Enviar</button></div>
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

