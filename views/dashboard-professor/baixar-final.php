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


    $sql_arquivo = "SELECT fk_id_aluno, relatorio_final, caminho_final 
                   FROM tb_relatorio_final 
                   WHERE status = 'pendente'";
    $stmt_arquivo = $conexao->prepare($sql_arquivo);
    $stmt_arquivo->execute();
    $resultado_arquivo = $stmt_arquivo->fetch(PDO::FETCH_ASSOC);

    if ($resultado_arquivo) {
        $fk_id_aluno = $resultado_arquivo['fk_id_aluno'];
        $nome_arquivo = $resultado_arquivo['relatorio_final'];
        $caminho_final = '../upload-docs/' . $resultado_arquivo['caminho_final']; 

        if (file_exists($caminho_final)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($caminho_final) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($caminho_final));

            readfile($caminho_final);
            exit;
        } else {
            echo "O arquivo não existe: " . $caminho_final;
            exit();
        }
    } 
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>