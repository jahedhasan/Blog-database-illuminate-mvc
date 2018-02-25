<?php
require 'partials/header.php';
$id = $_GET['id'];
$post = Post::find($id);
$post->delete();
header('location: /dashboard/post?delete=true');
?>
<?php require 'partials/footer.php'; ?>