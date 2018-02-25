<?php
$id = $_GET['id'] ?? 1;
$post = Post::find($id);
require 'partials/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">

      <div class="card my-3">
        <div class="card-body">
          <h2>
            <a href="/post?id=<?= $post->id ?>"><?php echo $post->title ?></a>
          </h2>
          <p>by <a href="/author?id=<?= $post->user->id ?>"><?php echo $post->user->name ?></a> <span class="text-muted"><?php echo $post->created_at->diffForHumans() ?></span></p>
          <div>
            <?php echo $post->content; ?>
          </div>
        </div>
      </div>

      <h4 class="my-3 text-info">All comments </h4>

      <?php foreach ($post->comments as $comment): ?>
        <div class="card my-3">
          <div class="card-body">
            <p>`<?= $comment->name ?>` said <span class="text-muted"><?= $comment->created_at->diffForHumans(); ?></span></p>
            <hr>
            <p><?= $comment->text; ?></p>
          </div>
        </div>
        
      <?php endforeach ?>



    </div>
    <div class="col-md-4">
      <?php require 'partials/sidebar.php'; ?>
    </div>
  </div>
</div>
<?php require 'partials/footer.php'; ?>