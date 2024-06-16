<?php
require "../usuarios/usuario-verifica.php";
include "../../classes/Conexao.php";

if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do usuário não encontrado. Faça login novamente.";
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['tipo']) || !isset($_GET['motivo'])) {
    echo "Erro: Parâmetros inválidos.";
    exit();
}

$id_aluno = $_GET['id'];
$tipo = $_GET['tipo'];
$motivo = $_GET['motivo'];

try {
    $conexao->beginTransaction();
    
    // Determina qual tabela e coluna atualizar com base no tipo de documento
    switch ($tipo) {
        case 'compromisso':
            $sql = "UPDATE tb_compromisso SET status = 'reprovado', motivo_reprovacao = :motivo WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'atividades':
            $sql = "UPDATE tb_atividades SET status = 'reprovado', motivo_reprovacao = :motivo WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'parcial':
            $sql = "UPDATE tb_relatorio_parcial SET status = 'reprovado', motivo_reprovacao = :motivo WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'final':
            $sql = "UPDATE tb_relatorio_final SET status = 'reprovado', motivo_reprovacao = :motivo WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        default:
            echo "Erro: Tipo de documento inválido.";
            exit();
    }

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_aluno', $id_aluno);
    $stmt->bindParam(':motivo', $motivo);
    $stmt->execute();

    $conexao->commit();
    echo "Documento reprovado com sucesso.";
    header("Location: index-professor.php");
    exit();

} catch (PDOException $e) {
    $conexao->rollBack();
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>
