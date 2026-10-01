<?php include __DIR__ . '/../partials/header.php'; ?>
<main class="container my-2">
    <form action="/posts/edit?id=<?= (int) $post->id ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input value="<?= htmlspecialchars($post->title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" name="title" type="text" class="form-control" id="title" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea 
                name="body"
                class="form-control"
                id="body"
                rows="12"
                placeholder="Write something cool..."><?= htmlspecialchars($post->body, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></textarea>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</main>
<?php include __DIR__ . '/../partials/footer.php'; ?>