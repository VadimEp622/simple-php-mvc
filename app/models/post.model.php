<?php


function fetch_posts($conn): array
{
    $posts = array();

    // INFO: 
    //      * COALESCE() function returns the first non-null value in a list
    //      * LEFT JOIN returns all rows from the left table, even if there are no matches in the right table
    $sql = "SELECT
        Posts.id,
        Posts.title,
        Posts.content,
        COALESCE(Forums.title, Posts.forum_id) AS forum_title,
        Posts.poster_email
    FROM
        Posts
    LEFT JOIN Forums ON Posts.forum_id = Forums.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($posts, $row);
    }
    return $posts;
}

function create_post($conn, $email, $title, $content, $forum): bool
{
    $sql = "INSERT INTO Posts (poster_email, title, content, forum_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $email, $title, $content, $forum); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function delete_post($conn, $id): bool
{
    $sql = "DELETE FROM Posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
