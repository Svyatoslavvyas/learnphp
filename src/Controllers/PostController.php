<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController
{
        public function __construct()
    {
        if(!auth()){
            redirect('/login');
            die;
        }
    }

    public function index()
    {
        $posts = Post::all();
        view('posts/index', compact('posts'));
    }

    public function create() {
        view('posts/create');
    }

    public function store() {
        $images = $_FILES['image'] ?? null;
        if (isset($images['name']) && is_array($images['name'])) {
            $uploadsDir = __DIR__ . '/../../public/uploads/';
            foreach ($images['name'] as $index => $originalName) {
                if (($images['error'][$index] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
                    continue;
                }

                $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $temporaryFile = $images['tmp_name'][$index] ?? '';
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)
                    || $temporaryFile === ''
                    || getimagesize($temporaryFile) === false
                ) {
                    continue;
                }

                $fileName = bin2hex(random_bytes(16)) . '.' . $extension;
                move_uploaded_file($temporaryFile, $uploadsDir . $fileName);
            }
        }
        $post = new Post();
        $post->title = trim($_POST['title'] ?? '');
        $post->body = trim($_POST['body'] ?? '');
        $post->save();
        redirect('/posts');
    }

    public function view() {
        $post = $this->findPost();
        if (!$post) {
            return;
        }
        view('posts/view', compact('post'));
    }

    public function edit(){
        $post = $this->findPost();
        if (!$post) {
            return;
        }
        view('posts/edit', compact('post'));
    }

    public function update() {
        $post = $this->findPost();
        if (!$post) {
            return;
        }
        $post->title = $_POST['title'];
        $post->body = $_POST['body'];
        $post->save();
        redirect('/posts');
    }

    public function destroy(){
        $post = $this->findPost();
        if (!$post) {
            return;
        }
        $post->delete();
        redirect('/posts');
    }

    private function findPost()
    {
        $value = $_GET['id'] ?? null;
        $id = is_scalar($value) ? filter_var($value, FILTER_VALIDATE_INT) : false;
        $post = $id === false ? null : Post::find($id);
        if (!$post) {
            http_response_code(404);
            echo 'Post not found.';
        }
        return $post;
    }
}