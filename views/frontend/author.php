<?php
$id = $_GET['id'] ?? 1;
$user = User::find($id);
require 'partials/header.php';
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="bg-info p-5 my-3 text-white">
        <h2>
          All posts by <?php echo $user->name; ?>
        </h2>
      </div>
      <?php foreach($user->posts as $post): ?>
        <?php require 'partials/post_chunk.php'; ?>
    <?php endforeach; ?>

    </div>
    <div class="col-md-4">
      <?php require 'partials/sidebar.php'; ?>
    </div>
  </div>
</div>
<?php require 'partials/footer.php'; ?>