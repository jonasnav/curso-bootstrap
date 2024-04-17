<?php
function buscarNomeNoBanco()
{
    // Substitua essas informações com os dados do seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pessoas";

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para buscar um nome no banco de dados
    $sql = "SELECT nome FROM nomes LIMIT 1";
    $result = $conn->query($sql);

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Obtém o nome do resultado da consulta
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
    } else {
        $nome = "Nome não encontrado";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();

    return $nome;
}

// Exemplo de uso da função para buscar um nome e exibir em um input
$nome = buscarNomeNoBanco();



function inserirNomeNoBanco($nome)
{
    // Substitua essas informações com os dados do seu banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pessoas";

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para inserir o nome
    $sql = "INSERT INTO nomes (nome) VALUES ('$nome')";

    // Executa a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Nome inserido com sucesso no banco de dados";
    } else {
        echo "Erro ao inserir nome no banco de dados: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o nome do formulário
    $nome = $_POST["nome"];

    // Chama a função para inserir o nome no banco de dados
    inserirNomeNoBanco($nome);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de Input com Nome do Banco de Dados</title>
</head>

<body>


    <h2>Formulário de Inserção de Nome</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">
        <button type="submit">Inserir</button>
    </form>


    <input type="text" value="<?php echo $nome; ?>" readonly>
</body>

</html>