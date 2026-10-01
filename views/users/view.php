<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container">
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <td><?= $user->id ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($user->email) ?></td>
            </tr>
        </tbody>
    </table>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>