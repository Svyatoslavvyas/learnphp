<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container my-2">
    <form action="/users/edit?id=<?= $user->id ?>" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?= htmlspecialchars($user->email) ?>" name="email" type="email" class="form-control" id="email" placeholder="user@example.com" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Leave blank to keep unchanged">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>