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
$sql = "SELECT id_aluno, nome, ra, curso FROM tb_alunos WHERE fk_id_usuario = :id_usuario"; 
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario); 
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $id_aluno = $resultado['id_aluno'];
    $nome = $resultado['nome'];
    $ra = $resultado['ra'];
    $curso = $resultado['curso'];

} else {
    echo "Nenhum dado de aluno encontrado para o ID fornecido.";
    exit();
}

//Dados do estágio 
$sql_estagio = "SELECT fk_id_empresa FROM tb_estagios WHERE fk_id_aluno = :id_aluno"; 
$stmt_estagio = $conexao->prepare($sql_estagio);
$stmt_estagio->bindParam(':id_aluno', $id_aluno); 
$stmt_estagio->execute();
$resultado_estagio = $stmt_estagio->fetch(PDO::FETCH_ASSOC);

if ($resultado_estagio) {

    $fk_id_empresa = $resultado_estagio['fk_id_empresa'];

} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}

//Dados da empresa
$sql_empresa = "SELECT nome FROM tb_empresas WHERE id_empresa = :fk_id_empresa"; 
$stmt_empresa = $conexao->prepare($sql_empresa);
$stmt_empresa->bindParam(':fk_id_empresa', $fk_id_empresa); 
$stmt_empresa->execute();
$resultado_empresa = $stmt_empresa->fetch(PDO::FETCH_ASSOC);

if ($resultado_empresa) {
    $nome_empresa = $resultado_empresa['nome'];
} else {
    echo "Nenhum dado de estágio encontrado para o ID fornecido.";
    exit();
}

//Dados do representante 

$nome_supervisor = $_POST['nome_supervisor'];
$cargo_supervisor = $_POST['cargo_supervisor'];
$data_inicio = $_POST['data_inicio'];
$data_termino = $_POST['data_termino'];




//Coleta de dados do formulário 


$html = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
   <p>
   1.	Dados do Estagiário <br> <br>
Nome: $nome <br> <br>
RA:  $ra <br> <br>
Curso: DSM - Desenvolvimento de Software Multiplataforma <br> <br>
2.	Dados da Empresa Concedente <br> <br>
Nome da empresa: $nome_empresa <br> <br>
Nome do supervisor do estagiário: $nome_supervisor <br> <br>
Cargo do supervisor do estagiário: $cargo_supervisor <br> <br>
3.	Período <br> <br>
Data de início do estágio: $data_inicio <br> <br>
Data de término do estágio: $data_termino <br> <br>
4.	Atividades realizadas no Estágio (preenchido pelo estagiário) <br> <br>
Descreva as principais atividades desenvolvidas durante o estágio. <br> <br> <br> <br> <br> <br>
As atividades realizadas atenderam às suas expectativas? Explique. <br> <br> <br> <br> <br> <br>
Por meio das atividades desenvolvidas no estágio você teve condições de aplicar os conhecimentos teóricos e práticos obtidos durantes o curso? Explique <br> <br> <br> <br> <br> <br>
Descreva  os principais desafios encontrados no seu estágio e como foram resolvidos. <br> <br> <br> <br> <br> <br>
5.	Avaliação do Supervisor <br> <br> <br> <br> <br> <br>
Habilidades	Desempenho 
	(Nota entre 1 e 10) <br> <br>
Planejamento <br> 
O estagiário planeja as atividades procurando estabelecer prioridades e metas. <br> <br>	 									
Qualidade do Trabalho <br>
O estagiário executa as atividades com qualidade, tendo em vista as condições de trabalho oferecidas. 	<br> <br>									
Pontualidade e Assiduidade <br>
O estagiário cumpre com os horários, sem atrasos ou faltas. <br> <br>	 									
Disciplina <br>
O estagiário cumpre as normas vigentes na empresa, bem como as normas de segurança e o uso de EPI quando necessário. <br> <br>										
Iniciativa e Participação <br>
O estagiário é participativo, procura apresentar ideias para a melhoria dos processos, das atividades e do ambiente de trabalho. <br> <br>	

Relacionamento em Grupo <br>
O estagiário procura manter bom relacionamento com todos, sendo prestativo e participativo.	<br> <br>	

Responsabilidade e Comprometimento <br>
O estagiário entende as tarefas atribuídas e entende como realiza-las; realiza as tarefas com autonomia, respeitando os prazos estabelecidos para cada tarefa realizada.	<br> <br>		

Organização <br>
O estagiário mantém o local de trabalho organizado, consegue administrar o tempo com facilidade, e localiza facilmente as atividades realizadas ou as entregas feitas. <br> <br>
										
Comunicação <br>
O estagiário se expressa bem, com clareza, desenvoltura e segurança tanto na comunicação oral quanto na escrita.  		<br> <br>								

Comentários adicionais:


Data: ____/_____/ ___________


Estagiário	Supervisor do Estágiário 	Professor Orientador



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
