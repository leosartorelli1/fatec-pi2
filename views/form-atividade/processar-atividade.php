<?php
require '../../dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
include "../../classes/Conexao.php";

session_start();
if (!isset($_SESSION['id_aluno'])) {
    echo "Erro: ID do aluno não encontrado. Faça login novamente.";
    exit();
}

$id_aluno = $_SESSION['id_aluno'];
$sql = "SELECT nome, rg, ra, telefone, logradouro, numero, bairro, cep, cidade, estado , curso, semestre, email FROM tb_alunos WHERE fk_id_usuario = :id_aluno";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_aluno', $id_aluno);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $nome = $resultado['nome'];
    $rg = $resultado['rg'];
    $ra = $resultado['ra'];
    $telefone = $resultado['telefone'];
    $logradouro = $resultado['logradouro'];
    $numero = $resultado['numero'];
    $bairro = $resultado['bairro'];
    $cidade = $resultado['cidade'];
    $cep = $resultado['cep'];
    $curso = $resultado['curso'];
    $semestre = $resultado['semestre'];
    $estado = $resultado['estado'];
    $email = $resultado['email'];

} else {
    echo "Nenhum dado encontrado para o ID fornecido.";
    exit();
}

$departamento = $_POST['departamento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$site = $_POST['site'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$contato_representante = $_POST['contato-representante'];
$obrigatoriedade = $_POST['obrigatoriedade'];
$data_inicio_atividade = $_POST['data_inicio'];
$data_termino_atividade = $_POST['data_termino'];
$atividade = $_POST['atividade'];
$descricao = $_POST['descricao'];
$resultado = $_POST['resultado'];
$periodo = $_POST['periodo'];
$data_definida = $_POST['data_definida'];


$html = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
   <p>
    <strong> Identificação do Aluno </strong> <br> <br>
    <strong> Matricula : </strong> $ra  <strong> <br>Nome :</strong> $nome <br> <br>
    <strong>Curso : </strong> $curso <br> <strong>Semestre :</strong> $semestre <br><br>
    <strong>Endereço Domiciliar : </strong> $logradouro $numero <br> <strong>Telefone :</strong> $telefone <br><br>
    <strong>CEP :</strong> $cep  <br> <strong>Cidade :</strong> $cidade <br> <strong>Estado :</strong> $estado <br><br>
    <strong>Email :</strong> $email

    <strong>Identificação da Empresa </strong>

    <br><br><strong>Nome da Empresa :</strong>
    <br><br><strong>Divisão ou departamento de aplicação do estágio  :</strong>
    <br><br><strong>Endereço :</strong>
    <br><br><strong>Bairro :</strong>
    <br><br><strong>Telefone/ramal :</strong>
    <br><br><strong>Cep :</strong>
    <br><br><strong>Cidade :</strong>
    <br><br><strong>Estado :</strong>
    <br><br><strong>Email :</strong>
    <br><br><strong>Site :</strong>

    <br><br><strong>Nome do Supervisor :</strong>
    <br><br><strong>Cargo do Supervisor :</strong>
    <br><br><strong>Contato do Supervisor :</strong>

    <br><br>
    Classificação:
                <br><br> $obrigatoriedade
                <br><br>Período previsto de realização:
                <br><br>Início:___/___/____ Término: ___/___/____

                <br><br>Valor mensal da bolsa estágio (R$)	
                <br><br> Período real de execução:
                <br>Início: $data_inicio_atividade Término: $data_termino_atividade

                <br><br>Horário:
                <br><br>De segunda a sexta, das _________ h às _________ h.

                Cronograma (escreva a seguir as atividades que serão desenvolvidas no estágio. 
                <br><br>
                <br><br>Explique cada uma resumidamente e inclua linhas, se necessário): 
                <br><br>Atividade:	
                <br><br>Descrição da atividade: 	
                <br><br>Objetivo ou resultado esperado:
                <br><br>Período previsto (início e término)

                Estagiário: 
                 <br><br><br><br><br><br><br><br><br><br><br>


                Identificação e assinatura

                              
                            

                Empresa: 
                DECLARAÇÃO: plano definido em 

                <br><br><br><br><br><br><br><br><br><br><br>
                (carimbos da empresa com CNPJ e do supervisor, com sua assinatura)	Estagiário: 



                Identificação e assinatura
              


</p>
</body>
</html>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();


$dompdf->stream("documento.pdf", ["Attachment" => false]);
?>
