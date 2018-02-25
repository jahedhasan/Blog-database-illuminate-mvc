<?php 
require 'partials/header.php';
use Carbon\Carbon;
$categories = Category::all();
$message = '';
$old_values = [];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $category = $_POST['category'];
  $old_values = [
    "category" => $category
  ];
  if (strlen($category) < 4) {
    $errors['category'] = "title shouldn't be less than 4 character";
  }
  if (empty($errors)) {
    Category::insert([
      'name' => $category,
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ]);
    $categories = Category::all();
    $message = 'Category created successfully';
  }
}
?>

<div class="container">
  <div class="p-5 bg-warning">
    <h2>All categories</h2>
    <form method="post">
      <?php if (!empty($message)): ?>
        <div class="alert alert-success">
          <h2><?php echo $message; ?></h2>
        </div>
      <?php endif ?>
      <div class="input-group">
        <input type="text" name="category" class="form-control" placeholder="add a category">
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary">add a new category</button>
        </div>
      </div>
    </form>
  </div>
  <div>
    <ul class="list-group">
      <?php foreach ($categories as $category): ?>
        <li class="list-group-item my-2">
          <?php echo $category->name ?>
            <a class="btn btn-outline-primary ml-3" href="/dashboard/category/update?id=<?php echo $category->id ?>">Edit</a>
            <a onclick="return confirm('Are you really want to delete this entry?')" class="btn btn-outline-primary" href="/dashboard/category/delete?id=<?php echo $category->id ?>">Delete</a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
<?php require 'partials/footer.php'; ?>