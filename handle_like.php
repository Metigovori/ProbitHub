<?php
session_start();
require_once "./admin/Bootstrap.php";

use Admin\Models\Likes;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['promptId'])) {
    $userId = $_SESSION['user_id'];
    $promptId = $_POST['promptId'];

    // Check if the user has already liked the prompt
    $existingLike = Likes::where('user_id', $userId)
        ->where('prompt_id', $promptId)
        ->first();

    if (!$existingLike) {
        // Insert the like into the likes table
        $like = new Likes;
        $like->user_id = $userId;
        $like->prompt_id = $promptId;
        $like->content_type = 'prompt';
        $like->content_id = $promptId;
        $like->save();

        // Update the like count and send the updated count back to the client
        $likeCount = Likes::where('prompt_id', $promptId)->count();
        echo json_encode(['success' => true, 'likeCount' => $likeCount]);
        exit;
    } else {
        // If the user has already liked, just return the current like count
        $likeCount = Likes::where('prompt_id', $promptId)->count();
        echo json_encode(['success' => true, 'likeCount' => $likeCount]);
        exit;
    }
}
