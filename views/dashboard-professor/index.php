<?php
require "../usuarios/usuario-verifica.php";
include "../../classes/Conexao.php";

if (!isset($_SESSION['id_usuario_professor'])) {
    echo "Erro: ID do usuário não encontrado. Faça login novamente.";
    exit();
}

$id_usuario = $_SESSION['id_usuario_professor'];

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

    // Consulta para alunos com termo de compromisso pendente
    $sql_alunos_compromisso = "
        SELECT 
            a.id_aluno,
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

    // Consulta para alunos com plano de atividades pendente
    $sql_alunos_atividades = "
        SELECT 
            a.id_aluno,
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

    // Consulta para alunos com relatório parcial pendente
    $sql_alunos_parcial = "
        SELECT 
            a.id_aluno,
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

    // Consulta para alunos com relatório final pendente
    $sql_alunos_final = "
        SELECT 
            a.id_aluno,
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="style.css">
   
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
        .hidden {
            display: none;
        }
    </style>
    <script>
        function aprovar(id, tipo) {
            if (confirm("Tem certeza que deseja aprovar este documento?")) {
                window.location.href = "aprovar.php?id=" + id + "&tipo=" + tipo;
            }
        }

        function mostrarCampoReprovar(id, tipo) {
            document.getElementById('motivo-' + id + '-' + tipo).classList.toggle('hidden');
        }

        function reprovar(id, tipo) {
            let motivo = document.getElementById('motivo-texto-' + id + '-' + tipo).value;
            if (motivo) {
                window.location.href = "reprovar.php?id=" + id + "&tipo=" + tipo + "&motivo=" + encodeURIComponent(motivo);
            } else {
                alert("Por favor, digite o motivo da reprovação.");
            }
        }
    </script>
</head>
<body>
<header>
    <div>
        <img src="../../img/fatec-logo.svg" width="150" height="60">
        <img src="../../img/cps-logo.svg" width="150" height="60">
    </div>

    <div>
        <nav>
            <ul>
                <li><a href="#term">Termo de Compromisso</a></li>
                <li><a href="#plan">Plano de Atividades</a></li>
                <li><a href="#rel-parcial">Relatório Parcial</a></li>
                <li><a href="#rel-final">Relatório Final</a></li>
            </ul>
        </nav>
    </div>

    <div class="logout">
        <a href="../usuarios/usuario-logout.php"><img src="../../img/logout.svg" title="Sair da página"></a>
    </div>
</header>

<div class="cps-principal">
    <h2>Olá, <span><?php echo htmlspecialchars($nome_professor); ?></span>! Bem-vindo à Plataforma do Professor!</h2>
    <span class="divisor"></span>
    <p>Aqui é o Portal do Professor, onde serão listados os alunos com confirmações pendentes em seu processo de estágio. Neste espaço, as solicitações serão analisadas e você poderá aprovar ou reprovar cada caso.</p><br><br>

    <section id="term">
        <div class="cps-principal-professor">
            <h3>Alunos aguardando verificação da documentação de termo de compromisso:</h3>

            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Curso</th>
                        <th>Semestre</th>
                        <th>Termo de Compromisso</th>
                        <th>Ações</th>
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
                                <button class="feedback-reprove" onclick="mostrarCampoReprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'compromisso')">Reprovar</button>
                                <div id="motivo-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-compromisso" class="hidden">
                                    <textarea class="motive" id="motivo-texto-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-compromisso" placeholder="Digite o motivo da reprovação"></textarea>
                                    <button class="feedback-envio" onclick="reprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'compromisso')">Enviar Reprovação</button>
                                </div>
                                <button class="feedback-aprove" onclick="aprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'compromisso')">Aprovar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="plan">
        <div class="cps-principal-professor">
            <h3>Alunos aguardando verificação do plano de atividades:</h3>

            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Curso</th>
                        <th>Semestre</th>
                        <th>Plano de Atividades</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos_atividades as $aluno): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($aluno['nome_aluno']); ?></td>
                            <td><?php echo htmlspecialchars($aluno['curso']); ?></td>
                            <td><?php echo htmlspecialchars($aluno['semestre']); ?></td>
                            <td>
                                <?php if (!empty($aluno['plano_atividades']) && !empty($aluno['caminho_atividades'])): ?>
                                    <a href="baixar-atividades.php?arquivo=<?php echo urlencode($aluno['caminho_atividades']); ?>&nome=<?php echo urlencode($aluno['plano_atividades']); ?>" download>
                                        Baixar Plano de Atividades
                                    </a>
                                <?php else: ?>
                                    Nenhum arquivo disponível
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="feedback-reprove" onclick="mostrarCampoReprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'atividades')">Reprovar</button>
                                <div id="motivo-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-atividades" class="hidden">
                                    <textarea class="motive" id="motivo-texto-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-atividades" placeholder="Digite o motivo da reprovação"></textarea>
                                    <button class="feedback-envio" onclick="reprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'atividades')">Enviar Reprovação</button>
                                </div>
                                <button class="feedback-aprove" onclick="aprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'atividades')">Aprovar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="rel-parcial">
        <div class="cps-principal-professor">
            <h3>Alunos aguardando verificação do relatório parcial:</h3>

            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Curso</th>
                        <th>Semestre</th>
                        <th>Relatório Parcial</th>
                        <th>Ações</th>
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
                            <td>
                                <button class="feedback-reprove" onclick="mostrarCampoReprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'parcial')">Reprovar</button>
                                <div id="motivo-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-parcial" class="hidden">
                                    <textarea class="motive" id="motivo-texto-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-parcial" placeholder="Digite o motivo da reprovação"></textarea>
                                    <button class="feedback-envio" onclick="reprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'parcial')">Enviar Reprovação</button>
                                </div>
                                <button class="feedback-aprove" onclick="aprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'parcial')">Aprovar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section id="rel-final">
        <div class="cps-principal-professor">
            <h3>Alunos aguardando verificação do relatório final:</h3>

            <table>
                <thead>
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Curso</th>
                        <th>Semestre</th>
                        <th>Relatório Final</th>
                        <th>Ações</th>
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
                            <td>
                                <button class="feedback-reprove" onclick="mostrarCampoReprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'final')">Reprovar</button>
                                <div id="motivo-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-final" class="hidden">
                                    <textarea class="motive" id="motivo-texto-<?php echo htmlspecialchars($aluno['id_aluno']); ?>-final" placeholder="Digite o motivo da reprovação"></textarea>
                                    <button class="feedback-envio" onclick="reprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'final')">Enviar Reprovação</button>
                                </div>
                                <button class="feedback-aprove" onclick="aprovar(<?php echo htmlspecialchars($aluno['id_aluno']); ?>, 'final')">Aprovar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

</body>
</html>

?>