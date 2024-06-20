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
    <title>Relatório Final</title>
</head>
<body>
    <form action="processar-relatorio-final.php" method="POST">

        <h1>Olá, <strong><?php echo $nome; ?></strong>!</h1> 
        <h2>Antes de emitirmos o seu relatório final, precisamos confirmar algumas informações</h2> 
        
        <h3>Os seus dados :</h3> 

        Seu nome : <strong><?php echo $nome; ?></strong> 
        Seu curso : <strong><?php echo $curso; ?></strong>
        Seu RA : <strong><?php echo $ra; ?></strong>
        
    
      <h3>Dados da empresa :</h3>

      Nome da empresa : <strong><?php echo $nome_empresa; ?></strong>

      <label for="nome_supervisor">Nome do Supervisor:</label>
        <input type="text" id="nome_supervisor" name="nome_supervisor" required>

        <label for="cargo_supervisor"> Cargo do Supervisor:</label>
        <input type="text" id="cargo_supervisor" name="cargo_supervisor" required>

        <label for="data_inicio"> Data de inicio:</label>
        <input type="text" id="data_inicio" name="data_inicio" required>

        <label for="data_termino"> Data de termino:</label>
        <input type="text" id="data_termino" name="data_termino" required>


        <button type="submit">Enviar</button>
    </form>
</body>
</html>
