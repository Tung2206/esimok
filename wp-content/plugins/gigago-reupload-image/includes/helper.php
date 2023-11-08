<?php
// Biến toàn cục
global $gigago_reupload_image_instances;

// Mảng các Class
$gigago_reupload_image_instances = array();

// Khởi tạo Class
function gigago_reupload_image_new_instance($class = '')
{
    global $gigago_reupload_image_instances;

    return $gigago_reupload_image_instances[$class] = new $class();
}

// Lấy đường dẫn của file
function gigago_reupload_image_get_path($filename = '')
{
    return GIGAGO_REUPLOAD_IMAGE_PLUGIN_PATH . ltrim($filename, '/');
}

// Lấy URL của file
function gigago_reupload_image_get_url($filename = '')
{
    return GIGAGO_REUPLOAD_IMAGE_PLUGIN_URL . ltrim($filename, '/');
}

// Gọi view
function gigago_reupload_image_get_view($path = '', $args = array())
{
    // Kiểm tra tên file
    if (substr($path, -4) !== '.php') {
        $path = gigago_reupload_image_get_path("views/{$path}.php");
    }

    // Nếu có file => Gọi file
    if (file_exists($path)) {
        extract($args);
        include $path;
    }
}

/*
 * Làm sạch chuỗi
 */
function reupload_post_sync_sanitize($title)
{
    $replacement = '-';
    $map = array();
    $quotedReplacement = preg_quote($replacement, '/');
    $default = array(
        '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
        '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
        '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
        '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
        '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
        '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'y',
        '/đ|Đ/' => 'd',
        '/ç/' => 'c',
        '/ñ/' => 'n',
        '/ä|æ/' => 'ae',
        '/ö/' => 'oe',
        '/ü/' => 'ue',
        '/Ä/' => 'Ae',
        '/Ü/' => 'Ue',
        '/Ö/' => 'Oe',
        '/ß/' => 'ss',
        '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
        '/\\s+/' => $replacement,
        sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
    );
    
    // Some URL was encode, decode first
    $title = urldecode($title);
    $map = array_merge($map, $default);
    
    return strtolower(preg_replace(array_keys($map), array_values($map), $title));
}
