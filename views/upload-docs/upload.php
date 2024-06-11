<?php
include "../../classes/Conexao.php"; 

//Ainda falta configurar a foreign key no banco para que na tb_arquivo a fk_id_estagio seja do respectivo usuario que está fazendo o upload

if (isset($_POST['submit'])) {

    $target_dir = "../../views/upload-docs/arquivos/";
 
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

   
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if ($fileType != "pdf") {
        echo "Desculpe, apenas arquivos PDF são permitidos.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "O arquivo ". htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado com sucesso.";
            
         
            $sql = "INSERT INTO tb_estagios (file_path) VALUES (:file_path)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':file_path', $target_file);

            if ($stmt->execute()) {
                echo "O caminho do arquivo foi salvo no banco de dados.";
            } else {
                echo "Erro ao salvar o caminho do arquivo no banco de dados.";
            }
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    }
}
?>
