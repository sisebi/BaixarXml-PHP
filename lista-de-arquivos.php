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

    <?php
    include("./core/dadosconexao.php");
	try
	{
		$conecta = new PDO("mysql:host=$servidor;dbname=$banco", $usuario , $senha);
		$consultaSQL = "SELECT arquivo_id, arquivo_nome, arquivo_titulo, arquivo_tipo FROM tb_arquivos";
		$exComando = $conecta->prepare($consultaSQL); //testar o comando
		$exComando->execute(array());
		
        echo("
        <table class='table table-striped table-bordered table-hover'>
        <thead class='thead-dark'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Titulo</th>
            <th>Tipo</th>
            <th>Abrir</th>
            <th>Thumbnail</th>
        </tr>
        </thead>
        ");
		foreach($exComando as $resultado) 
		{
            echo "
            <tr>
                <td>$resultado[arquivo_id]</td>
                <td>$resultado[arquivo_nome]</td>
                <td>$resultado[arquivo_titulo]</td>
                <td>$resultado[arquivo_tipo]</td>
                <td><a href='abrir_arquivo.php?id=$resultado[arquivo_id]'>abrir</a></td>
                <td><img src='abrir_arquivo.php?id=$resultado[arquivo_id]' width='120px'/></td>
            </tr>
            ";
		}	
        echo("</table>");
        
	}catch(PDOException $erro)
	{
		echo("Errrooooo! foi esse: " . $erro->getMessage());
	}
    ?>

    </div>
</body>
</html>