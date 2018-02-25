<?php 
require 'partials/header.php';
use Carbon\Carbon;
$id = $_GET['id'] ?? 1;
$category = Category::find($id);
$message = '';
$old_values = [
  'category' => $category->name
];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $category_name = $_POST['category'];
  $old_values = [
    "category" => $category_name
  ];
  if (strlen($category) < 4) {
    $errors['category'] = "category shouldn't be less than 4 character";
  }
  if (empty($errors)) {
    $category->name = $category_name;
    $category->updated_at = Carbon::now()->format('Y-m-d H:i:s');
    $category->save();
    header('location: /dashboard/category');
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
        <input value="<?php echo $old_values['category'] ?>" type="text" name="category" class="form-control" placeholder="add a category">
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary">update category</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require 'partials/footer.php'; ?>