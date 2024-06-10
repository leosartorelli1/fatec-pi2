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
$sql = "SELECT nome, rg, logradouro, numero, bairro, cidade FROM tb_alunos WHERE fk_id_usuario = :id_aluno";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_aluno', $id_aluno);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if ($resultado) {
    $nome = $resultado['nome'];
    $rg = $resultado['rg'];
    $logradouro = $resultado['logradouro'];
    $numero = $resultado['numero'];
    $bairro = $resultado['bairro'];
    $cidade = $resultado['cidade'];
} else {
    echo "Nenhum dado encontrado para o ID fornecido.";
    exit();
}

//Empresa
$nome_empresa = $_POST['nome_empresa'];
$cnpj = $_POST['cnpj'];
$endereco_empresa = $_POST['endereco_empresa'];

//Representante
$nome_representante = $_POST['nome_representante'];
$cargo_representante = $_POST['cargo_representante'];
$cpf_representante = $_POST['cpf_representante'];

//Estagio
$horario_inicio = $_POST['horario_inicio'];
$horario_termino = $_POST['horario_termino'];
$inicio_intervalo = $_POST['inicio_intervalo'];
$termino_intervalo = $_POST['termino_intervalo'];
$total_horas = $_POST['total_horas'];
$data_inicio = $_POST['data_inicio'];
$data_termino = $_POST['data_termino'];
$remunerado = $_POST['remunerado'];
$salario = isset($_POST['salario']) ? $_POST['salario'] : 'N/A';
$vale_transporte = $_POST['vale_transporte'];
$vt = isset($_POST['vt']) ? $_POST['vt'] : 'N/A';
$apolice = $_POST['apolice'];
$seguradora = $_POST['seguradora'];

$sql_empresa = "INSERT INTO tb_empresas (nome, cnpj, endereco) VALUES (:nome_empresa, :cnpj, :endereco_empresa)";
$sql_representante = "INSERT INTO tb_representantes(nome, cpf, cargo) VALUES (:nome_representante, :cpf_representante, :cargo_representante)";

$stmt_empresa = $conexao->prepare($sql_empresa);
$stmt_representante = $conexao->prepare($sql_representante);

$stmt_empresa->bindParam(':nome_empresa', $nome_empresa);
$stmt_empresa->bindParam(':cnpj', $cnpj);
$stmt_empresa->bindParam(':endereco_empresa', $endereco_empresa);

$stmt_representante->bindParam(':nome_representante', $nome_representante);
$stmt_representante->bindParam(':cpf_representante', $cpf_representante);
$stmt_representante->bindParam(':cargo_representante', $cargo_representante);

$sql_estagio = "INSERT INTO tb_estagios (horario_inicio, horario_termino, inicio_intervalo, termino_intervalo, total_horas, data_inicio, data_termino, salario, vt, apolice, seguradora) 
                VALUES (:horario_inicio, :horario_termino, :inicio_intervalo, :termino_intervalo, :total_horas, :data_inicio, :data_termino, :salario, :vt, :apolice, :seguradora)";

$stmt_estagio = $conexao->prepare($sql_estagio);

$stmt_estagio->bindParam(':horario_inicio', $horario_inicio);
$stmt_estagio->bindParam(':horario_termino', $horario_termino);
$stmt_estagio->bindParam(':inicio_intervalo', $inicio_intervalo);
$stmt_estagio->bindParam(':termino_intervalo', $termino_intervalo);
$stmt_estagio->bindParam(':total_horas', $total_horas);
$stmt_estagio->bindParam(':data_inicio', $data_inicio);
$stmt_estagio->bindParam(':data_termino', $data_termino);
$stmt_estagio->bindParam(':salario', $salario);
$stmt_estagio->bindParam(':vt', $vt);
$stmt_estagio->bindParam(':apolice', $apolice);
$stmt_estagio->bindParam(':seguradora', $seguradora);

$stmt_empresa->execute();
$stmt_representante->execute();
$stmt_estagio->execute();


$html = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
   <p>
    TERMO DE COMPROMISSO PARA A REALIZAÇÃO DE ESTÁGIO SUPERVISIONADO OBRIGATÓRIO (Lei nº 11.778/08) <br> <br> <br>
    Pelo presente instrumento, as partes a seguir nomeadas e ao final assinadas, de um lado <strong>$nome_empresa</strong>, inscrita no CNPJ sob o nº <strong>$cnpj</strong>, sita à rua <strong>$endereco_empresa</strong>
    , doravante denominada CONCEDENTE, neste ato representada por <strong>$nome_representante</strong>, <strong>$cargo_representante</strong>, portador do CPF nº <strong>$cpf_representante</strong> e, de outro lado, 
    o(a) estudante <strong>$nome</strong>, RG nº <strong>$rg</strong>, residente à <strong>$logradouro, $numero, $bairro</strong>, na cidade de <strong>$cidade</strong>, doravante denominado ESTAGIÁRIO (A), aluno (a) regularmente matriculado (a) no Curso Superior de Tecnologia em Desenvolvimento de Software Multiplataforma da Faculdade de Tecnologia de Itapira – Fatec “Ogari de Castro Pacheco”, inscrita no CNPJ sob o nº 62.823.257/0278-05, localizada na cidade de Itapira, Estado de São Paulo, doravante denominada INSTITUIÇÃO DE ENSINO, na condição de interveniente, acordam e estabelecem entre si as cláusulas e condições que regerão este TERMO DE COMPROMISSO DE ESTÁGIO OBRIGATÓRIO NÃO REMUNERADO.
     <br> <br> 
    
    CLÁUSULA PRIMEIRA. É objeto do presente Termo de Compromisso de Estágio autorizar a realização de estágio nos termos da Lei 11.788/08 de 25/09/2008, com a finalidade de possibilitar ao (à) Estagiário (a) complementação e aperfeiçoamento prático de seu Curso Superior de Tecnologia, celebrado entre a Concedente e a Instituição de Ensino da qual o (a) Estagiário (a) é aluno (a).
    Parágrafo Primeiro. Entende-se por estágio profissional aquele desenvolvido em ambiente real de trabalho, assumido como ato educativo e supervisionado pela instituição de ensino, em regime de parceria com organizações do mundo do trabalho, objetivando efetiva preparação do estudante para o trabalho, conforme o art. 34, § 1º da Resolução CNE/CP Nº 1/2021. 
    <br>
    Parágrafo Segundo. As atividades de estágio somente poderão ser iniciadas após assinatura do Termo de Compromisso de Estágio pelas partes envolvidas, não sendo reconhecida ou validada com data retroativa.
    <br>
    Parágrafo Terceiro. Em caso de prorrogação de vigência do Termo de Compromisso de Estágio, o preenchimento e a assinatura do Termo Aditivo deverão ser providenciados, com antecedência de 20 (vinte) dias, antes da data de encerramento, contida neste Termo de Compromisso.
    <br> <br> 

    CLÁUSULA SEGUNDA.
    As atividades a serem desenvolvidas durante o Estágio, objeto do presente Termo de Compromisso, constarão de Plano de Estágio construído pelo (a) Estagiário (a) em conjunto com a Concedente e orientado por professor da Instituição de Ensino. 
    <br>
    Parágrafo primeiro: O Plano de Atividade de Estágio – PAE está anexo ao Termo de Compromisso de Estágio. 
    <br> <br> 
    
    CLÁUSULA TERCEIRA. Fica compromissado entre as partes que:  
    <br>
    I - As atividades do Estágio a serem cumpridas pelo (a) Estagiário (a) serão no horário das <strong>$horario_inicio</strong> às <strong>$horario_termino</strong> horas, com intervalo das refeições das <strong>$inicio_intervalo</strong> às <strong>$termino_intervalo</strong> horas, de 2ª a 6ª feira, perfazendo <strong>$total_horas</strong> horas semanais; 
    <br>
    II - A jornada de atividade do (a) Estagiário (a) deverá compatibilizar-se com o horário escolar do(a) Estagiário(a) e com o horário da Concedente; 
    <br>
    III- Este Termo de Compromisso terá vigência de <strong>$data_inicio</strong> a <strong>$data_termino</strong>, podendo ser denunciado a qualquer tempo, por qualquer das três partes envolvidas, unilateralmente, mediante comunicação escrita, com antecedência mínima de 5 (cinco) dias; 
    <br>
    IV -     O (A) Estagiário (a) receberá da concedente durante o período de estágio, uma bolsa no valor de <strong>R$ $salario</strong> e auxílio transporte, conforme acordado entre as partes;  
    <br>
    V - Nos períodos em que a instituição de ensino adotar verificações de aprendizagem periódica ou final, a carga horária do estágio será reduzida pelo menos à metade para garantir o bom desempenho do estudante, conforme o art. 10, § 2º da Lei de Estágio;
    <br>
    VI - A duração do estágio, na mesma parte concedente, não poderá exceder 2 (dois) anos, exceto quando se tratar de estagiário com deficiência, conforme art. 11 da Lei de Estágio;
    <br>
    VII - O estágio não pode, em qualquer hipótese, se estender após a conclusão do Curso Superior de Tecnologia.

    <br> <br> 
   
    CLÁUSULA QUARTA. Além das atribuições e responsabilidade previstas no presente Termo de Compromisso de Estágio, caberá à CONCEDENTE: 
    <br>
    I – Garantir ao (à) Estagiário (a) o cumprimento das exigências escolares, inclusive no que se refere ao horário escolar;
    <br>
    II - Proporcionar ao (à)  Estagiário (a)  atividades de aprendizagem social, profissional e cultural compatíveis com sua formação profissional; 
    <br>
    III - Proporcionar ao (à)  Estagiário (a)  condições de treinamento prático e de relacionamento humano; 
    <br>
    IV - Designar um (a) Supervisor (a) ou responsável para orientar as tarefas do Estagiário; 
    <br>
    V - Proporcionar à Instituição de Ensino, sempre que necessário, subsídios que possibilitem o acompanhamento, a supervisão e a avaliação parcial do Estagiário; 
    <br>
    VI – Entregar ao (à) Estagiário (a), por ocasião do desligamento, termo de realização do estágio, indicando de forma resumida as atividades desenvolvidas, os períodos e a avaliação de desempenho.
    <br> <br> 
    
    CLÁUSULA QUINTA. Além das atribuições e responsabilidade previstas no presente Termo de Compromisso de Estágio, caberá ao (à) ESTAGIÁRIO (A): 
    <br>
    I - Estar regularmente matriculado (a) na Instituição de Ensino, em semestre compatível com a prática exigida no Estágio; 
    <br>
    II - Observar as diretrizes e/ou normas internas da Concedente e os dispositivos legais aplicáveis ao estágio, bem como as orientações do Professor Responsável de Estágios e do seu Supervisor ou responsável; 
    <br>
    III - Cumprir, com seriedade e responsabilidade, empenho e interesse a programação estabelecida entre a Concedente, o (a) Estagiário (a) e a Instituição de Ensino e preservar o sigilo das informações a que tiver acesso; 
    <br>
    IV - Elaborar e entregar à Instituição de Ensino de relatórios parciais e relatório final sobre seu estágio, na forma estabelecida por ele; 
    <br>
    V - Cumprir as normas internas da Concedente, principalmente as relacionadas com o estágio e não divulgar ou transmitir, durante ou depois do período de estágio, a quem quer que seja, qualquer informação confidencial ou material que se relacione com os negócios da Concedente; 
    <br>
    VI - Responder pelas perdas e danos consequentes da inobservância das cláusulas constantes do presente termo; 
    <br>
    VII - Comunicar à Concedente, no prazo de 5 (cinco) dias, a ocorrência de qualquer uma das alternativas do inciso I da Cláusula Oitava; 
    <br>
    VIII - Respeitar as cláusulas do Termo de Compromisso; 
    <br>
    IX - Encaminhar obrigatoriamente à Instituição de Ensino e à Concedente uma via do presente instrumento, devidamente assinado pelas partes.  
    <br>
    X – Comunicar à Instituição de Ensino qualquer fato relevante sobre o estágio.
    <br> <br> 
    
    CLÁUSULA SEXTA. Caberá à INSTITUIÇÃO DE ENSINO: 
    <br>
    I - Estabelecer critérios para a realização do Estágio Supervisionado, seu acompanhamento e avaliação bem como encaminhá-los à Concedente; 
    <br>
    II - Planejar o estágio, orientar, supervisionar e avaliar o (a) Estagiário (a), parcialmente e ao final do estágio.
    <br> <br> 
    
    
    CLÁUSULA SÉTIMA. A Concedente se obriga a fazer o Seguro de Acidentes Pessoais ocorridos nos locais de estágio, conforme legislação vigente, de acordo com a Apólice de Seguro nº <strong>$apolice</strong>,
     da Seguradora <strong>$seguradora</strong>, nos termos do Artigo 9º Inciso IV da Lei 11.788/08.  
    <br> <br> 
    
    CLÁUSULA OITAVA. Constituem motivo para a rescisão automática do presente Termo de Compromisso: 
    <br>
    I - A conclusão, abandono ou mudança de Curso, ou trancamento de matrícula do (a)  Estagiário (a); 
    <br>
    II - O não cumprimento do convencionado neste Termo de Compromisso; 
     <br>
     III- O abandono do estágio.
     <br> <br> 
    
     CLÁUSULA NONA. É assegurado ao (à) Estagiário (a), sempre que o estágio tenha duração igual ou superior a um ano, período de recesso de trinta dias, a ser gozado preferencialmente durante suas férias escolares. E proporcional aos estágios inferiores a um ano. O recesso de que trata esse artigo deverá ser remunerado quando o Estagiário receber bolsa ou outra forma de contraprestação e o auxílio transportes, conforme artigo 13º, § 1º e § 2º da Lei 11.788.
     <br> <br> 
    
     CLÁUSULA DÉCIMA. Assim, materializado e caracterizado, o presente Estágio, segundo a legislação, não acarretará vínculo empregatício de qualquer natureza entre o Estagiário e a Concedente, nos termos do que dispõem o Artigo 12º da Lei nº 11.788/08.  
     <br> <br> 
    
     CLÁUSULA DÉCIMA PRIMEIRA. As partes elegem o Foro da Comarca de Itapira-SP, com expressa renúncia de outro, por mais privilegiado que seja para dirimir qualquer questão emergente do presente Termo de Compromisso.
    Por estarem de inteiro e comum acordo com as condições e dizeres deste instrumento, as partes assinam-no em 3 (três) vias de igual teor e forma, todas assinadas pelas partes, depois de lido, conferido e achado conforme em todos os seus termos.
    CIDADE, XX de XXXXX de 20XX. 
    <br> <br> 
    
    
    $nome <br><br><br>	$nome_representante (nome completo/ carimbo e assinatura) CEETEPS
    Prof. Me. Luiz Henrique Biazzoto
    Diretor da Faculdade de Tecnologia ”Ogari de Castro Pacheco”
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
