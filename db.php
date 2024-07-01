<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor (localhost para uma configuração local)
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do usuário do MySQL (deixe vazio se não houver senha)
$dbname = "controle_financeiro"; // Nome do banco de dados

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    // Se houver erro, exibir a mensagem de erro e encerrar o script
    die("Erro na conexão: " . $conn->connect_error);
}
?>