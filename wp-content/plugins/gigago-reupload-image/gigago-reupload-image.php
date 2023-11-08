<?php
/*
Plugin Name: Gigago Reupload Image
Plugin Slug: gigago-reupload-image
Plugin URI: https://gigago.com/
Description: Reupload lại các hình ảnh có nguồn khác với website hiện tại
Version: 1.0.6
Author: Gigago
Author URI: https://gigago.com/
License: GPLv2 or later
*/

// Thoát nếu truy cập trực tiếp.
if (!defined('ABSPATH')) exit;

if (!class_exists('Gigago_Reupload_Image')) :
    class Gigago_Reupload_Image
    {
        // Khởi tạo
        function __construct()
        {
            // Không làm gì cả.
        }

        // Thiết lập Plugin
        function initialize()
        {
            // Khởi tạo các biến toàn cục
            $this->define('GIGAGO_REUPLOAD_IMAGE_VERSION', '1.0.6');
            $this->define('GIGAGO_REUPLOAD_IMAGE_PLUGIN_SLUG', 'gigago-reupload-image');
            $this->define('GIGAGO_REUPLOAD_IMAGE_PLUGIN_PATH', plugin_dir_path(__FILE__));
            $this->define('GIGAGO_REUPLOAD_IMAGE_PLUGIN_URL', plugin_dir_url(__FILE__));
            $this->define('GIGAGO_REUPLOAD_IMAGE_CACHE_KEY', 'gigago_reupload_image_upgrade');
            $this->define('GIGAGO_REUPLOAD_IMAGE_CACHE_ALLOWED', false);

            // Gọi functions toàn cục
            $this->include_file('includes/helper.php');
            $this->include_file('includes/upgrade.php');

            // Gọi các dịch vụ đi kèm
            $this->include_file('includes/services/reupload.image.service.php');
        }

        // Gọi file
        function include_file($file = '')
        {
            $file = dirname(__FILE__) . '/' . $file;
            if (file_exists($file)) include_once($file);
        }

        // Định nghĩa
        function define($name, $value = true)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }
    }

    // Khởi tạo biến toàn cục
    global $Gigago_Reupload_Image;

    // Khởi động Plugin
    $Gigago_Reupload_Image = new Gigago_Reupload_Image();
    $Gigago_Reupload_Image->initialize();

endif;
