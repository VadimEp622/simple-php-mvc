<?php
require_once __DIR__ . '/../services/flash.services.php';
?>

<div>
    <?php
    display_flash_message(FLASH_OPERATION_FORUM_CREATE);
    display_flash_message(FLASH_OPERATION_FORUM_DELETE);
    display_flash_message(FLASH_OPERATION_USER_DELETE);
    display_flash_message(FLASH_OPERATION_POST_CREATE);
    display_flash_message(FLASH_OPERATION_POST_DELETE);
    ?>
</div>