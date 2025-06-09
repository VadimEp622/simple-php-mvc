<?php

function delete_forum($conn, $id): bool
{
    $sql = "DELETE FROM Forums WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function fetch_forums($conn): array
{
    $forums = array();

    $sql = "SELECT * FROM Forums";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($forums, $row);
    }
    return $forums;
}

function check_forum_exists_by_title($conn, $title): bool
{
    $sql = "SELECT * FROM Forums WHERE title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function create_forum($conn, $title): bool
{
    $sql = "INSERT INTO Forums (title) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
