<?php
require '../../dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
include "../../classes/Conexao.php";

session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do aluno não encontrado. Faça login novamente.";
    exit();
}

//Dados do aluno 
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT id_aluno, nome, rg, ra, telefone, logradouro, numero, bairro, cidade, cep, curso, semestre, estado, email FROM tb_alunos WHERE fk_id_usuario = :id_usuario"; 
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario); 
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $id_aluno = $resultado['id_aluno'];
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
    echo "Nenhum dado de aluno encontrado para o ID fornecido.";
    exit();
}

//Dados do estágio 
$sql_estagio = "SELECT id_estagio, horario_inicio, horario_termino, inicio_intervalo, termino_intervalo, total_horas, data_inicio, data_termino, salario, apolice, seguradora, fk_id_empresa FROM tb_estagios WHERE fk_id_aluno = :id_aluno"; 
$stmt_estagio = $conexao->prepare($sql_estagio);
$stmt_estagio->bindParam(':id_aluno', $id_aluno); 
$stmt_estagio->execute();
$resultado_estagio = $stmt_estagio->fetch(PDO::FETCH_ASSOC);

if ($resultado_estagio) {
    $id_estagio = $resultado_estagio['id_estagio'];
    $horario_inicio = $resultado_estagio['horario_inicio'];
    $horario_termino = $resultado_estagio['horario_termino'];
    $inicio_intervalo = $resultado_estagio['inicio_intervalo'];
    $termino_intervalo = $resultado_estagio['termino_intervalo'];
    $total_horas = $resultado_estagio['total_horas'];
    $data_inicio = $resultado_estagio['data_inicio'];
    $data_termino = $resultado_estagio['data_termino'];
    $salario = $resultado_estagio['salario'];
    $apolice = $resultado_estagio['apolice'];
    $seguradora = $resultado_estagio['seguradora'];
    $fk_id_empresa = $resultado_estagio['fk_id_empresa'];

} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}

//Dados da empresa
$sql_empresa = "SELECT fk_id_representante, nome, cnpj, endereco FROM tb_empresas WHERE id_empresa = :fk_id_empresa"; 
$stmt_empresa = $conexao->prepare($sql_empresa);
$stmt_empresa->bindParam(':fk_id_empresa', $fk_id_empresa); 
$stmt_empresa->execute();
$resultado_empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);

if ($resultado_empresa) {

    $fk_id_representante = $resultado_empresa['fk_id_representante'];
    $nome_empresa = $resultado_empresa['nome'];
    $cnpj = $resultado_empresa['cnpj'];
    $endereco_empresa = $resultado_empresa['endereco'];
} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}

//Dados do representante 

$sql_representante = "SELECT nome, cpf, cargo FROM tb_representantes WHERE id_representante = :fk_id_representante"; 
$stmt_representante = $conexao->prepare($sql_representante);
$stmt_representante->bindParam(':fk_id_representante', $fk_id_representante); 
$stmt_representante->execute();
$resultado_representante = $stmt_representante->fetch(PDO::FETCH_ASSOC);

if ($resultado_representante) {

    $nome_representante = $resultado_representante['nome'];
    $cpf = $resultado_representante['cpf'];
    $cargo = $resultado_representante['cargo'];
} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}


//Dados coletados do formulário

//Dados da empresa 
$departamento = $_POST['departamento'];
$telefone_empresa = $_POST['telefone'];
$email_empresa = $_POST['email'];
$site = $_POST['site'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

//Dados do representante 
$contato_representante = $_POST['contato-representante'];

//Dados do estagio

$obrigatoriedade = $_POST['obrigatoriedade'];
$data_inicio_atividade = $_POST['data_inicio'];
$data_termino_atividade = $_POST['data_termino'];
$atividade_estagio = $_POST['atividade'];
$descricao_estagio = $_POST['descricao'];
$resultado_esperado = $_POST['resultado'];
$periodo_estagio = $_POST['periodo'];
$periodo_termino = $_POST ['periodo_termino'];
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

    <br><br><strong>Nome da Empresa :</strong> $nome_empresa
    <br><br><strong>Divisão ou departamento de aplicação do estágio  :</strong>
    <br><br><strong>Endereço :</strong> $endereco_empresa
    <br><br><strong>Bairro :</strong>
    <br><br><strong>Telefone/ramal :</strong> $telefone_empresa 
    <br><br><strong>Cep :</strong> $cep
    <br><br><strong>Cidade :</strong> $cidade 
    <br><br><strong>Estado :</strong> $estado
    <br><br><strong>Email :</strong> $email_empresa
    <br><br><strong>Site :</strong> $site

    <br><br><strong>Nome do Supervisor :</strong>  $nome_representante 
    <br><br><strong>Cargo do Supervisor :</strong>  $cargo 
    <br><br><strong>Contato do Supervisor :</strong> $contato_representante 

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
                <br><br>Atividade:	$atividade_estagio
                <br><br>Descrição da atividade: $descricao_estagio	
                <br><br>Objetivo ou resultado esperado: $resultado_esperado
                <br><br>Período previsto (início e término) $periodo_estagio, $periodo_termino 

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
