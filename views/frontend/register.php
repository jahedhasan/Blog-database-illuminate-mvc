<?php
require 'partials/header.php';
$errors = [];
$old_values = [
  'name' => '',
  'email' => '',
  'password' => '',
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $old_values = [
    'name' => $name,
    'email' => $email,
    'password' => $password,
  ];
  if (strlen($name) < 4) {
    $errors['name'] = "name value can't be less than 4 character";
  }
  if (strlen($password) < 4) {
    $errors['password'] = "password value can't be less than 4 character";
  }
  if (!is_email($email)) {
    $errors['email'] = "please pass a valid email address";
  } else if (is_email_taken($email)) {
    $errors['email'] = "email address already taken";
  }
  if (empty($errors)) {
    $user = new User();
    $user->name = $name;
    $user->email = $email;
    $user->password = password_hash( $password, PASSWORD_BCRYPT);
    $user->save();
    $_SESSION['user'] = $user;
    header('Location: /');
  }
}
?>

<div class="row">
  <div class="col-md-6 mx-auto px-2 my-5">
      <div class="card">
        <div class="card-header">
          <h2>Register a New User</h2>
        </div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input value="<?php echo $old_values['name'] ?>" type="text" name="name" id="name" class="form-control">
            </div>
            <?php if (isset($errors['name'])): ?>
              <p class="text-danger"><?php echo $errors['name'] ?></p>
            <?php endif ?>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?php echo $old_values['email'] ?>" type="text" name="email" id="email" class="form-control">
            </div>
            <?php if (isset($errors['email'])): ?>
              <p class="text-danger"><?php echo $errors['email'] ?></p>
            <?php endif ?>
            <div class="form-group">
                <label for="password">Password</label>
                <input value="<?php echo $old_values['password'] ?>" type="password" name="password" id="password" class="form-control">
            </div>
            <?php if (isset($errors['password'])): ?>
              <p class="text-danger"><?php echo $errors['password'] ?></p>
            <?php endif ?>
            <div class="form-group">
              <p>
                Already have account ?<a href="/login">Login here</a>
              </p>
              <button class="btn btn-outline-primary" type="submit">Register</button>
            </div>
            
          </form>
        </div>
      </div>
  </div>
</div>

<?php require 'partials/footer.php'; ?>