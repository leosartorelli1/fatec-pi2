
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>InterHub - Aluno</title>
    <link rel="stylesheet" href="style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

    <nav>
        <img src="assets/fatec-logo.svg" width="130" height="60" alt="">

        <ul>
            <li>Inicio</li>
            <li>Sobre</li>
            <li>Contato</li>
        </ul>

        <button>Logout</button>
    </nav>

    <main>
    <h1>Bem-vindo a plataforma <span>InternHub</span>!</h1>
    <h2>Nesta área você poderá dar inicio a o seu estágio e também realizar o acompanhamento!</h2>

        Selecione uma das opções abaixo : <br>

        <button id="cadastro-estagio">Cadastrar Inicio de Estágio</button>
        <button id="envio-docs">Enviar documentação </button>
        <button id="status">Acompanhamento</button>
        <button id="encerramento-estagio">Solicitar encerramento de estágio</button>
    </main>

    <script>
    document.getElementById("cadastro-estagio").addEventListener("click", function() {
    window.location.href = "views/form-compromisso/form-compromisso.php";
    });

</script>
</body>
</html>