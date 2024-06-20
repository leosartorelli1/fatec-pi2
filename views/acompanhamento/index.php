<?php
require "../usuarios/usuario-verifica.php";
require "../../classes/Conexao.php"; // Incluir o arquivo que define a classe Conexao

if (!isset($_SESSION['id_usuario'])) {
    echo "Erro: ID do usuário não encontrado. Faça login novamente.";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

try {
    // Conexão com o banco de dados
    $conexao = new PDO('mysql:host=127.0.0.1;dbname=intern_hub', 'root', '');

    // Busca dados do aluno
    $sql_aluno = "
        SELECT 
            a.id_aluno,
            a.nome AS nome_aluno,
            a.ra,
            a.rg,
            a.telefone,
            a.logradouro,
            a.numero,
            a.bairro,
            a.estado,
            a.curso,
            a.semestre,
            a.email,
            e.nome AS nome_empresa,
            e.cnpj,
            e.endereco AS endereco_empresa,
            c.status AS status_compromisso,
            c.motivo_reprovacao AS motivo_reprovacao_compromisso,
            c.termo_compromisso,
            c.caminho_compromisso,
            at.status AS status_atividades,
            at.motivo_reprovacao AS motivo_reprovacao_atividades,
            at.plano_atividades,
            at.caminho_atividades,
            rp.status AS status_parcial,
            rp.motivo_reprovacao AS motivo_reprovacao_parcial,
            rp.relatorio_parcial,
            rp.caminho_parcial,
            rf.status AS status_final,
            rf.motivo_reprovacao AS motivo_reprovacao_final,
            rf.relatorio_final,
            rf.caminho_final
        FROM 
            tb_alunos a
        LEFT JOIN 
            tb_compromisso c ON a.id_aluno = c.fk_id_aluno
        LEFT JOIN 
            tb_atividades at ON a.id_aluno = at.fk_id_aluno
        LEFT JOIN 
            tb_relatorio_parcial rp ON a.id_aluno = rp.fk_id_aluno
        LEFT JOIN 
            tb_relatorio_final rf ON a.id_aluno = rf.fk_id_aluno
        LEFT JOIN 
            tb_estagios es ON a.id_aluno = es.fk_id_aluno
        LEFT JOIN 
            tb_empresas e ON es.fk_id_empresa = e.id_empresa
        WHERE 
            a.fk_id_usuario = :id_usuario
    ";
    $stmt_aluno = $conexao->prepare($sql_aluno);
    $stmt_aluno->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT); 
    $stmt_aluno->execute();
    $dados_aluno = $stmt_aluno->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acompanhamento do Aluno</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Acompanhamento de Documentação - Aluno</h2>

    <h3>Dados do Aluno:</h3>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($dados_aluno['nome_aluno']); ?></p>
    <p><strong>Curso:</strong> <?php echo htmlspecialchars($dados_aluno['curso']); ?></p>
    <p><strong>Semestre:</strong> <?php echo htmlspecialchars($dados_aluno['semestre']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($dados_aluno['email']); ?></p>
    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($dados_aluno['telefone']); ?></p>

    <h3>Dados da Empresa:</h3>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($dados_aluno['nome_empresa']); ?></p>
    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($dados_aluno['endereco_empresa']); ?></p>

    <h3>Status da Documentação:</h3>

    <h4>Termo de Compromisso:</h4>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Motivo da Reprovação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if ($dados_aluno['status_compromisso'] == 'pendente'): ?>
                        Pendente
                    <?php elseif ($dados_aluno['status_compromisso'] == 'aprovado'): ?>
                        Aprovado
                    <?php elseif ($dados_aluno['status_compromisso'] == 'reprovado'): ?>
                        Reprovado
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($dados_aluno['motivo_reprovacao_compromisso']); ?></td>
            </tr>
        </tbody>
    </table>

    <h4>Plano de Atividades:</h4>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Motivo da Reprovação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if ($dados_aluno['status_atividades'] == 'pendente'): ?>
                        Pendente
                    <?php elseif ($dados_aluno['status_atividades'] == 'aprovado'): ?>
                        Aprovado
                    <?php elseif ($dados_aluno['status_atividades'] == 'reprovado'): ?>
                        Reprovado
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($dados_aluno['motivo_reprovacao_atividades']); ?></td>
            </tr>
        </tbody>
    </table>

    <h4>Relatório Parcial:</h4>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Motivo da Reprovação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if ($dados_aluno['status_parcial'] == 'pendente'): ?>
                        Pendente
                    <?php elseif ($dados_aluno['status_parcial'] == 'aprovado'): ?>
                        Aprovado
                    <?php elseif ($dados_aluno['status_parcial'] == 'reprovado'): ?>
                        Reprovado
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($dados_aluno['motivo_reprovacao_parcial']); ?></td>
            </tr>
        </tbody>
    </table>

    <h4>Relatório Final:</h4>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Motivo da Reprovação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if ($dados_aluno['status_final'] == 'pendente'): ?>
                        Pendente
                    <?php elseif ($dados_aluno['status_final'] == 'aprovado'): ?>
                        Aprovado
                    <?php elseif ($dados_aluno['status_final'] == 'reprovado'): ?>
                        Reprovado
                    <?php endif; ?>
                </td>
                <td><?php echo ($dados_aluno['status_final'] == 'reprovado') ? 'Reprovado - ' . htmlspecialchars($dados_aluno['motivo_reprovacao_final']) : ''; ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
