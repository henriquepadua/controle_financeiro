<?php
// Incluir o arquivo de configuração do banco de dados
include 'db.php';

// Função para obter todas as empresas
function getEmpresas($conn) {
    // SQL para selecionar todas as empresas
    $sql = "SELECT * FROM tbl_empresa";
    // Executar a consulta e retornar os resultados
    $result = $conn->query($sql);
    return $result;
}

// Função para adicionar uma conta a pagar
function addConta($conn, $valor, $data_pagar, $id_empresa) {
    // SQL para inserir uma nova conta a pagar
    $sql = "INSERT INTO tbl_conta_pagar (valor, data_pagar, pago, id_empresa) VALUES (?, ?, 0, ?)";
    // Preparar a instrução SQL
    $stmt = $conn->prepare($sql);
    // Vincular os parâmetros (valor, data_pagar, id_empresa)
    $stmt->bind_param("dsi", $valor, $data_pagar, $id_empresa);
    // Executar a instrução SQL e retornar o resultado
    return $stmt->execute();
}

// Função para obter todas as contas a pagar
function getContas($conn) {
    // SQL para selecionar todas as contas a pagar junto com o nome da empresa
    $sql = "SELECT c.*, e.nome FROM tbl_conta_pagar c JOIN tbl_empresa e ON c.id_empresa = e.id_empresa";
    // Executar a consulta e retornar os resultados
    $result = $conn->query($sql);
    return $result;
}

// Função para atualizar uma conta a pagar
function updateConta($conn, $id_conta_pagar, $valor, $data_pagar, $id_empresa) {
    // SQL para atualizar uma conta a pagar
    $sql = "UPDATE tbl_conta_pagar SET valor = ?, data_pagar = ?, id_empresa = ? WHERE id_conta_pagar = ?";
    // Preparar a instrução SQL
    $stmt = $conn->prepare($sql);
    // Vincular os parâmetros (valor, data_pagar, id_empresa, id_conta_pagar)
    $stmt->bind_param("dsii", $valor, $data_pagar, $id_empresa, $id_conta_pagar);
    // Executar a instrução SQL e retornar o resultado
    return $stmt->execute();
}

// Função para excluir uma conta a pagar
function deleteConta($conn, $id_conta_pagar) {
    // SQL para excluir uma conta a pagar
    $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar = ?";
    // Preparar a instrução SQL
    $stmt = $conn->prepare($sql);
    // Vincular o parâmetro (id_conta_pagar)
    $stmt->bind_param("i", $id_conta_pagar);
    // Executar a instrução SQL e retornar o resultado
    return $stmt->execute();
}

// Função para marcar uma conta como paga
function markAsPaid($conn, $id_conta_pagar) {
    // SQL para marcar uma conta como paga
    $sql = "UPDATE tbl_conta_pagar SET pago = 1 WHERE id_conta_pagar = ?";
    // Preparar a instrução SQL
    $stmt = $conn->prepare($sql);
    // Vincular o parâmetro (id_conta_pagar)
    $stmt->bind_param("i", $id_conta_pagar);
    // Executar a instrução SQL e retornar o resultado
    return $stmt->execute();
}
?>