<?php
// Incluir o arquivo de funções
include 'functions.php';

// Verificar se a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se a ação é para adicionar uma conta
    if (isset($_POST['add'])) {
        // Obter os valores do formulário
        $valor = $_POST['valor'];
        $data_pagar = $_POST['data_pagar'];
        $id_empresa = $_POST['id_empresa'];
        // Adicionar a conta a pagar
        addConta($conn, $valor, $data_pagar, $id_empresa);
    } elseif (isset($_POST['edit'])) {
        // Lógica para editar uma conta (não implementada aqui)
    } elseif (isset($_POST['delete'])) {
        // Obter o ID da conta a ser excluída
        $id_conta_pagar = $_POST['id_conta_pagar'];
        // Excluir a conta a pagar
        deleteConta($conn, $id_conta_pagar);
    } elseif (isset($_POST['mark_paid'])) {
        // Obter o ID da conta a ser marcada como paga
        $id_conta_pagar = $_POST['id_conta_pagar'];
        // Marcar a conta como paga
        markAsPaid($conn, $id_conta_pagar);
    }
}

// Obter todas as empresas
$empresas = getEmpresas($conn);
// Obter todas as contas a pagar
$contas = getContas($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Controle Financeiro de Contas a Pagar</title>
</head>
<body>

<h2>Adicionar Conta a Pagar</h2>
<form method="POST">
    <label for="empresa">Empresa:</label>
    <select name="id_empresa" id="empresa" required>
        <!-- Loop através das empresas e criar opções para o select -->
        <?php while($row = $empresas->fetch_assoc()): ?>
            <option value="<?php echo $row['id_empresa']; ?>"><?php echo $row['nome']; ?></option>
        <?php endwhile; ?>
    </select><br>

    <label for="data_pagar">Data a ser paga:</label>
    <input type="date" name="data_pagar" id="data_pagar" required><br>

    <label for="valor">Valor:</label>
    <input type="number" step="0.01" name="valor" id="valor" required><br>

    <button type="submit" name="add">Inserir</button>
</form>

<h2>Contas a Pagar</h2>
<table border="1">
    <thead>
        <tr>
            <th>Empresa</th>
            <th>Valor</th>
            <th>Data a Pagar</th>
            <th>Pago</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop através das contas a pagar e criar linhas na tabela -->
        <?php while($row = $contas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                <td><?php echo $row['data_pagar']; ?></td>
                <td><?php echo $row['pago'] ? 'Sim' : 'Não'; ?></td>
                <td>
                    <!-- Formulário para editar uma conta -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id_conta_pagar" value="<?php echo $row['id_conta_pagar']; ?>">
                        <button type="submit" name="edit">Editar</button>
                    </form>
                    <!-- Formulário para excluir uma conta -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id_conta_pagar" value="<?php echo $row['id_conta_pagar']; ?>">
                        <button type="submit" name="delete">Excluir</button>
                    </form>
                    <!-- Formulário para marcar uma conta como paga -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id_conta_pagar" value="<?php echo $row['id_conta_pagar']; ?>">
                        <button type="submit" name="mark_paid">Marcar como Paga</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
