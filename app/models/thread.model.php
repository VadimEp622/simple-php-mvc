<?php


function fetch_threads($conn): array
{
    $threads = array();

    // INFO: 
    //      * COALESCE() function returns the first non-null value in a list
    //      * LEFT JOIN returns all rows from the left table, even if there are no matches in the right table
    $sql = "SELECT
        Threads.id,
        Threads.title,
        Threads.content,
        COALESCE(Forums.title, Threads.forum_id) AS forum_title,
        Threads.poster_email
    FROM
        Threads
    LEFT JOIN Forums ON Threads.forum_id = Forums.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($threads, $row);
    }
    return $threads;
}

function create_thread($conn, $email, $title, $content, $forum): bool
{
    $sql = "INSERT INTO Threads (poster_email, title, content, forum_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $email, $title, $content, $forum); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function delete_thread($conn, $id): bool
{
    $sql = "DELETE FROM Threads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
