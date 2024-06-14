<?php 
require "../usuarios/usuario-verifica.php";
include "../../classes/Conexao.php";

if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do usuário não encontrado. Faça login novamente.";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

try {
 
    $sql_professor = "SELECT id_professor, nome_professor FROM tb_professores WHERE fk_id_usuario = :id_usuario"; 
    $stmt_professor = $conexao->prepare($sql_professor);
    $stmt_professor->bindParam(':id_usuario', $id_usuario); 
    $stmt_professor->execute();
    $resultado_professor = $stmt_professor->fetch(PDO::FETCH_ASSOC);

    if (!$resultado_professor) {
        echo "Nenhum dado encontrado para o ID do usuário fornecido.";
        exit();
    }

    $id_professor = $resultado_professor['id_professor'];
    $nome_professor = $resultado_professor['nome_professor'];

  
    $sql_arquivo = "SELECT fk_id_aluno, relatorio_parcial, caminho_parcial 
                   FROM tb_relatorio_parcial 
                   WHERE status = 'pendente'";
    $stmt_arquivo = $conexao->prepare($sql_arquivo);
    $stmt_arquivo->execute();
    $resultado_arquivo = $stmt_arquivo->fetch(PDO::FETCH_ASSOC);

    if ($resultado_arquivo) {
        $fk_id_aluno = $resultado_arquivo['fk_id_aluno'];
        $nome_arquivo = $resultado_arquivo['relatorio_parcial'];
        $caminho_parcial = '../upload-docs/' . $resultado_arquivo['caminho_parcial']; 

        if (file_exists($caminho_parcial)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($caminho_parcial) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($caminho_parcial));

            readfile($caminho_parcial);
            exit;
        } else {
            echo "O arquivo não existe: " . $caminho_parcial;
            exit();
        }
    } 
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>