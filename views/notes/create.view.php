<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navs.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
<!--
  This example requires some changes to your config:
  ```
  ```
-->
<form action method="POST"> <!--formタグ actionにデータ送信先のディレクトリを書く-->
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <div class="mt-4 grid grid-cosls-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="col-span-full">
          <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Body</label> 
          <div class="mt-2">
            <textarea id="body" name="body" rows="3" 
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            placeholder="Here's an idea for note...">
            <?= $_POST['body'] ?? ''?></textarea> 
            <!--三項子の省略形 bodyがnullなら空の文字列をtextareaに表示。-->
            <!--required 属性をタグに付与することで、空の投稿をフロント側で止める 但しコマンドのcurl等でPOSTを送られると対処できない-->
            <?php if (isset($errors['body'])) : //代わりにcontrollerクラスで空投稿の確認。エラーが発生したら、内容を表示  ?> 
            <p class="text-red-500 rext-xs mt-2"><?= $errors['body']?></p>
            <?php endif ;?>
          </div>
        </div>
      </div>
    </div>


  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>

    </div>
  </main>
  <?php require base_path('views/partials/footer.php'); ?>