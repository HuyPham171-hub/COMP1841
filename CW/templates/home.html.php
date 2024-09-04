<?php foreach ($posts as $post): ?>
  <div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-9 mb-3">

      <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
        <div class="row align-items-center">
          <div class="col-md-8 mb-3 mb-sm-0">
            <h5>
              <a href="/COMP1841/CW/pages/posts.php?post_id=<?=$post['post_id']?>" class="text-primary"><?=htmlspecialchars($post['title'], ENT_QUOTES,'UTF-8')?></a>
            </h5>
            <p class="text-sm">
              <div>Posted <?= htmlspecialchars($post['created_at']) ?></div>
              <span class="op-6">by</span> 
              <a class="text-black" href="#"><?=htmlspecialchars($post['username'], ENT_QUOTES,'UTF-8')?></a>
            </p>
            <div class="text-sm op-5"> 
              <a class="text-black mr-2" href="#"><?=htmlspecialchars($post['module_name'], ENT_QUOTES,'UTF-8')?></a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php endforeach; ?>