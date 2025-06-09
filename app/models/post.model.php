<?php

function create_post($conn, $email, $title, $content, $forum): bool
{
    $sql = "INSERT INTO Posts (poster_email, title, content, forum_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $email, $title, $content, $forum); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
