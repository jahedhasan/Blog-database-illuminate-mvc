<?php
require 'partials/header.php';
$errors = [];
$old_values = [
  'email' => '',
  'password' => '',
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $old_values = [
    'email' => $email,
    'password' => $password,
  ];
  if (!is_email_taken($email)) {
    $errors['email'] = "email address not found in database";
  }
  if (empty($errors)) {
    $user = User::where('email', $email)->first();
    if (password_verify($password, $user->password)) {
      $_SESSION['user'] = $user;
      header('Location: /');
    } else {
      $errors['password'] = "password not matching with database";
    }
  }
}
?>

<div class="row">
  <div class="col-md-6 mx-auto px-2 my-5">
      <div class="card">
        <div class="card-header">
          <h2>Login</h2>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?php echo $old_values['email'] ?>" type="text" name="email" id="email" class="form-control">
              <?php if (isset($errors['email'])): ?>
                <p class="text-danger"><?php echo $errors['email'] ?></p>
              <?php endif ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input value="<?php echo $old_values['password'] ?>"  type="password" name="password" id="password" class="form-control">
              <?php if (isset($errors['password'])): ?>
                <p class="text-danger"><?php echo $errors['password'] ?></p>
              <?php endif ?>
            </div>
            <div class="form-group">
              <p>
                don't have account? <a href="/register">Register here</a>
              </p>
              <button class="btn btn-outline-primary" type="submit">Login</button>
            </div>
            
          </form>
        </div>
      </div>
  </div>
</div>

<?php require 'partials/footer.php'; ?>