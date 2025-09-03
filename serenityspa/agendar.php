<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Agendamento - SPA Serenity</title>
</head>
<body>

<h1>Agendamento de Sessão</h1>

<?php if (isset($_SESSION['mensagem'])): ?>
  <p><?= $_SESSION['mensagem'] ?></p>
  <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>

<form action="processa_agendamento.php" method="POST">
  <label>Nome: <input type="text" name="nome" required></label><br>
  <label>Email: <input type="email" name="email" required></label><br>
  <label>Telefone: <input type="text" name="telefone" required></label><br>
  <label>Serviço:
    <select name="servico" required>
      <option value="">Escolha...</option>
      <option value="Aromaterapia">Aromaterapia</option>
      <option value="Shiatsu">Shiatsu</option>
    </select>
  </label><br>
  <label>Data: <input type="date" name="data" required></label><br>
  <label>Hora: <input type="time" name="hora" required></label><br>
  <label>Observações: <textarea name="obs"></textarea></label><br>
  <button type="submit">Enviar</button>
</form>

</body>
</html>
