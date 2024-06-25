<?php
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

include "../../classes/Conexao.php";

$sql = "SELECT * FROM tb_usuarios WHERE usuario = :usuario AND senha = :senha";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

$linha = $stmt->fetch(PDO::FETCH_ASSOC);
$usuario_logado = $linha['usuario'];
$id_usuario = $linha['id_usuario']; 
$permissao = $linha['permissao'];

if ($usuario_logado == null) {
    header('Location:usuario-erro.php');
    exit();
} else {
    session_start();
    $_SESSION['usuario_logado'] = $usuario_logado;

    if ($permissao == 'aluno') {
        $_SESSION['id_usuario'] = $id_usuario; 
        header("Location:../dashboard-aluno/index.php");
    } elseif ($permissao == 'prof') {
        $_SESSION['id_usuario_professor'] = $id_usuario; 
        header("Location:../dashboard-professor/index.php");
    } else {
        header("Location:usuario-erro.php");
    }
    exit();
}
?>
