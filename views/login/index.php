<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>InternHub - Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="login">
    <form id="form-login" action="../usuarios/usuario-login.php" method="post">

        <img class="fatec-logo" src="../../img/fatec-logo.svg" alt="">
        
        <div class="login">
            <div class="input-wrapper">
            <label for="usuario">Usuario :</label>
            <input
             type="text"
             id="usuario" 
             name="usuario"/>
            </div>

            <div class="input-wrapper">
            <label for="senha">Senha :</label>
            
            <input
             type="password"
             id="senha"
             name="senha" />
            </div>
        </div>

        <button 
            class="button" 
            form="form-login">
            Login
        </button>    
    </form>
    </div>
</div>
</body>
</html>