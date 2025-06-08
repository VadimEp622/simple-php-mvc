<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/utils.services.php';

$request = rtrim(remove_string_prefix($_SERVER['REQUEST_URI'], rtrim(BASE_PATH, '/')), '/');
const view_dir = '/../app/views/';
const operation_dir = '/../app/operations/';

// ############################################################ INFO ############################################################
// * In prod, "http://www.example.com" is equal to "http://localhost/proj-php/php-sql-exercise/php-with-routing/public" 
// * In prod, BASE_PATH should be an empty string
// * In dev, when entering url "localhost/proj-php/php-sql-exercise/php-with-routing", added redirect to "localhost/proj-php/php-sql-exercise/php-with-routing/public" 
// * In prod, anything outside of public folder is not directly accessible by url
// ##############################################################################################################################


// TODO: push to github
// TODO: make actions "current_route" type safe


switch ($request) {
    // ############################################################# VIEWS ############################################################
    case '':
        require __DIR__ . view_dir . 'home.php';
        break;
    case '/admin':
        require __DIR__ . view_dir . 'admin.php';
        break;


    // ############################################################# OPERATIONS/ACTIONS ############################################################
    case '/actions/forums/delete':
        require __DIR__ . operation_dir . 'actions/forums/delete.php';
        break;


    // ############################################################# DEFAULT ############################################################
    default:
        http_response_code(404);
        require __DIR__ . view_dir . '404.php';
}
