  <div class="card my-3">
        <div class="card-body">
          <h2>
            <a href="/post?id=<?= $post->id ?>"><?php echo $post->title ?></a>
          </h2>
          <p>by <a href="/author?id=<?= $post->user->id ?>"><?php echo $post->user->name ?></a> <span class="text-muted"><?php echo $post->created_at->diffForHumans() ?></span></p>
          <div>
            <?php echo substr($post->content, 0, 200); ?>...
          </div>
          <a href="/post?id=<?= $post->id ?>" class="btn btn-outline-info mt-2">read more</a>
        </div>
</div>