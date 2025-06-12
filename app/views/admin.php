<?php
session_start();
require_once __DIR__ . '/../config/db-conn.php';
require_once __DIR__ . '/../services/form-handler.services.php';


$res = array(
    'post-create-form' => array('error' => false, 'message' => 'Template error message'),
    'forum-create-form' => array('error' => false, 'message' => 'Template error message'),
    'user-list' => array('error' => false, 'message' => 'Template error message'),
    'post-list' => array('error' => false, 'message' => 'Template error message'),
    'forum-list' => array('error' => false, 'message' => 'Template error message')
);


$validation = array(
    'post_create_form' => array(
        'title' => array('error' => false, 'message' => ''),
        'content' => array('error' => false, 'message' => ''),
        'forum' => array('error' => false, 'message' => ''),
        'email' => array('error' => false, 'message' => '')
    ),
    'forum_create_form' => array(
        'title' => array('error' => false, 'message' => '')
    )
);


// INFO: form handling on POST (validate and actual db action), happens here, before any output is made, for clean Header function redirections 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['current_form'])) {
    if ($_POST['current_form'] == 'post_create_form') form_handler_post_create($conn,  $validation);
    if ($_POST['current_form'] == 'forum_create_form') form_handler_forum_create($conn,  $validation);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-SQL-EXERCISE</title>
    <script src="js/libs/jquery-3.7.1.min.js"></script>
    <script src="js/libs/jquery.validate.min.js"></script>
    <script src="js/libs/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php require_once __DIR__ . '/../components/flash-message.php'; ?>
    <?php require_once __DIR__ . '/../components/navbar.php'; ?>
    <h1>Hello From Admin</h1>
    <?php require_once __DIR__ . '/../components/user-list.php'; ?>
    <?php require_once __DIR__ . '/../components/post-list.php'; ?>
    <?php require_once __DIR__ . '/../components/forum-create-form.php'; ?>
    <?php require_once __DIR__ . '/../components/forum-list.php'; ?>


    <script src="js/services/utils.services.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            flash_timeout_remove()
        });
    </script>
</body>

</html>