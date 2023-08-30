<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Admin\Models\Prompt;
use Admin\Models\Category;


require_once './admin/autoloader.php';

include "./inc/header.php";




if (isset($_POST['create_post'])) {
  $userId = $_GET['user_id'];
  $prompt = new Prompt();
  $prompt->title = $_POST['title'];
  $prompt->description = $_POST['description'];
  $prompt->tags = $_POST['tags'];
  $prompt->category_id = $_POST['category'];
  $prompt->user_id = $userId;
  $prompt->save();
  header('Location: index.php');
}

$categories = Category::all();
?>

<div class="container mt-5">
  <div class="row pt-5">
    <div class="col-lg-6">
      <!-- Left Section -->
      <h3 class="mb-4 gradient-text">Krijo Post</h3>
      <p class="position-relative">Vendos nje titull qe tregon temen per pyetjen e bere</p>
    </div>
    <div class="col-lg-6">
      <!-- Right Section -->
      <div class="card">
        <div class="card-body">
          <form action="" method="post">
            <div class="mb-3">
              <div class="form-control">
                <input type="text" required="" name="title" id="title">
                <label>
                  <span style="transition-delay:0ms">T</span><span style="transition-delay:50ms">i</span><span style="transition-delay:100ms">t</span><span style="transition-delay:150ms">u</span><span style="transition-delay:200ms">l</span><span style="transition-delay:250ms">l</span><span style="transition-delay:300ms">i</span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-control">
                <input type="value" required="" name="description" id="description">
                <label>
                  <span style="transition-delay:0ms">D</span><span style="transition-delay:50ms">e</span><span style="transition-delay:100ms">s</span><span style="transition-delay:150ms">c</span><span style="transition-delay:200ms">r</span><span style="transition-delay:250ms">i</span><span style="transition-delay:300ms">p</span><span style="transition-delay:350ms">t</span><span style="transition-delay:400ms">i</span><span style="transition-delay:450ms">o</span><span style="transition-delay:500ms">n</span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-control">
                <input type="text" required="" name="tags">
                <label>
                  <span style="transition-delay:0ms">T</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">g</span><span style="transition-delay:150ms">#</span>
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Select Category</label>
              <select class="form-select" id="category" name="category">
                <?php foreach ($categories as $category) : ?>
                  <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="create_post">Create</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>