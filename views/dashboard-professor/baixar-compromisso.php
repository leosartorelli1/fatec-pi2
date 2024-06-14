<?php 
require "../usuarios/usuario-verifica.php";
include "../../classes/Conexao.php";

if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do usuário não encontrado. Faça login novamente.";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

try {
    // Busca o ID do professor com base no ID do usuário
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

    // Consulta SQL para obter o caminho e o nome do arquivo com status pendente
    $sql_arquivo = "SELECT fk_id_aluno, termo_compromisso, caminho_compromisso 
                   FROM tb_compromisso 
                   WHERE status = 'pendente'";
    $stmt_arquivo = $conexao->prepare($sql_arquivo);
    $stmt_arquivo->execute();
    $resultado_arquivo = $stmt_arquivo->fetch(PDO::FETCH_ASSOC);

    if ($resultado_arquivo) {
        $fk_id_aluno = $resultado_arquivo['fk_id_aluno'];
        $nome_arquivo = $resultado_arquivo['termo_compromisso'];
        $caminho_compromisso = '../upload-docs/' . $resultado_arquivo['caminho_compromisso']; // Ajuste o caminho conforme necessário

        if (file_exists($caminho_compromisso)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($caminho_compromisso) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($caminho_compromisso));

            readfile($caminho_compromisso);
            exit;
        } else {
            echo "O arquivo não existe: " . $caminho_compromisso;
            exit();
        }
    } 
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>