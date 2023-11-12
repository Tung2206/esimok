<?php
/*
 * The template for displaying archive pages
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-10-31
 * 
 * @package Esimok
 * @version 3.5.1
 */

get_header();
// Load CSS
// wp_enqueue_style('esimok-component-banner-home');
// wp_enqueue_style('esimok-component-taxonomy-esim');
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
?>

<div id="country">

    <section class="section1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="esim-setion1">
                        <h1 class="text-center text-white">Find the best prepaid eSIM plans for your travel
                            destination
                        </h1>
                        <form class="position-relative mb-3">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.12075 1.93477C6.31611 1.83702 6.53155 1.78613 6.75 1.78613C6.96845 1.78613 7.18389 1.83702 7.37925 1.93477L11.124 3.80827C11.2035 3.84727 11.2965 3.84727 11.376 3.80827L14.2778 2.35702C14.4921 2.24992 14.7303 2.19937 14.9697 2.21019C15.2091 2.22101 15.4418 2.29283 15.6456 2.41883C15.8495 2.54484 16.0178 2.72085 16.1345 2.93016C16.2512 3.13946 16.3125 3.37513 16.3125 3.61477V12.9785C16.3125 13.511 16.0117 13.9985 15.5347 14.2363L11.8785 16.064C11.6833 16.1615 11.4682 16.2123 11.25 16.2123C11.0318 16.2123 10.8167 16.1615 10.6215 16.064L6.876 14.1913C6.83689 14.1717 6.79375 14.1615 6.75 14.1615C6.70625 14.1615 6.66311 14.1717 6.624 14.1913L3.723 15.6425C3.50859 15.7498 3.27031 15.8005 3.0308 15.7898C2.79129 15.779 2.55851 15.7072 2.35455 15.5812C2.1506 15.4552 1.98225 15.2791 1.8655 15.0697C1.74875 14.8603 1.68748 14.6245 1.6875 14.3848V5.02102C1.6875 4.48852 1.98825 4.00102 2.4645 3.76327L6.12075 1.93552V1.93477ZM6.75 4.49977C6.89918 4.49977 7.04226 4.55904 7.14775 4.66453C7.25324 4.77001 7.3125 4.91309 7.3125 5.06227V11.2498C7.3125 11.399 7.25324 11.542 7.14775 11.6475C7.04226 11.753 6.89918 11.8123 6.75 11.8123C6.60082 11.8123 6.45774 11.753 6.35225 11.6475C6.24676 11.542 6.1875 11.399 6.1875 11.2498V5.06227C6.1875 4.91309 6.24676 4.77001 6.35225 4.66453C6.45774 4.55904 6.60082 4.49977 6.75 4.49977ZM11.8125 6.74977C11.8125 6.60059 11.7532 6.45751 11.6477 6.35203C11.5423 6.24654 11.3992 6.18727 11.25 6.18727C11.1008 6.18727 10.9577 6.24654 10.8523 6.35203C10.7468 6.45751 10.6875 6.60059 10.6875 6.74977V12.9373C10.6875 13.0865 10.7468 13.2295 10.8523 13.335C10.9577 13.4405 11.1008 13.4998 11.25 13.4998C11.3992 13.4998 11.5423 13.4405 11.6477 13.335C11.7532 13.2295 11.8125 13.0865 11.8125 12.9373V6.74977Z"
                                    fill="#389E0D" />
                            </svg>
                            <input class="rounded-4" type="text" placeholder="Search by countrie name..." />
                        </form>
                        <p class="text-center text-white">Search and compare 2000+ data plans from 25+ eSIM
                            providers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section1 -->

    <section class="section2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $args = array(
                        'posts_per_page' => 6,
                        'post_type' => 'esimok',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'esimok_categories',
                                'field' => 'term_id',
                                'terms' => $term_id,
                            ),
                        ),
                    );
                    $all_posts = new WP_Query($args);
                    ?>
                    <div class="owl-carousel owl-theme owl-country">
                        <?php
                        $i = 1;
                        $esimok_info = get_field('esimok_thong_tin_goi_cuoc');
                        $provider = $esimok_info['esimok_provider'];
                        $plan_name = $esimok_info['esimok_plan_name'];
                        $validity = $esimok_info['esimok_validity'];
                        $size = $esimok_info['esimok_size'];
                        $price = $esimok_info['esimok_price'];

                        if ($all_posts->have_posts()):
                            while ($all_posts->have_posts()):
                                $all_posts->the_post();
                                ?>
                                <article class="item-country">
                                    <a href="<?php echo get_the_permalink($post->ID); ?>">
                                        <div class="start-top">
                                            <img src="<?php echo ESIMOK_THEME_URL ?>/assets/images/Stars.png" class="img-fluid"
                                                alt="POPULAR">
                                            <h5 class="country-popular">POPULAR
                                                <?php echo $i; ?>
                                            </h5>
                                        </div>
                                        <div class="item-country-text">
                                            <div class="price-title">
                                                <?php echo $price; ?>
                                                <img src="<?php echo ESIMOK_THEME_URL ?>/assets/images/mdi_coupon-outline.png"
                                                    alt="price">
                                            </div>
                                            <div class="data-country">
                                                <?php echo $size; ?> /
                                                <?php echo $validity; ?>
                                            </div>
                                        </div>
                                        <div class="item-country-logo">
                                            <img src="<?php echo $provider; ?>" class="img-fluid"
                                                alt="<?php echo $plan_name; ?>">
                                        </div>
                                    </a>
                                </article>
                                <?php
                                $i++;
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -- -->
    <section class="section3">
        <div class="filter-esim">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 total-esim">
                        <p class="providers">
                            <strong> 33 eSIM</strong> providers
                        </p>
                        <p class="prepaid">
                            <strong>470 eSIM</strong> prepaid data plans
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2 date-esim">
                        <div class="slider-labels">
                            <div class="caption">
                                <span id="slider-range-value1"></span>
                            </div>
                            <div class="text-right caption">
                                <span id="slider-range-value2"></span>
                            </div>
                        </div>
                        <div id="slider-range"></div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5 list-services-esim">
                        <ul class="nav nav-tabs">
                            <li class="active" data-type="esimok">
                                <img src="<?php echo ESIMOK_THEME_URL ?>/assets/images/excellent1.png" alt="eSIMOK">
                                eSIMOK
                            </li>
                            <li data-type="best-price">Best price/GB</li>
                            <li data-type="largest-gb">Largest GB</li>
                            <li data-type="longest-validity">Longest validity</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-1 filter-btn-esim">
                        <img src="<?php echo ESIMOK_THEME_URL ?>/assets/images/btn-search.png" alt="esimok">
                        <div class="filter-search-list">
                            <div class="filter-search-size">
                                <p>Size</p>
                                <div class="slider-labels">
                                    <div class="caption">
                                        <span id="gb-value1"></span>
                                    </div>
                                    <div class="text-right caption">
                                        <span id="gb-value2"></span>
                                    </div>
                                </div>
                                <div id="slider-range2"></div>
                            </div>
                            <div class="filter-search-validaity">
                                <p>Validity</p>
                                <div class="slider-labels">
                                    <div class="caption">
                                        <span id="slider-date-value1"></span>
                                    </div>
                                    <div class="text-right caption">
                                        <span id="slider-date-value2"></span>
                                    </div>
                                </div>
                                <div id="slider-range3"></div>
                            </div>
                            <div class="filter-search-price">
                                <p>Price</p>
                                <div class="slider-labels">
                                    <div class="caption">
                                        <span id="price-value1"></span>
                                    </div>
                                    <div class="text-right caption">
                                        <span id="price-value2"></span>
                                    </div>
                                </div>
                                <div id="slider-range4"></div>
                            </div>
                            <div class="filter-search-option">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault1">
                                    <label class="form-check-label" for="flexSwitchCheckDefault1">Hide plans with
                                        daily data cap</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault2">
                                    <label class="form-check-label" for="flexSwitchCheckDefault2">Hide subscription
                                        plans</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault3">Hide plans without
                                        a promo code</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault4">
                                    <label class="form-check-label" for="flexSwitchCheckDefault4">Hide data only
                                        plans (no Voice / SMS)</label>
                                </div>
                            </div>
                            <div class="filter-btn-search-content">
                                <button type="reset" value="Clear" class="clear">Clear</button>
                                <button class="submit-btn">Ok</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 search-list-esim-mobie">
                        <div class="seclect-search esim">

                        </div>
                    </div>

                    <div id="product-list-container" class="product-row-container">
                        <div class="offers-list">
                            <header class="offers-list-header">
                                <div class="cell"></div>
                                <div class="offers-list-item cell">
                                    <span>PROVIDER </span>
                                </div>
                                <div class="offers-list-item cell">
                                    <span>PLAN NAME</span>
                                </div>
                                <div class="offers-list-item cell">
                                    <span></span>
                                </div>
                                <div class="offers-list-item cell" style="text-align: center;">
                                    <span>SIZE</span>
                                </div>
                                <div class="offers-list-item cell" style="text-align: center;">
                                    <span>VALIDITY</span>
                                </div>
                                <div class="offers-list-item cell" style="text-align: center;">
                                    <span>PRICE/GB</span>
                                </div>
                                <div class="offers-list-item cell" style="text-align: center;">
                                    <span>PRICE</span>
                                </div>
                                <div class="offers-list-item cell">
                                    <span></span>
                                </div>
                                <div class="offers-list-item cell">
                                    <span></span>
                                </div>
                            </header>
                            <!-- -- -->
                            <?php
                            $args = array(
                                'posts_per_page' => -1,
                                'post_type' => 'esimok',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'esimok_categories',
                                        'field' => 'term_id',
                                        'terms' => $term_id,
                                    ),
                                ),
                            );
                            $all_posts = new WP_Query($args);

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
                                    ?>
                                    <a href="<?php echo get_the_permalink($post->ID); ?>"
                                        class="offers-list-row product-row no-link" data-type="active">
                                        <div class="offers-list-item-mobile">
                                            <article class="product-list-data">
                                                <div class="logo">
                                                    <?php
                                                    if (!empty($provider)) {
                                                        ?>
                                                        <img src="<?php echo $provider ?>" alt="<?php echo $plan_name ?>">
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="product-list-content">
                                                    <div class="title-product">
                                                        <p>
                                                            <?php echo $plan_name ?>
                                                        </p>
                                                    </div>
                                                    <div class="data-validity-product">
                                                        <div class="data-product">
                                                            <?php echo $data ?>
                                                        </div>
                                                        <div class="validity-product validity">
                                                            <?php echo $validity ?>
                                                        </div>
                                                    </div>
                                                    <div class="price-product">
                                                        <?php echo $price; ?>
                                                    </div>
                                                    <div class="infomation-product">
                                                        <ul>
                                                            <?php foreach ($goi_data as $data): ?>

                                                                <?php if ($data === 'Phone'): ?>
                                                                    <li>
                                                                        <div class="list-data">
                                                                            <div class="info-table-data">
                                                                                <span class="icon-phone"></span>
                                                                                <div class="name-info-data">
                                                                                    <span>Phone number available</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>

                                                                <?php if ($data === 'Voice'): ?>
                                                                    <li>
                                                                        <div class="list-data">
                                                                            <div class="info-table-data">
                                                                                <span class="icon-voice"></span>
                                                                                <div class="name-info-data">
                                                                                    <span>Outgoing calls included</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if ($data === 'Globe'): ?>
                                                                    <li>
                                                                        <div class="list-data">
                                                                            <div class="info-table-data">
                                                                                <span class="icon-global"></span>
                                                                                <div class="name-info-data">
                                                                                    <span> Low latency</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if ($data === 'Callendar'): ?>
                                                                    <li>
                                                                        <div class="list-data">
                                                                            <div class="info-table-data">
                                                                                <span class="icon-calendar"></span>
                                                                                <div class="name-info-data">
                                                                                    <span>Subscription based plan</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <?php if (!empty($note)): ?>
                                                        <div class="<?php echo $note ?>">
                                                            <?php echo $note ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="link-product">
                                                    <span class="icon-next"></span>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="offers-list-item custom-product-image">
                                            <?php
                                            if (!empty($provider)) {
                                                ?>
                                                <img src="<?php echo $provider ?>" alt="<?php echo $plan_name ?>">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="offers-list-item plane-name">
                                            <p>
                                                <?php echo $plan_name ?>
                                            </p>
                                        </div>
                                        <div class="offers-list-item">
                                            <ul>
                                                <?php foreach ($goi_data as $data): ?>

                                                    <?php if ($data === 'Phone'): ?>
                                                        <li>
                                                            <div class="list-data">
                                                                <div class="info-table-data">
                                                                    <span class="icon-phone"></span>
                                                                    <div class="name-info-data">
                                                                        <span>Phone number available</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($data === 'Voice'): ?>
                                                        <li>
                                                            <div class="list-data">
                                                                <div class="info-table-data">
                                                                    <span class="icon-voice"></span>
                                                                    <div class="name-info-data">
                                                                        <span>Outgoing calls included</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($data === 'Globe'): ?>
                                                        <li>
                                                            <div class="list-data">
                                                                <div class="info-table-data">
                                                                    <span class="icon-global"></span>
                                                                    <div class="name-info-data">
                                                                        <span> Low latency</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if ($data === 'Callendar'): ?>
                                                        <li>
                                                            <div class="list-data">
                                                                <div class="info-table-data">
                                                                    <span class="icon-calendar"></span>
                                                                    <div class="name-info-data">
                                                                        <span>Subscription based plan</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php if (!empty($note)): ?>
                                                    <li>
                                                        <div class="list-data">
                                                            <div class="info-table-data">
                                                                <span class="icon-note"></span>
                                                                <div class="name-info-data">
                                                                    <span>
                                                                        <?php echo $note; ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <div class="offers-list-item size" style="text-align: center;">
                                            <?php echo $size ?>
                                        </div>
                                        <div class="offers-list-item validity" style="text-align: center;">
                                            <?php echo $validity ?>
                                        </div>
                                        <div class="offers-list-item data-product">
                                            <p>
                                                <?php echo $price_gb ?>
                                            </p>
                                        </div>
                                        <div class="offers-list-item price-product" style="text-align: center;">
                                            <?php
                                            echo $price;
                                            ?>
                                        </div>
                                        <div class="offers-list-item" style="text-align: center;">
                                            <span class="icon-next"></span>
                                        </div>
                                    </a>
                                    <!-- -- -->
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<?php

get_footer(); ?>