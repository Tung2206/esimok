<?php
/*
 * Load more products
 *
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-09-27
 */

add_action('wp_ajax_load_products', 'load_products');
add_action('wp_ajax_nopriv_load_products', 'load_products');

function load_products()
{   
    $minValue = isset($_POST['minValue']) ? intval($_POST['minValue']) : 0;
    $maxValue = isset($_POST['maxValue']) ? intval($_POST['maxValue']) : 30;
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'esimok',
        'post_status' => 'publish',
        // Thêm meta_query để lọc theo giá trị ngày
        'meta_query' => array(
          array(
            'key' => 'esimok_thong_tin_goi_cuoc_esimok_validity', // Đặt key của meta field
            'value' => array($minValue, $maxValue),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN',
          ),
        ),
      );    
    $all_posts = new WP_Query($args);
    $html ='';

    if ($all_posts->have_posts()):
        while ($all_posts->have_posts()):
            $all_posts->the_post();
            $esimok_info = get_field('esimok_thong_tin_goi_cuoc');
            $provider = $esimok_info['esimok_provider'];
            $plan_name = $esimok_info['esimok_plan_name'];
            $size = $esimok_info['esimok_size'];
            $validity = $esimok_info['esimok_validity'];
            $price_gb = $esimok_info['esimok_price_gb'];
            $price = $esimok_info['esimok_price'];
            $goi_data = $esimok_info['esimok_goi_data'];
            $note = $esimok_info['esimok_note'];
    
    $html .='<a href="'.get_the_permalink(get_the_ID()).'" class="offers-list-row product-row">';
        $html .='<div class="offers-list-item-mobile">';
            $html .='<article class="product-list-data">';
                $html .='<div class="logo">';
                    if (!empty($provider)) {
                        $html .='<img src="'.$provider.'" alt="'.$plan_name.'">';
                    } 
                $html .='</div>';
                $html .='<div class="product-list-content">';
                    $html .='<div class="title-product">';
                        $html .='<p>'.$plan_name.'</p>';
                    $html .='</div>';
                    $html .='<div class="data-validity-product">';
                        $html .='<div class="data-product">'.$goi_data.'</div>';
                        $html .='<div class="validity-product validity">'.$validity.'</div>';
                    $html .='</div>';
                    $html .='<div class="price-product">'.$price.'</div>';
                    $html .='<div class="infomation-product">';
                        $html .='<ul>';
                            foreach ($goi_data as $data):
                                if ($data === 'Phone') :
                                    $html .='<li>
                                    <div class="list-data">
                                        <div class="info-table-data">
                                            <span class="icon-phone"></span>
                                            <div class="name-info-data">
                                                <span>Phone number available</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>';
                                endif;
                                if ($data === 'Voice') :
                                    $html .='<li>
                                    <div class="list-data">
                                        <div class="info-table-data">
                                            <span class="icon-voice"></span>
                                            <div class="name-info-data">
                                                <span>Outgoing calls included</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>';
                                endif;
                                if ($data === 'Globe') :
                                    $html .='<li>
                                    <div class="list-data">
                                        <div class="info-table-data">
                                            <span class="icon-global"></span>
                                            <div class="name-info-data">
                                                <span> Low latency</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>';
                                endif;
                                if ($data === 'Callendar'):
                                    $html .='<li>
                                    <div class="list-data">
                                        <div class="info-table-data">
                                            <span class="icon-calendar"></span>
                                            <div class="name-info-data">
                                                <span>Subscription based plan</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>';
                                endif;
                            endforeach;    
                                if (!empty($note)) :
                                    $html .='<li>
                                    <div class="list-data">
                                        <div class="info-table-data">
                                            <span class="icon-note"></span>
                                            <div class="name-info-data">
                                                <span>'.$note.'</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>';
                                endif;
                        $html .='</ul>';
                    $html .='</div>';
                $html .='</div>';
                $html .= '<div class="link-product"><span class="icon-next"></span></div>';
            $html .='</article>';
        $html .='</div>';
    
        $html .='<div class="offers-list-item custom-product-image">';
                if (!empty($provider)) {
                    $html .='<img src="'.$provider.'" alt="'.$plan_name.'">';
                } 
        $html .='</div>';

        $html .='<div class="offers-list-item plane-name">';
            $html .='<p>'.$plan_name.'</p>';
        $html .='</div>';

        $html .='<div class="offers-list-item">';
            $html .='<ul>';
                foreach ($goi_data as $data):
            
                    if ($data === 'Phone') :
                        $html .='<li>
                        <div class="list-data">
                            <div class="info-table-data">
                                <span class="icon-phone"></span>
                                <div class="name-info-data">
                                    <span>Phone number available</span>
                                </div>
                            </div>
                        </div>
                        </li>';
                    endif;
                    if ($data === 'Voice') :
                        $html .='<li>
                        <div class="list-data">
                            <div class="info-table-data">
                                <span class="icon-voice"></span>
                                <div class="name-info-data">
                                    <span>Outgoing calls included</span>
                                </div>
                            </div>
                        </div>
                        </li>';
                    endif;
                    if ($data === 'Globe') :
                        $html .='<li>
                        <div class="list-data">
                            <div class="info-table-data">
                                <span class="icon-global"></span>
                                <div class="name-info-data">
                                    <span> Low latency</span>
                                </div>
                            </div>
                        </div>
                        </li>';
                    endif;
                    if ($data === 'Callendar'):
                        $html .='<li>
                        <div class="list-data">
                            <div class="info-table-data">
                                <span class="icon-calendar"></span>
                                <div class="name-info-data">
                                    <span>Subscription based plan</span>
                                </div>
                            </div>
                        </div>
                        </li>';
                    endif;
                endforeach;    
                    if (!empty($note)) :
                        $html .='<li>
                        <div class="list-data">
                            <div class="info-table-data">
                                <span class="icon-note"></span>
                                <div class="name-info-data">
                                    <span>'.$note.'</span>
                                </div>
                            </div>
                        </div>
                        </li>';
                    endif;
            $html .='</ul>';
        $html .='</div>';
        
        $html .='<div class="offers-list-item size" style="text-align: center;">'.$size.'</div>';
        
        $html .='<div class="offers-list-item validity" style="text-align: center;">'.$validity.'</div>';
                    
        $html .='<div class="offers-list-item data-product">'.$price_gb.'</div>';
    
        $html .='<div class="offers-list-item price-product" style="text-align: center;">'.$price.'</div>';

        $html .='<div class="offers-list-item" style="text-align: center;">
                    <span class="icon-next"></span>
                </div>';

    $html .='</a>';
    endwhile;
    wp_reset_postdata();
    else:
    $html .= '<p>No products found.</p>';
    endif;
    echo  $html;
    
    wp_die();
}
