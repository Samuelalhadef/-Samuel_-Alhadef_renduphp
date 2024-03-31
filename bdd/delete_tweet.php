<?php
require_once 'config.php';

session_start();

if($_SERVER ['REQUEST_METHOD'] === 'POST') {

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];


    if (isset($_POST['delete'], $_POST['tweet_id']) && is_numeric($_POST['tweet_id'])) {


        $tweetId = $_POST['tweet_id'];

        $request = $database->prepare('SELECT author_id FROM tweets WHERE id = :tweet_id');
        $request->execute(['tweet_id' => $tweetId]);
        $authorId = $request->fetchColumn();

        if ($authorId == $userId) {
            $deleteRequest = $database->prepare('DELETE FROM tweets WHERE id = :tweet_id');
            $deleteRequest->execute(['tweet_id' => $tweetId]);
            header('Location: index.php?user=' . $_SESSION['user_pseudo']);
            exit; }
        } else {
            echo "Vous n'avez pas la permission de supprimer ce tweet.";
        }
    } else {
        die("Requête invalide.");
    }
} else {
    header('Location: index.html.php');
    exit;
}


?>
