<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Cadastro de arquivos</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h1> Cadastro de Arquivos </h1>
        <p>Prof. Anderson Oliveira - Etec Carmine Biagio Tundisi / Atibaia</p>
        <hr/><br/>
        <form enctype="multipart/form-data" method="post">
            <label>Arquivo</label>
            <input type="file" name="arquivo" class="form-control" required>

            <label>Descrição</label>
            <input type="text" name="titulo" size="30" class="form-control" required>

            <button type="submit" class="btn">Enviar arquivo</button>
        </form>

        <?php
        if ($_POST) {        
            include("./core/dadosconexao.php");
            $arquivo = $_FILES["arquivo"]["tmp_name"]; 
            $tamanho = $_FILES["arquivo"]["size"];
            $tipo    = $_FILES["arquivo"]["type"];
            $nome  = $_FILES["arquivo"]["name"];
            $titulo  = $_POST["titulo"];
            
            echo $tipo;

            if ( $arquivo != "none" )
            {
                $fp = fopen($arquivo, "rb");
                $conteudo = fread($fp, $tamanho);
                $conteudo = addslashes($conteudo);
                fclose($fp);                 
                
                
                try { 
                     $conecta = new PDO("mysql:host=$servidor;dbname=$banco", $usuario , $senha); //istancia a classe PDO
			         $comandoSQL = "INSERT INTO tb_arquivos VALUES (0,'$nome','$titulo','$conteudo','$tipo')";
			         $grava = $conecta->prepare($comandoSQL); //testa o comando SQL
			         $grava->execute(array()); 	                                        
                     echo '<br/><div class="alert alert-success" role="alert">
                                Arquivo enviado com sucesso para o servidor!
                            </div>';
		          } catch(PDOException $e) { // caso retorne erro
                     
                     echo '<br/><div class="alert alert-success" role="alert">
                                Erro ' . $e->getMessage() . 
                          '</div>';
		          }
            }}
    ?>
        
    <div style="height:50px"></div>
        
    <?php include("lista-de-arquivos.php")?>
        
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
        (function() {
            'use strict'

            if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement('style')
                msViewportStyle.appendChild(
                    document.createTextNode(
                        '@-ms-viewport{width:auto!important}'
                    )
                )
                document.head.appendChild(msViewportStyle)
            }

        }())

    </script>
</body>

</html>
