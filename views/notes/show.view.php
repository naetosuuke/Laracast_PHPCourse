<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navs.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <p class="mb-6"> <!--mergin bottom--> 
      <a href="/notes" class="text-blue-500 underline">go back...</a>
    </p>
    <p>
      <?= htmlspecialchars($note['body']);
      //htmlspecialcharsメソッドに入れることで、htmlタグを適用せず、平文として表示させる　
      ?></p>

    <footer class="mt-6">
        <a href="note/edit?id=<?= $note['id']; ?>" 
          class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
          Edit
      </a>
    </footer>

    <form class="mt-6" method="POST">                        <!-- 削除ボタン　_method => DELETE, id => id情報　をPOSTで返している-->
      <input type="hidden" name="_method" value="DELETE"> 
      <input type="hidden" name="id" value="<?= $note['id']?>">
      <button class="text-sm text-red-500">Delete</button>
    </form> 
      

  </main>
  <?php require base_path('views/partials/footer.php'); ?>