<?php

function logger($data)
{
    file_put_contents(
        LOGS . '/log.log',
        print_r($data, true) . PHP_EOL,
        FILE_APPEND
    );
}




function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($die) {
        die;
    }

}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($http = false) {
    if($http){
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    die();
}

function base_url() {
    return PATH . '/' . (\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang') . '/' : '');
}
//9 урок 7 - 10 минута

/**
 * @param string $key Key of Get array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function get($key, $type = 'i') {
    $param = $key;
    $$param = $_GET[$param] ?? '';
    if($type == 'i'){
        return (int)$$param;
    } elseif($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

/**
 * @param string $key Key of Post array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function post($key, $type = 's') {
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if($type == 'i'){
        return (int)$$param;
    } elseif($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}



function get_field_value($name)
{
    return isset($_SESSION['form_data'][$name]) ? h($_SESSION['form_data'][$name]) : '';
}

