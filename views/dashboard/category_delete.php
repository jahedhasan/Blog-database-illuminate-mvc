
<?php
require 'partials/header.php';
$id = $_GET['id'];
$category = Category::find($id);
$category->delete();
header('location: /dashboard/category?delete=true');
?>
<?php require 'partials/footer.php'; ?>