<?php

$success = "";
$error = "";

$to = "seuemail@dominio.com"; 
$subject = "Novo Agendamento - SPA Serenity";


if($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $telefone = htmlspecialchars(trim($_POST["telefone"]));
    $servico = htmlspecialchars(trim($_POST["servico"]));
    $data = htmlspecialchars($_POST["data"]);
    $hora = htmlspecialchars($_POST["hora"]);
    $obs = htmlspecialchars(trim($_POST["obs"]));

   
    if(empty($nome) || empty($email) || empty($telefone) || empty($data) || empty($hora) || empty($servico)){
        $error = "Por favor, preencha todos os campos obrigatórios!";
    } else {
        
        $arquivo = fopen("agendamentos.csv", "a");
        if($arquivo){
            fputcsv($arquivo, [$nome, $email, $telefone, $servico, $data, $hora, $obs]);
            fclose($arquivo);

            
            $message = "Novo agendamento recebido:\n\n";
            $message .= "Nome: $nome\n";
            $message .= "Email: $email\n";
            $message .= "Telefone: $telefone\n";
            $message .= "Serviço: $servico\n";
            $message .= "Data: $data\n";
            $message .= "Hora: $hora\n";
            $message .= "Observações: $obs\n";

            
            $headers = "From: $email" . "\r\n" .
                       "Reply-To: $email" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            
            if(mail($to, $subject, $message, $headers)){
                $success = "Agendamento realizado com sucesso! Você receberá uma confirmação por email.";
            } else {
                $error = "Agendamento salvo, mas não foi possível enviar o email.";
            }
        } else {
            $error = "Não foi possível salvar o agendamento. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SPA Serenity - Agendar</title>
<link rel="icon" href="Serenity.jpeg" type="image/png">
<link rel="stylesheet" href="style_agendar.css">
</head>
<body>

<header>
  <div class="logo">
      <img src="Serenity.jpeg" alt="Logo Serenity" class="logo-img">
      SPA Serenity
  </div>
  <nav>
    <a href="index.html">Início</a>
    <a href="sobre.html">Sobre</a>
    <a href="servicos.html">Serviços</a>
    <a href="organograma.html">Organograma</a>
    <a href="modelo.html">Modelo</a>
    <a href="processos.html">Processos</a>
    <a href="requisitos.html">Requisitos</a>
    <a href="agendar.php" class="active">Agendar</a>
  </nav>
</header>

<section class="hero">
  <h1>Agende sua Sessão</h1>
  <p>Escolha a data e horário que deseja se cuidar e relaxar conosco.</p>
</section>

<main>
  <section class="info">
    <div class="info-card">

      <?php if($success): ?>
        <p class="msg success"><?= $success ?></p>
      <?php elseif($error): ?>
        <p class="msg error"><?= $error ?></p>
      <?php endif; ?>

      <form action="agendar.php" method="POST">
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Telefone</label>
        <input type="tel" name="telefone" placeholder="(11) 99999-9999" required>

        <label>Serviço</label>
        <select name="servico" required>
          <option value="">Selecione...</option>
          <option value="Aromaterapia">Aromaterapia</option>
          <option value="Pedras quentes">Massagem com pedras quentes</option>
          <option value="Shiatsu">Shiatsu</option>
          <option value="Ventosa">Com ventosa</option>
          <option value="Sueca">Sueca</option>
          <option value="Desportiva">Desportiva</option>
          <option value="Esfoliação">Esfoliação completa</option>
          <option value="Envoltório">Envoltório (argilas/chocolates/algas)</option>
          <option value="Limpeza de pele">Limpeza de pele</option>
          <option value="Hidratação facial">Hidratação facial</option>
          <option value="Massagem facial">Massagem facial</option>
          <option value="Sauna">Sauna</option>
          <option value="Pacote">Pacote</option>
          <option value="Banho de sais">Banho com sais</option>
        </select>

        <label>Data</label>
        <input type="date" name="data" required>

        <label>Hora</label>
        <input type="time" name="hora" required>

        <label>Observações</label>
        <textarea name="obs" rows="4" placeholder="Alergias ou restrições"></textarea>

        <button type="submit" class="btn">Enviar Agendamento</button>
      </form>
    </div>
  </section>
</main>

<footer>
  <p>© 2025 SPA Serenity - Todos os direitos reservados</p>
</footer>

</body>
</html>
