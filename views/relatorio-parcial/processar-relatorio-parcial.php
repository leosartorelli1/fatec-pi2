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
    <strong>1.	Dados do Estagiário </strong> <br> <br>
Nome: $nome <br> <br>
RA:  $ra <br> <br> 
Curso: $curso <br> <br>
<strong> 2.	Dados da Empresa Concedente </strong> <br> <br>
Nome da empresa: $nome_empresa <br> <br>
Nome do supervisor do estagiário: $nome_supervisor <br> <br>
Cargo do supervisor do estagiário: $cargo_supervisor <br> <br>
<strong> 3.	Avaliação do Supervisor </strong> <br> <br>
Nos últimos 6  meses, as atividades descritas no plano de atividades foram efetivamente realizadas pelo estagiário? ______________ <br> <br>
a.	Assiduidade e pontualidade	<br> <br>				
b.	Capacidade de trabalho em equipe <br> <br>			
c.	Conhecimentos teóricos e capacidade técnica <br> <br>	
d.	Criatividade e capacidade de inovação <br> <br>			
e.	Expressão oral e escrita <br> <br>						
f.	Iniciativa e capacidade de liderança <br> <br>				
g.	Interesse pela empresa e pela área de atuação <br> <br>			
h.	Motivação e proatividade <br> <br>						
i.	Profissionalismo e comportamento <br> <br>				
j.	Relacionamento interpessoal <br> <br>					
k.	Comprometimento <br> <br>					

<strong> 4.	Comentários e observações </strong> <br> <br>	
Data: ____/_____/ ___________ <br> <br> <br> <br> <br> 



Estagiário   Supervisor do Estágiário  Professor Orientador

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
