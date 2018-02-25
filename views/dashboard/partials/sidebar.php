<?php 
$categories = Category::all();
$users = User::all();
 ?>
      <div class="card mt-3">
        <div class="card-body">
          <h2>All authors</h2>
          <ul class="list-group">
            <?php foreach ($users as $user): ?>
              <li class="list-group-item mb-2">
                <a href="/author?id=<?= $user->id ?>">
                  <?= $user->name ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
      <div class="card my-3">
        <div class="card-body">
          <h2>All Category</h2>
          <ul class="list-group">
            <?php foreach ($categories as $category): ?>
              <li class="list-group-item mb-2">
                <a href="/category?id=<?= $category->id ?>"><?= $category->name ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
