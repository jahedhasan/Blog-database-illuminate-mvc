<?php
$posts = Post::all();
require 'partials/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">

    <?php foreach($posts as $post): ?>
      <?php require 'partials/post_chunk.php'; ?>
    <?php endforeach; ?>

    </div>
    <div class="col-md-4">
      <?php require 'partials/sidebar.php'; ?>
    </div>
  </div>
</div>
<?php require 'partials/footer.php'; ?>