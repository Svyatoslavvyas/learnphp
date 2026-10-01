<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container my-2">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="/register" method="POST">
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
                   autocomplete="new-password">
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Password Confirm</label>
            <input name="password_confirm"
                   type="password"
                   class="form-control"
                   id="password_confirm"
                   placeholder="Password Confirm"
                   required
                   autocomplete="new-password">
        </div>
        <button class="btn btn-primary">Register</button>
    </form>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>