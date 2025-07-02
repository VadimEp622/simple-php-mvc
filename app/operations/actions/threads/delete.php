<?php
session_start();
require_once __DIR__ . '/../../../config/db-conn.php';
require_once __DIR__ . '/../../../services/flash.services.php';
require_once __DIR__ . '/../../../services/utils.services.php';
require_once __DIR__ . '/../../../models/thread.model.php';


$res = array('error' => false);

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!is_numeric($id)) {
    $res['error'] = true;
    create_flash_message(FLASH_OPERATION_THREAD_DELETE, "Thread deletion failed - invalid form id", FLASH_ERROR);
}

if (!$res['error']) {
    try {
        if (delete_thread($conn, $id)) {
            create_flash_message(FLASH_OPERATION_THREAD_DELETE, "Thread deleted successfully", FLASH_SUCCESS);
        } else {
            create_flash_message(FLASH_OPERATION_THREAD_DELETE, "Thread deletion failed - no thread deleted", FLASH_ERROR);
        }
    } catch (Exception $e) {
        create_flash_message(FLASH_OPERATION_THREAD_DELETE, "Thread deletion failed - database error", FLASH_ERROR);
    } finally {
        redirect_to_route_and_die($_POST['current_route']);
    }
}
