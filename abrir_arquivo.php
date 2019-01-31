<?php

include("./core/dadosconexao.php");
try {
    $conecta = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $consultaSQL = "SELECT arquivo_tipo, arquivo_conteudo FROM tb_arquivos WHERE arquivo_id=$_GET[id]";
    $exComando = $conecta->prepare($consultaSQL); //testar o comando
    $exComando->execute(array());
    foreach ($exComando as $resultado) {
//        $tipo = $resultado['arquivo_tipo'];
//        $nome = $resultado['arquivo_titulo'];
        $conteudo = $resultado['arquivo_conteudo'];
//        header("Content-Type: {$tipo}");
        header("Content-type: text/xml");
        header("Content-Disposition: attachment; filename=" . "teste" . ".xml");
        header("Pragma: no-cache");
        echo $conteudo;
    }
} catch (PDOException $erro) {
    echo("Errrooooo! foi esse: " . $erro->getMessage());
}
?>

powershell.exe