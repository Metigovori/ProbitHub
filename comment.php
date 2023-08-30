<?php

use Admin\Models\Comments;
use Admin\Models\Prompt;
use Admin\Models\User;

require_once './admin/autoloader.php';

include "./inc/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
  $comment = new Comments();
  $comment->comment_text = $_POST['comment'];

  $user_id = $_SESSION['user_id'];

  if (isset($_GET['prompt_id'])) {
    $prompt_id = $_GET['prompt_id'];
    $comment->prompt_id = $prompt_id;
    $comment->user_id = $user_id;
    $comment->save();

    header('Location: index.php');
    exit;
  } else {
    echo "There was a problem during the creation of comment";
  }
}

?>

<div class="container mt-5">
  <div class="row pt-5">
    <div class="col-lg-6">
      <!-- Left Section -->
      <h3 class="mb-4 gradient-text">Diskuto per pyetjet ne komente</h3>
      <p>Avanco pyetjen duke e diskutuar me te tjeret</p>
    </div>
    <div class="col-lg-6">
      <!-- Right Section -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Comment Card</h5>
          <form method="post">
            <div class="mb-3">
              <label for="comment" class="form-label">Comment:</label>
              <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container mt-5">
  <div class="row pt-5">
    <div class="col-lg-12">
      <!-- Display comments section -->
      <h4 class="mb-3">Comments:</h4>
      <?php
      if (isset($_GET['prompt_id'])) {
        $prompt_id = $_GET['prompt_id'];
        $prompt = Prompt::find($prompt_id);
        $prompt_id = $_GET['prompt_id'];
        $comments = Comments::where('prompt_id', $prompt_id)->with('user')->get();


        if ($prompt) {
          echo '<h5>' . $prompt->title . '</h5>';

          $comments = $prompt->comments;

          if ($comments->count() > 0) {
            foreach ($comments as $comment) {
              echo '<div class="card mb-3">';
              echo '<div class="card-body d-flex">';
              echo '<img src="uploads/' . $comment->user->photo . '" alt="Profile Photo" class="img-fluid rounded-circle mt-2 me-3" style="max-width: 50px;">';
              echo '<div>';
              echo '<h6 class="card-title">' . $comment->user->username . '</h6>';
              echo '<p class="card-text">' . $comment->comment_text . '</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo '<p>No comments for this prompt yet.</p>';
          }
        } else {
          echo '<p>Prompt not found.</p>';
        }
      }
      ?>
    </div>
  </div>
</div>
</body>

</html>