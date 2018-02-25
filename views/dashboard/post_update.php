<?php 
$id = $_GET['id'] ?? 1;
require 'partials/header.php';
use Carbon\Carbon;
$categories = Category::all();
$post = Post::find($id);
$message = '';
$old_values = [
  'title' => $post->title,
  'content' => $post->content,
  'category' => $post->category_id,
];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $old_values = [
    "title" => $title,
    "content" => $content,
    'category' => $category
  ];
  if (strlen($title) < 10) {
    $errors['title'] = "title shouldn't be less than 10 character";
  }
  if (strlen($content) < 20) {
    $errors['content'] = "content shouldn't be less than 20 character";
  }
  if (empty($errors)) {
    $post->title = $title;
    $post->content = $content;
    $post->category_id = $category;
    $post->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    $post->save();
    $message = 'Your post updated successfully.';
  }
}
 ?>
<div class="container">
  <div class="p-5 text-center my-3 bg-danger text-white">
    <h2>Create a post</h2>
  </div>

  <form method="post">
    <?php if (!empty($message)): ?>
      <div class="alert alert-success">
        <h2><?php echo $message; ?></h2>
      </div>
    <?php endif ?>
    <div class="form-group">
        <label for="title">Title</label>
        <input value="<?php echo $old_values['title'] ?>" type="text" name="title" id="title" class="form-control">
        <?php if (isset($errors['title'])): ?>
          <p class="text-danger"><?php echo $errors['title'] ?></p>
        <?php endif ?>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select name="category" id="category" class="form-control">
        <?php foreach ($categories as $category): ?>
          <option
            value="<?php echo $category->id ?>"
            <?php echo $category->id == $old_values['category'] ? 'selected' : '' ?>
            >
            <?php echo $category->name ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo $old_values['content'] ?></textarea>
      <?php if (isset($errors['content'])): ?>
        <p class="text-danger"><?php echo $errors['content'] ?></p>
      <?php endif ?>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-outline-info">create a post</button>
    </div>
    
  </form>
</div>
<?php require 'partials/footer.php'; ?>