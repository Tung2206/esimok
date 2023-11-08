<?php
// Thoát nếu truy cập trực tiếp.
if (!defined('ABSPATH')) exit;

if (!class_exists('Gigago_Reupload_Image_Reupload_Image_Service')) :
    class Gigago_Reupload_Image_Reupload_Image_Service
    {
        // Khởi tạo
        function __construct()
        {
            // Hook vào sự kiện add/edit post
            add_action('content_save_pre', array($this, 'process_image_src_links_on_post_update'), 10, 1);
        }
        
        // Cập nhật content
        function process_image_src_links_on_post_update($content)
        {
            $post_id = get_the_ID();
            // Lấy danh sách hình ảnh
            $img_urls = $this->extract_images($content); // Lấy danh sách các liên kết hình ảnh
            
            if (!empty($img_urls)) {
                $img_uploaded = [];
                foreach ($img_urls as $image_link) {
                    if ($this->is_external_image_link($image_link) == false) continue;
                    $baseurl = $this->download_remote_image($image_link);
                    $img_uploaded[] = $baseurl;
                    $content = str_replace($image_link, $baseurl['baseurl'], $content);
                }
                if (!empty($img_uploaded)) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $postthumbnail = 0;
                    foreach ($img_uploaded as $img) {
                        $filename = $img['path'];
                        $wp_filetype = wp_check_filetype($filename, null);
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title' => sanitize_file_name($img['file_name']),
                            'post_content' => '',
                            'post_author' => 1,
                            'post_status' => 'inherit'
                        );
                        $attachment_id = wp_insert_attachment($attachment, $filename, $post_id);
                        $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                        wp_update_attachment_metadata($attachment_id, $attachment_data);
                        
                        if (!$postthumbnail) {
                            set_post_thumbnail($post_id, $attachment_id);
                            $postthumbnail = 1;
                        }
                    }
                }
            }
            
            return $content;
        }
        
        function extract_images($html)
        {
            $html = stripslashes($html);
            preg_match_all('/<img[^>]+src\s*=\s*["\']([^"\']+)["\']/i', $html, $matches);
            
            return $matches[1];
        }
        
        function is_external_image_link($image_link)
        {
            $parsed_url = parse_url($image_link);
            
            if (isset($parsed_url['host']) && $parsed_url['host'] !== $_SERVER['HTTP_HOST']) {
                return true;
            }
            
            return false;
        }
        
        function download_remote_image($img_url)
        {
            $image_name = basename($img_url);
            $filetype = wp_check_filetype($image_name);
            
            $upload_dir = wp_upload_dir();
            $unique_file_name = date('YmdHis') . "-" . uniqid() . "." . (empty($filetype['ext']) ? 'jpg' : $filetype['ext']);
            
            $filename = $upload_dir['path'] . '/' . $unique_file_name;
            $baseurl = $upload_dir['baseurl'] . $upload_dir['subdir'] . '/' . $unique_file_name;
            
            $ch = curl_init($img_url);
            $fp = fopen($filename, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            
            $output['url'] = $img_url;
            $output['file_name'] = $unique_file_name;
            $output['path'] = $filename;
            $output['baseurl'] = $baseurl;
            
            return $output;
        }
        
    }
    
    // Instantiate.
    gigago_reupload_image_new_instance('Gigago_Reupload_Image_Reupload_Image_Service');
endif;
