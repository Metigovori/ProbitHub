<?php


use Admin\Models\Prompt;

require './admin/Bootstrap.php';
require_once './admin/autoloader.php';

include "./inc/header.php";

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

if ($category_id) {
  $prompts = Prompt::where('category_id', $category_id)->with('user')->with('likes')->get();
} else {
  $prompts = Prompt::with('user')->get();
}


?>

<section class="feed " id="feed">
  <div class="container d-flex align-items-center justify-content-center  w-50 vh-75 mt-5 mb-5">
    <div class="text-center mb-5">
      <h1 class="mb-4 gradient-text">Discover &amp; Share</h1>
      <h3 class="mb-4 gradient-p">AI-Powered Prompts</h3>
      <input type="text" class="search-bar" id="search_bar" name="search">
      <p class="lead ">ProbitHub is an open-source AI prompting tool for the modern world to discover, create, and share creative prompts.</p>
    </div>
</section>

<div class="container">
  <div class="row">
    <?php foreach ($prompts as $prompt) : ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
          <img src="uploads/<?php echo  $prompt->user->photo; ?>" alt="Profile Photo" class="img-fluid rounded-circle mb-3 m-2" style="max-width: 50px;">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo $prompt->title; ?></h5>
            <p class="card-text"><?php echo $prompt->description; ?></p>
            <p class="card-text"><b>tags:</b><?php echo $prompt->tags; ?></p>
            <button class="btn btn-primary copy-button rounded-pill">Copy</button>
            <!-- Buttons section -->
            <div class="d-flex justify-content-between align-items-center">
              <a href="./comment.php?prompt_id=<?php echo $prompt->id; ?>" class="comment-button">
                <button class="coment-btn rounded-pill comment-button">Comment</button>
              </a>
              <button class="like-btn" name="like_btn" data-prompt-id="<?php echo $prompt->id; ?>">
                <span class="leftContainer">
                  <svg fill="white" viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"></path>
                  </svg>
                  <span class="like">Like</span>
                </span>
                <span class="likeCount">
                  <?php echo $prompt->likes()->count(); ?>
                </span>
              </button>
            </div>
            <!-- End of buttons section -->
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $(".like-btn").click(function() {
      var promptId = $(this).data("prompt-id");
      var likeCountElement = $(this).find(".likeCount");

      $.ajax({
        type: "POST",
        url: "handle_like.php",
        data: {
          promptId: promptId
        },
        success: function(response) {
          // Update the like count on the button
          var data = JSON.parse(response);
          var likeCount = parseInt(data.likeCount);
          likeCountElement.text(likeCount);
        }
      });
    });
  });
</script>

</body>

</html>