<?php
/*
 * Setup cronjob
 * @author namdamvan (namdv@vietnamdiscovery.com)
 * @since 2023-05-30
 * @package gigago
 * @version 1.1.10
 */

if (!function_exists('gigago_cron_schedules_auto_suggest')):
    add_filter('cron_schedules', function ($schedules) {
        $schedules['every-10-minutes'] = array(
            'interval' => 1 * MINUTE_IN_SECONDS,
            'display' => __('Every 10 minutes')
        );
        return $schedules;
    });
    if (!wp_next_scheduled('gigago_op_cron_hooks')) {
        // every-1-minutes, hourly, twicedaily, daily, weekly
        wp_schedule_event(time(), 'every-10-minutes', 'gigago_op_cron_hooks');
    }
    function gigago_cron_schedules_auto_suggest()
    {
        $fileversion = trailingslashit(trailingslashit(ABSPATH) . 'vnb-data') . 'data-version.json';
        $jsonsversion = json_decode(file_get_contents($fileversion), true);
        $fileSearch = trailingslashit(trailingslashit(ABSPATH) . 'vnb-data') . 'data-search.json';
        $jsonSearch = json_decode(file_get_contents($fileSearch), true);
        update_option('gigago_suggestions', $jsonSearch);
        update_option('gigago_suggestions_version', $jsonsversion[0]['gigago_suggestions_version']);
    }

    add_action('gigago_op_cron_hooks', 'gigago_cron_schedules_auto_suggest');
endif;

if (!function_exists('gigago_cron_schedules_auto_data')):
    add_filter('cron_schedules', function ($schedules) {
        $schedules['every-10-minutes'] = array(
            'interval' => 1 * MINUTE_IN_SECONDS,
            'display' => __('Every 10 minutes')
        );
        return $schedules;
    });
    if (!wp_next_scheduled('gigago_cron_hooks')) {
        // every-5-minutes, hourly, twicedaily, daily, weekly
        wp_schedule_event(time(), 'every-10-minutes', 'gigago_cron_hooks');
    }
    function gigago_cron_schedules_auto_data()
    {
        $categories = get_terms(
            array(
                'taxonomy' => 'esimok_categories',
                'hide_empty' => false,
            )
        );
        $suggestions = [];
        if ($categories) {
            foreach ($categories as $category) {

                $image_url = get_field('esimok_image_category', 'esimok_categories_' . $category->term_id);

                $suggestions[] = [
                    'id' => $category->term_id,
                    'title' => $category->name,
                    'image_url' => $image_url,
                    'category_link' => get_term_link($category),
                ];
            }
        }

        $suggestions_version = [];
        $suggestions_version[] = [
            'gigago_suggestions_version' => time(),
        ];

        $fp = fopen(ESIMOK_DIR . 'vnb-data/data-search.json', 'w');
        fwrite($fp, json_encode($suggestions, JSON_UNESCAPED_UNICODE));
        fclose($fp);

        $vs = fopen(ESIMOK_DIR . 'vnb-data/data-version.json', 'w');
        fwrite($vs, json_encode($suggestions_version, JSON_UNESCAPED_UNICODE));
        fclose($vs);

        error_log('Updated suggestions: ' . json_encode($suggestions, JSON_UNESCAPED_UNICODE));
        error_log('Updated suggestions version: ' . json_encode($suggestions_version, JSON_UNESCAPED_UNICODE));
    }

    add_action('gigago_cron_hooks', 'gigago_cron_schedules_auto_data');
endif;
