<?php
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM tb_usuarios WHERE
usuario ='{$usuario}' AND
senha = '{$senha}'";

include "../../classes/Conexao.php";

$resultado = $conexao->query($sql);
$linha = $resultado->fetch();
$usuario_logado = $linha['usuario'];

if ($usuario_logado == null) {
    header('Location:usuario-erro.php');
}
else{
    session_start();
     $_SESSION['usuario_logado'] = $usuario_logado;
     header("Location:../../index2.php");
}

?>