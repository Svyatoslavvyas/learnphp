<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container">
    <a class="btn btn-primary" href="/users/create">Add User</a>
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th style="width:260px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="User actions">
                        <a class="btn btn-info" href="/users/view?id=<?= $user->id ?>">View</a>
                        <a class="btn btn-warning" href="/users/edit?id=<?= $user->id ?>">Edit</a>
                        <a class="btn btn-danger" href="/users/delete?id=<?= $user->id ?>">Delete</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>