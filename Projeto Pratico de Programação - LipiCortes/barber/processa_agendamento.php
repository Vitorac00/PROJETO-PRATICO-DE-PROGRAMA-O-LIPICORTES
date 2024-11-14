<?php
$conn = new mysqli("localhost", "root", "", "SalaoBeleza");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$cliente_nome = $_POST['cliente_nome'];
$cliente_telefone = $_POST['cliente_telefone'];
$cliente_email = $_POST['cliente_email'];
$barbeiro_id = $_POST['barbeiro'];
$servico_id = $_POST['servico'];
$data_hora = $_POST['data_hora'];
$observacoes = $_POST['observacoes'];

$sql_cliente = "INSERT INTO Clientes (nome, telefone, email) VALUES ('$cliente_nome', '$cliente_telefone', '$cliente_email')";
if ($conn->query($sql_cliente) === TRUE) {
    $cliente_id = $conn->insert_id;
    $sql_agendamento = "INSERT INTO Agendamentos (cliente_id, barbeiro_id, servico_id, data_hora, observacoes) 
                        VALUES ('$cliente_id', '$barbeiro_id', '$servico_id', '$data_hora', '$observacoes')";

    if ($conn->query($sql_agendamento) === TRUE) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao agendar: " . $conn->error;
    }
} else {
    echo "Erro ao cadastrar cliente: " . $conn->error;
}

$conn->close();
?>