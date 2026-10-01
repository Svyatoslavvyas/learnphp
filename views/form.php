<?php include __DIR__ . '/partials/header.php'; ?>
  <main class="container">
    <?php if($name !== '' && $age !== ''): ?>
      <h1>Hello <?=htmlspecialchars($name)?>! You are <?=htmlspecialchars((string) $age)?> years old!</h1>
    <?php endif ?>
    <form action="/answer?name=green&age=rock" method="POST">
      <input name="name" placeholder="Name">
      <input name="age" placeholder="Age">
      <button>Send</button>
      <input type="submit">
    </form>
  </main>
<?php include __DIR__ . '/partials/footer.php'; ?>