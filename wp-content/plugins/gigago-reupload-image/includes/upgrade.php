<?php
// Thoát nếu truy cập trực tiếp.
if (!defined('ABSPATH')) exit;

if (!class_exists('Gigago_Reupload_Image_Upgrade')) :
    class Gigago_Reupload_Image_Upgrade
    {
        // Khởi tạo
        function __construct()
        {
            // Thiết lập Hook
            add_filter('plugins_api', array($this, 'info'), 20, 3);

            add_filter('site_transient_update_plugins', array($this, 'update'));
            add_action('upgrader_process_complete', array($this, 'purge'), 10, 2);
        }

        // Lấy thông tin của Plugin
        function request()
        {
            $remote = get_transient(GIGAGO_REUPLOAD_IMAGE_CACHE_KEY);

            if ($remote === false || GIGAGO_REUPLOAD_IMAGE_CACHE_ALLOWED === false) {
                $remote = wp_remote_get(
                    'https://plugin.gigago.io/gigago-reupload-image/info.json',
                    array(
                        'timeout' => 10,
                        'headers' => array(
                            'Accept' => 'application/json'
                        )
                    )
                );

                if (
                    is_wp_error($remote)
                    || 200 !== wp_remote_retrieve_response_code($remote)
                    || empty(wp_remote_retrieve_body($remote))
                ) {
                    return false;
                }

                set_transient(GIGAGO_REUPLOAD_IMAGE_CACHE_KEY, $remote, DAY_IN_SECONDS);
            }

            $remote = json_decode(wp_remote_retrieve_body($remote));

            return $remote;
        }

        // Gán giá trị cho Plugin
        function info($res, $action, $args)
        {
            // Kiểm tra điều kiện
            if ('plugin_information' !== $action) {
                return $res;
            }

            // Kiểm tra điều kiện
            if (GIGAGO_REUPLOAD_IMAGE_PLUGIN_SLUG !== $args->slug) {
                return $res;
            }

            // Lấy dữ liệu
            $remote = $this->request();

            if (!$remote) {
                return $res;
            }

            $res = new stdClass();

            $res->name = $remote->name;
            $res->slug = $remote->slug;
            $res->version = $remote->version;
            $res->tested = $remote->tested;
            $res->requires = $remote->requires;
            $res->author = $remote->author;
            $res->author_profile = $remote->author_profile;
            $res->download_link = $remote->download_url;
            $res->trunk = $remote->download_url;
            $res->requires_php = $remote->requires_php;
            $res->last_updated = $remote->last_updated;

            $res->sections = array(
                'description' => $remote->sections->description,
                'installation' => $remote->sections->installation,
                'changelog' => $remote->sections->changelog
            );

            if (!empty($remote->banners)) {
                $res->banners = array(
                    'low' => $remote->banners->low,
                    'high' => $remote->banners->high
                );
            }

            return $res;
        }

        // Cập nhật Plugin
        function update($transient)
        {
            if (empty($transient->checked)) {
                return $transient;
            }

            $remote = $this->request();

            if (
                $remote
                && version_compare(GIGAGO_REUPLOAD_IMAGE_VERSION, $remote->version, '<')
                && version_compare($remote->requires, get_bloginfo('version'), '<=')
                && version_compare($remote->requires_php, PHP_VERSION, '<')
            ) {
                $res = new stdClass();
                $res->slug = GIGAGO_REUPLOAD_IMAGE_PLUGIN_SLUG;
                $res->plugin = GIGAGO_REUPLOAD_IMAGE_PLUGIN_SLUG . '/' . GIGAGO_REUPLOAD_IMAGE_PLUGIN_SLUG . '.php';
                $res->new_version = $remote->version;
                $res->tested = $remote->tested;
                $res->package = $remote->download_url;

                $transient->response[$res->plugin] = $res;
            }

            return $transient;
        }

        // Xóa dữ liệu
        function purge($upgrader, $options)
        {
            if (
                GIGAGO_REUPLOAD_IMAGE_CACHE_ALLOWED
                && 'update' === $options['action']
                && 'plugin' === $options['type']
            ) {
                // Xóa transient
                delete_transient(GIGAGO_REUPLOAD_IMAGE_CACHE_KEY);
            }
        }
    }

    // Trigger Class
    gigago_reupload_image_new_instance('Gigago_Reupload_Image_Upgrade');

endif;
