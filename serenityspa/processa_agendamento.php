<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $servico = $_POST['servico'] ?? '';
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $obs = $_POST['obs'] ?? '';

    if (empty($nome) || empty($email) || empty($telefone) || empty($servico) || empty($data) || empty($hora)) {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        $linha = [$nome, $email, $telefone, $servico, $data, $hora, $obs];

        $arquivo = fopen('agendamentos.csv', 'a');
        if ($arquivo) {
            fputcsv($arquivo, $linha);
            fclose($arquivo);
            $_SESSION['mensagem'] = "Agendamento realizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao salvar o agendamento.";
        }
    }

    header("Location: agendar.php");
    exit;
}
