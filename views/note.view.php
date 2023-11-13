<?php require 'partials/head.php'; ?>

<?php require 'partials/navs.php'; ?>

<?php require 'partials/banner.php'; ?>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <p class="mb-6"> <!--mergin bottom--> 
      <a href="/notes" class="text-blue-500 underline">go back...</a>
    </p>
    <p>
      <?= htmlspecialchars($note['body']);
      //htmlspecialcharsメソッドに入れることで、htmlタグを適用せず、平文として表示させる　
      //そうしないとデータにHTMLタグを仕込まれ、デカ文字やJS呼び出しを食らうことになる
      //example... <h1 style="font-size:100px">Ah ah ah...</h1><script>alert('Hi FROM JS')</script>
      ?>
    </p> 
  </main>
<?php require 'partials/footer.php'; ?>