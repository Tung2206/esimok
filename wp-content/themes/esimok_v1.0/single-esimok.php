<?php
/*
 * The template for displaying all single visa_services
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-07-19
 * 
 * @package Esimok
 * @version 3.5.1
 */

get_header();

get_template_part(
	'template-parts/header/breadcrumb',
	null,
	array(
		'type' => 'post',
		'object_id' => $post->ID,
		'object_type' => null
	)
);
?>

<div id="body">
    <section class="single-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        while (have_posts()) :
                        the_post(); 
                        $esimok_link_website = get_field('esimok_link_website');       
                        $esimok_info = get_field('esimok_thong_tin_goi_cuoc');
                        $provider = $esimok_info['esimok_provider'];
                        $plan_name = $esimok_info['esimok_plan_name'];
                        $esimok_ten_goi_cuoc = get_field('esimok_ten_goi_cuoc');        
                    ?>
                    <div class="top-blog">
                        <div class="logo">
                            <img src="<?php echo $provider?>" alt="<?php echo $plan_name;?>">
                        </div>
                        <div class="blog-description">
                            <div class="description">
                                <?php the_content();?>
                            </div>
                            <div class="link-web">
                                <a href="<?php echo $esimok_link_website?>" target="_blank">
                                    Official Website
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.75 4.5C6.15326 4.5 5.58097 4.73705 5.15901 5.15901C4.73705 5.58097 4.5 6.15326 4.5 6.75V17.25C4.5 17.8467 4.73705 18.419 5.15901 18.841C5.58097 19.2629 6.15326 19.5 6.75 19.5H17.25C17.8467 19.5 18.419 19.2629 18.841 18.841C19.2629 18.419 19.5 17.8467 19.5 17.25V13.905C19.5 13.7061 19.579 13.5153 19.7197 13.3747C19.8603 13.234 20.0511 13.155 20.25 13.155C20.4489 13.155 20.6397 13.234 20.7803 13.3747C20.921 13.5153 21 13.7061 21 13.905V17.25C21 18.2446 20.6049 19.1984 19.9016 19.9016C19.1984 20.6049 18.2446 21 17.25 21H6.75C5.75544 21 4.80161 20.6049 4.09835 19.9016C3.39509 19.1984 3 18.2446 3 17.25V6.75C3 5.75544 3.39509 4.80161 4.09835 4.09835C4.80161 3.39509 5.75544 3 6.75 3H10.095C10.2939 3 10.4847 3.07902 10.6253 3.21967C10.766 3.36032 10.845 3.55109 10.845 3.75C10.845 3.94891 10.766 4.13968 10.6253 4.28033C10.4847 4.42098 10.2939 4.5 10.095 4.5H6.75ZM13.155 3.75C13.155 3.55109 13.234 3.36032 13.3747 3.21967C13.5153 3.07902 13.7061 3 13.905 3H20.25C20.4489 3 20.6397 3.07902 20.7803 3.21967C20.921 3.36032 21 3.55109 21 3.75V10.095C21 10.2939 20.921 10.4847 20.7803 10.6253C20.6397 10.766 20.4489 10.845 20.25 10.845C20.0511 10.845 19.8603 10.766 19.7197 10.6253C19.579 10.4847 19.5 10.2939 19.5 10.095V5.562L14.4345 10.626C14.3653 10.6976 14.2826 10.7548 14.1911 10.7941C14.0996 10.8334 14.0011 10.8541 13.9016 10.8549C13.802 10.8558 13.7032 10.8368 13.611 10.7991C13.5189 10.7614 13.4351 10.7057 13.3647 10.6353C13.2943 10.5649 13.2386 10.4811 13.2009 10.389C13.1632 10.2968 13.1442 10.198 13.1451 10.0984C13.1459 9.99886 13.1666 9.90045 13.2059 9.80895C13.2452 9.71744 13.3024 9.63469 13.374 9.5655L18.4395 4.5H13.9035C13.7046 4.5 13.5138 4.42098 13.3732 4.28033C13.2325 4.13968 13.1535 3.94891 13.1535 3.75H13.155Z"
                                            fill="white" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-blog">
                        <h1 class="name">
                            <?php echo $esimok_ten_goi_cuoc?>
                        </h1>
                        <?php $setup_single_esimok = get_field('setup_single_esimok');
                        if ($setup_single_esimok):
                        ?>
                            <div class="single-esim">
                                <p class="option-esimok">Single -country plans</p>
                                <div class="list-single-blog">
                                    <?php 
                                        foreach ($setup_single_esimok as $esimok_item) :
                                        $esimok_ten_nuoc = $esimok_item['esimok_ten_nuoc'];
                                        $esimok_data = $esimok_item['esimok_data'];
                                        $gia_tien = $esimok_item['gia_tien'];
                                        $esimok_mo_ta = $esimok_item['esimok_mo_ta'];
                                        $esimok_ket_noi = $esimok_item['esimok_ket_noi'];
                                        $esimok_link_popup = $esimok_item['esimok_link_popup'];   
                                        
                                    ?>
                                    <div class="item-esim">
                                        <div class="item-esim-info">
                                            <div class="country-name">
                                                <?php echo $esimok_ten_nuoc;?>
                                            </div>
                                            <div class="data-esim">
                                                <div class="data">
                                                    <?php echo $esimok_data;?>
                                                </div>
                                                <div class="price">
                                                    <?php echo $gia_tien;?>
                                                </div>
                                            </div>
                                            <p class="info-option">
                                            <?php echo $esimok_mo_ta;?>
                                            </p>
                                        </div>
                                        <div class="list-use-esim">
                                            <div class="list-services-esim">
                                                <ul>
                                                    <?php 
                                                        foreach ($esimok_ket_noi as $item_ket_noi) {
                                                            ?>
                                                                <li><?php echo $item_ket_noi;?></li>
                                                            <?php
                                                        }
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="plan">
                                                <button type="button" class="btn btn-primary plan-details"
                                                    data-bs-toggle="modal" data-bs-target="#myModal_1">
                                                    Plan details
                                                </button>
                                                <!-- The Modal -->
                                                <div class="modal" id="myModal_1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Plan details</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <h5 class="name-services">Countries covered by this plan
                                                                </h5>
                                                                <div class="list-country">
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/vie.png"
                                                                                alt="Vietnam">
                                                                            <h3 class="item-title">Vietnam</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/jpn.png"
                                                                                alt="Japan">
                                                                            <h3 class="item-title">Japan</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/korea.png"
                                                                                alt="South Korean">
                                                                            <h3 class="item-title">South Korean</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/vie.png"
                                                                                alt="Vietnam">
                                                                            <h3 class="item-title">Vietnam</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/jpn.png"
                                                                                alt="Japan">
                                                                            <h3 class="item-title">Japan</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/korea.png"
                                                                                alt="South Korean">
                                                                            <h3 class="item-title">South Korean</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-success custom-esim-btn">OK</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>  
                            </div>
                        <?php endif; ?>
                        <!--  -->
                        <?php $setup_single_esimok = get_field('setup_multiple_esimok');
                        if ($setup_single_esimok):
                        ?>
                            <div class="multiple-esim">
                                <p class="option-esimok">Multiple-country plans</p>
                                <div class="list-single-blog">
                                    <?php 
                                        foreach ($setup_single_esimok as $esimok_item) :
                                        $esimok_ten_nuoc = $esimok_item['esimok_ten_nuoc'];
                                        $esimok_data = $esimok_item['esimok_data'];
                                        $gia_tien = $esimok_item['gia_tien'];
                                        $esimok_mo_ta = $esimok_item['esimok_mo_ta'];
                                        $esimok_ket_noi = $esimok_item['esimok_ket_noi'];
                                        $esimok_link_popup = $esimok_item['esimok_link_popup'];   
                                        
                                    ?>
                                    <div class="item-esim">
                                        <div class="item-esim-info">
                                            <div class="country-name">
                                                <?php echo $esimok_ten_nuoc;?>
                                            </div>
                                            <div class="data-esim">
                                                <div class="data">
                                                    <?php echo $esimok_data;?>
                                                </div>
                                                <div class="price">
                                                    <?php echo $gia_tien;?>
                                                </div>
                                            </div>
                                            <p class="info-option">
                                            <?php echo $esimok_mo_ta;?>
                                            </p>
                                        </div>
                                        <div class="list-use-esim">
                                            <div class="list-services-esim">
                                                <ul>
                                                    <?php 
                                                        foreach ($esimok_ket_noi as $item_ket_noi) {
                                                            ?>
                                                                <li><?php echo $item_ket_noi;?></li>
                                                            <?php
                                                        }
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="plan">
                                                <button type="button" class="btn btn-primary plan-details"
                                                    data-bs-toggle="modal" data-bs-target="#myModal_1">
                                                    Plan details
                                                </button>
                                                <!-- The Modal -->
                                                <div class="modal" id="myModal_1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Plan details</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <h5 class="name-services">Countries covered by this plan
                                                                </h5>
                                                                <div class="list-country">
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/vie.png"
                                                                                alt="Vietnam">
                                                                            <h3 class="item-title">Vietnam</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/jpn.png"
                                                                                alt="Japan">
                                                                            <h3 class="item-title">Japan</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/korea.png"
                                                                                alt="South Korean">
                                                                            <h3 class="item-title">South Korean</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/vie.png"
                                                                                alt="Vietnam">
                                                                            <h3 class="item-title">Vietnam</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/jpn.png"
                                                                                alt="Japan">
                                                                            <h3 class="item-title">Japan</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/korea.png"
                                                                                alt="South Korean">
                                                                            <h3 class="item-title">South Korean</h3>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-country">
                                                                        <a href="../html/country.html">
                                                                            <img src="../html/assets/images/china.png"
                                                                                alt="China">
                                                                            <h3 class="item-title">China</h3>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-success custom-esim-btn">OK</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>  
                            </div>
                        <?php endif; ?>

                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
</div>


<?php 
wp_enqueue_style('esimok-component-single-esim');

get_footer(); 

?>