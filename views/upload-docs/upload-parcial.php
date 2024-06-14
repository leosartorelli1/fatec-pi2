<?php
include "../../classes/Conexao.php"; 
session_start();

// Verifica se o ID do usuário está na sessão
if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do aluno não encontrado. Faça login novamente.";
    header("refresh:2;url=../form-compromisso/landpage.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Busca o ID do aluno com base no ID do usuário
$sql = "SELECT id_aluno FROM tb_alunos WHERE fk_id_usuario = :id_usuario"; 
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario); 
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    echo "Nenhum dado encontrado para o ID do usuário fornecido.";
    header("refresh:2;url=../form-compromisso/landpage.php");
    exit();
}

$id_aluno = $resultado['id_aluno'];
$uploadDir = 'relatorio-parcial/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
 
    if ($file['type'] != 'application/pdf') {
        die("Por favor, envie apenas arquivos PDF.");
    }

    $uniqueId = uniqid('', true) . '.pdf'; 
    $uploadFile = $uploadDir . $uniqueId;

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        try {
            // Inserção na tabela tb_arquivos
            $sql_insert = "INSERT INTO tb_relatorio_parcial (relatorio_parcial, caminho_parcial, fk_id_aluno, status) VALUES (:relatorio_parcial, :caminho_parcial, :id_aluno, 'pendente')";
            $stmt_insert = $conexao->prepare($sql_insert);
            $stmt_insert->bindParam(':id_aluno', $id_aluno);
            $stmt_insert->bindParam(':relatorio_parcial', $uniqueId);
            $stmt_insert->bindParam(':caminho_parcial', $uploadFile);

            if ($stmt_insert->execute()) {
                echo "Arquivo enviado com sucesso.";
                header("refresh:2;url=../dashboard-aluno/index.php");
                exit();
            } else {
                echo "Erro ao inserir no banco de dados.";
                header("refresh:2;url=../relatorio-parcial/index.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir no banco de dados: " . $e->getMessage();
            header("refresh:2;url=../relatorio-parcial/index.php");
            exit();
        }
    } else {
        echo "Erro ao enviar o arquivo.";
        header("refresh:2;url=../relatorio-parcial/index.php");
        exit();
    }
} else {
    echo "Método de requisição inválido.";
    header("refresh:2;url=../relatorio-parcial/index.php");
    exit();
}
?>
