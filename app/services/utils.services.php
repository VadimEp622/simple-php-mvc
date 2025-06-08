<?php

// 'route_name' => 'route_value'
const ROUTES = array('home' => '', 'admin' => 'admin');


function redirect_to_current_page_and_die(): void
{
    $current_route = get_current_route_value();
    Header("Location: " . BASE_URL . $current_route);
    exit;
}

function redirect_to_route_and_die($route): void
{
    $redirect_route = '';
    if (isset($route) && array_key_exists($route, ROUTES)) {
        $redirect_route = ROUTES[$route];
    }

    Header("Location: " . BASE_URL . $redirect_route);
    exit;
}

function get_current_route_name(): string
{
    $current_route = trim(remove_string_prefix($_SERVER['REQUEST_URI'], rtrim(BASE_PATH, '/')), '/');

    if (!array_key_exists($current_route, ROUTES)) {
        $current_route = 'home';
    }
    return $current_route;
}


function get_current_route_value(): string
{
    $current_route = get_current_route_name();
    return ROUTES[$current_route];
}

function remove_string_prefix($string, $prefix)
{
    if (substr($string, 0, strlen($prefix)) === $prefix) {
        return substr($string, strlen($prefix));
    }
    return $string;
}

function has_validation_errors(array $validation): bool
{
    foreach ($validation as $field => $data) {
        if ($data['error']) {
            return true;
        }
    }
    return false;
}

// learning purposes
function print_organized_global_server_variable()
{
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
}

// learning purposes
function print_json($data)
{
    echo json_encode($data);
}
