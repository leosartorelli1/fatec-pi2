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

    $sql_alunos_compromisso = "
            SELECT 
                a.nome AS nome_aluno, 
                a.curso, 
                a.semestre, 
                c.termo_compromisso, 
                c.caminho_compromisso
            FROM 
                tb_alunos a
            LEFT JOIN 
                tb_compromisso c ON a.id_aluno = c.fk_id_aluno AND c.status = 'pendente'
            WHERE 
                c.status = 'pendente'
        ";
        $stmt_alunos_compromisso = $conexao->prepare($sql_alunos_compromisso);
        $stmt_alunos_compromisso->execute();
        $alunos_compromisso = $stmt_alunos_compromisso->fetchAll(PDO::FETCH_ASSOC);

                $sql_alunos_atividades = "
            SELECT 
                a.nome AS nome_aluno, 
                a.curso, 
                a.semestre, 
                at.plano_atividades, 
                at.caminho_atividades
            FROM 
                tb_alunos a
            LEFT JOIN 
                tb_atividades at ON a.id_aluno = at.fk_id_aluno AND at.status = 'pendente'
            WHERE 
                at.status = 'pendente'
        ";
        $stmt_alunos_atividades = $conexao->prepare($sql_alunos_atividades);
        $stmt_alunos_atividades->execute();
        $alunos_atividades = $stmt_alunos_atividades->fetchAll(PDO::FETCH_ASSOC);


            $sql_alunos_parcial = "
            SELECT 
                a.nome AS nome_aluno, 
                a.curso, 
                a.semestre, 
                rp.relatorio_parcial, 
                rp.caminho_parcial
            FROM 
                tb_alunos a
            LEFT JOIN 
                tb_relatorio_parcial rp ON a.id_aluno = rp.fk_id_aluno AND rp.status = 'pendente'
            WHERE 
                rp.status = 'pendente'
        ";
        $stmt_alunos_parcial = $conexao->prepare($sql_alunos_parcial);
        $stmt_alunos_parcial->execute();
        $alunos_parcial = $stmt_alunos_parcial->fetchAll(PDO::FETCH_ASSOC);

            $sql_alunos_final = "
            SELECT 
                a.nome AS nome_aluno, 
                a.curso, 
                a.semestre, 
                rf.relatorio_final, 
                rf.caminho_final
            FROM 
                tb_alunos a
            LEFT JOIN 
                tb_relatorio_final rf ON a.id_aluno = rf.fk_id_aluno AND rf.status = 'pendente'
            WHERE 
                rf.status = 'pendente'
        ";
        $stmt_alunos_final = $conexao->prepare($sql_alunos_final);
        $stmt_alunos_final->execute();
        $alunos_final = $stmt_alunos_final->fetchAll(PDO::FETCH_ASSOC);

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
    <title>DashBoard Professor</title>
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
    </style>
</head>
<body>
    <h2>Olá, <span><?php echo htmlspecialchars($nome_professor); ?></span>! Bem-vindo à Plataforma InternHub!</h2>

    <p>Nesta área, você pode verificar a documentação de início de estágio e também os relatórios parcial e final dos alunos</p>

    <h3>Alunos aguardando verificação da documentação de início de estágio:</h3>

    <table>
        <thead>
            <tr>
                <th>Nome do Aluno</th>
                <th>Curso</th>
                <th>Semestre</th>
                <th>Termo de Compromisso</th>
                <th>Plano de Atividades</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos_compromisso as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['curso']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['semestre']); ?></td>
                    <td>
                        <?php if (!empty($aluno['termo_compromisso']) && !empty($aluno['caminho_compromisso'])): ?>
                            <a href="baixar-compromisso.php?arquivo=<?php echo urlencode($aluno['caminho_compromisso']); ?>&nome=<?php echo urlencode($aluno['termo_compromisso']); ?>" download>
                                Baixar Termo de Compromisso
                            </a>
                        <?php else: ?>
                            Nenhum arquivo disponível
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($aluno['plano_atividades']) && !empty($aluno['caminho_atividades'])): ?>
                            <a href="baixar-atividade.php?arquivo=<?php echo urlencode($aluno['caminho_atividades']); ?>&nome=<?php echo urlencode($aluno['plano_atividades']); ?>" download>
                                Baixar Plano de Atividades
                            </a>
                        <?php else: ?>
                            Nenhum arquivo disponível
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Alunos aguardando verificação da documentação de relatório parcial:</h3>

    <table>
        <thead>
            <tr>
                <th>Nome do Aluno</th>
                <th>Curso</th>
                <th>Semestre</th>
                <th>Relatório Parcial</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos_parcial as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['curso']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['semestre']); ?></td>
                    <td>
                        <?php if (!empty($aluno['relatorio_parcial']) && !empty($aluno['caminho_parcial'])): ?>
                            <a href="baixar-parcial.php?arquivo=<?php echo urlencode($aluno['caminho_parcial']); ?>&nome=<?php echo urlencode($aluno['relatorio_parcial']); ?>" download>
                                Baixar Relatório Parcial
                            </a>
                        <?php else: ?>
                            Nenhum arquivo disponível
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Alunos aguardando verificação da documentação de relatório final:</h3>

    <table>
        <thead>
            <tr>
                <th>Nome do Aluno</th>
                <th>Curso</th>
                <th>Semestre</th>
                <th>Relatório Final</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos_final as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['curso']); ?></td>
                    <td><?php echo htmlspecialchars($aluno['semestre']); ?></td>
                    <td>
                        <?php if (!empty($aluno['relatorio_final']) && !empty($aluno['caminho_final'])): ?>
                            <a href="baixar-final.php?arquivo=<?php echo urlencode($aluno['caminho_final']); ?>&nome=<?php echo urlencode($aluno['relatorio_final']); ?>" download>
                                Baixar Relatório Final
                            </a>
                        <?php else: ?>
                            Nenhum arquivo disponível
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
