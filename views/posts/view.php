<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container">
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <td><?= (int) $post->id ?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><?= htmlspecialchars($post->title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>Content</th>
                <td><?= htmlspecialchars($post->body, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
            </tr>
        </tbody>
    </table>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>