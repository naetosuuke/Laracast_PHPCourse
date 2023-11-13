<?php require 'partials/head.php'; ?>

<?php require 'partials/navs.php'; ?>

<?php require 'partials/banner.php'; ?>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <ul>
      <?php foreach ($notes as $note): // DBから取得した内容?> 
      <li>
        <a href="/note?id=<?= $note['id']; //idキーを取得して、URLに組み込む(note?id=X)?>" class="text-blue-500 hover:underline"> 
        <?= htmlspecialchars($note['body']);
        //htmlspecialcharsメソッドに入れることで、htmlタグを適用せず、平文として表示させる　
        //そうしないとデータにHTMLタグを仕込まれ、デカ文字やJS呼び出しを食らうことになる
        //example... <h1 style="font-size:100px">Ah ah ah...</h1><script>alert('Hi FROM JS')</script>
        ?>
        </a>
        </li>
      <?php endforeach; ?>
      </ul>

      <p class="mt-6">
          <a href="/notes/create" class="text-blue-500 hover:underline">Create Note</a>
  </main>
  
<?php require 'partials/footer.php'; ?>