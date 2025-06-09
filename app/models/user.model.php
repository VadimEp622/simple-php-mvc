<?php

function fetch_users($conn): array
{
    $users = array();

    $sql = "SELECT * FROM Users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($users, $row);
    }
    return $users;
}

function check_user_exists_by_email($conn, $email): bool
{
    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function create_user($conn, $full_name, $email, $password, $age, $phone_number): bool
{
    $sql = "INSERT INTO Users (full_name, email, password, age, phone_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $full_name, $email, $password, $age, $phone_number); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function delete_user($conn, $id): bool
{
    $sql = "DELETE FROM Users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // The argument may be one of four types: i - integer, d - double, s - string, b - BLOB
    $stmt->execute();
    return $stmt->affected_rows > 0;
}

function get_demo_users()
{
    return array(
        array('full_name' => 'John Doe', 'email' => 'johndoe@me.com', 'password' => 'password', 'age' => 20, 'phone_number' => '1234567890'),
        array('full_name' => 'Jane Doe', 'email' => 'janedoe@me.com', 'password' => 'password', 'age' => 21, 'phone_number' => '1234567891'),
        array('full_name' => 'John Smith', 'email' => 'johnsmith@me.com', 'password' => 'password', 'age' => 22, 'phone_number' => '1234567892'),
        array('full_name' => 'Jane Smith', 'email' => 'janesmith@me.com', 'password' => 'password', 'age' => 23, 'phone_number' => '1234567893'),
    );
}
