<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container my-2">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email"
                   type="email"
                   class="form-control"
                   id="email"
                   placeholder="Email"
                   value="<?= htmlspecialchars($email ?? '') ?>"
                   autofocus
                   required
                   autocomplete="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password"
                   type="password"
                   class="form-control"
                   id="password"
                   placeholder="Password"
                   required
                   autocomplete="current-password">
        </div>
        <button class="btn btn-primary">Login</button>
    </form>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>