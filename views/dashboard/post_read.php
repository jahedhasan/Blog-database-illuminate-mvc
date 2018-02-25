<?php
require 'partials/header.php';
$user = User::find($_SESSION['user']->id);
$delete = $_GET['delete'] ?? '';
?>
<div class="container mt-5">
  <div class="p-5 bg-info text-white mb-3">
    <h2>
      All posts by <?php echo $_SESSION['user']->name ?>
    </h2>
    <a class="btn btn-danger mt-3" href="/dashboard/post/create">Create a new post</a>
  </div>
  <?php if (!empty($delete)): ?>
    <div class="alert alert-success">
      <h2>post delete successfully.</h2>
    </div>
  <?php endif ?>
  <table class="table table-bordered">
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Action</th>
    </tr>
    <?php foreach ($user->posts as $key => $post): ?>
      <tr>
        <td><?php echo $key ?></td>
        <td><?php echo $post->title ?></td>
        <td>
          <a href="/post?id=<?php echo $post->id ?>" class="btn btn-outline-info"> <i class="fa fa-eye"></i> View</a>
          <a href="/dashboard/post/update?id=<?php echo $post->id ?>" class="btn btn-outline-primary"> <i class="fa fa-pencil"></i> Edit</a>
          <a onclick="return confirm('Are you sure you want to delete this entry')" href="/dashboard/post/delete?id=<?php echo $post->id ?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</a>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
</div>
<?php require 'partials/footer.php'; ?>