<?php
session_start();

include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get the submitted question and sanitize input
    $question = htmlspecialchars($_POST['question'], ENT_QUOTES, 'UTF-8');

    // Insert the question into the database
    $stmt = $dbhandle->prepare("INSERT INTO questions (content) VALUES (?)");
    $stmt->bind_param("s", $question);

    if ($stmt->execute()) {
        echo "Question submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$dbhandle->close();
?>