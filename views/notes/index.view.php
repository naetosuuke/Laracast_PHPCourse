<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navs.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>


  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <ul>
      <?php foreach ($notes as $note): // DBから取得した内容?> 
      <li>
        <a href="/note?id=<?= $note['id']; //idキーを取得して、URLに組み込む(note?id=X)?>" class="text-blue-500 hover:underline"> 
        <?= htmlspecialchars($note['body']);  //htmlタグを適用せず、平文として表示させる(スクリプト攻撃などを回避)
        ?>
        </a>
        </li>
      <?php endforeach; ?>
      </ul>

      <p class="mt-6">
          <a href="/notes/create" class="text-blue-500 hover:underline">Create Note</a>
  </main>
  
  <?php require base_path('views/partials/footer.php'); ?>