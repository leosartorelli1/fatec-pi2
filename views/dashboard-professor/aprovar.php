<?php
require "../usuarios/usuario-verifica.php";
include "../../classes/Conexao.php";

$id_aluno = $_GET['id'];
$tipo = $_GET['tipo'];

try {
    switch ($tipo) {
        case 'compromisso':
            $sql = "UPDATE tb_compromisso SET status = 'aprovado' WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'parcial':
            $sql = "UPDATE tb_relatorio_parcial SET status = 'aprovado' WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'final':
            $sql = "UPDATE tb_relatorio_final SET status = 'aprovado' WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
            break;
        case 'atividades':
                $sql = "UPDATE tb_atividades SET status = 'aprovado' WHERE fk_id_aluno = :id_aluno AND status = 'pendente'";
                break;
        default:
            echo "Tipo inválido.";
            exit();
    }

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_aluno', $id_aluno);
    $stmt->execute();

    header("Location: index.php");
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>
