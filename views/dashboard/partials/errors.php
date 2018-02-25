  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger p-3">
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach ?>
    </div>
<?php endif ?>