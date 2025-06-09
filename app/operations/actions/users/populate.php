<?php
session_start();
require_once __DIR__ . '/../../../config/db-conn.php';
require_once __DIR__ . '/../../../services/flash.services.php';
require_once __DIR__ . '/../../../services/utils.services.php';
require_once __DIR__ . '/../../../models/user.model.php';


$res = array('error' => false);

$demo_users = get_demo_users();

try {
    foreach ($demo_users as $value) {
        if ($res['error'] || !create_user($conn, $value['full_name'], $value['email'], $value['password'], $value['age'], $value['phone_number'])) {
            $res['error'] = true;
            create_flash_message(FLASH_OPERATION_POST_CREATE, "User populate failed - no user created", FLASH_ERROR);
        }
    }

    if (!$res['error']) {
        create_flash_message(FLASH_OPERATION_POST_CREATE, "User populated successfully", FLASH_SUCCESS);
    }
} catch (Exception $e) {
    create_flash_message(FLASH_OPERATION_POST_CREATE, "User populate failed - database error", FLASH_ERROR);
} finally {
    redirect_to_route_and_die($_POST['current_route']);
}
