<?php
/*
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-07-19
 * 
 * @package Esimok
 * @version v.1.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly.
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#00A4DA">
    <meta name="msapplication-navbutton-color" content="#00A4DA">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="wrapper">
        <header class="esimokHeader">
            <div class="container">
                <div class="row">
                    <div class="col-10 col-md-9 col-lg-3">
                        <a href="<?php echo home_url() ?>">
                            <img src="<?php echo ESIMOK_THEME_URL ?>/assets/images/esimok-logo.svg" alt="esimok">
                        </a>
                    </div>

                    <div class="col-2 col-md-3 col-lg-9">
                        <div class="esimok_menu_header">
                            <ul>
                                <li>
                                    <a href='#'>Blog</a>
                                </li>
                                <li>
                                    <a href='#'>About us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="esimok_menu_header_mobie">
                            <a class="esimok_menu_bar" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 8.75C3.5 8.26675 3.89175 7.875 4.375 7.875H23.625C24.1082 7.875 24.5 8.26675 24.5 8.75C24.5 9.23325 24.1082 9.625 23.625 9.625H4.375C3.89175 9.625 3.5 9.23325 3.5 8.75Z" fill="#404963" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 14C3.5 13.5168 3.89175 13.125 4.375 13.125H23.625C24.1082 13.125 24.5 13.5168 24.5 14C24.5 14.4832 24.1082 14.875 23.625 14.875H4.375C3.89175 14.875 3.5 14.4832 3.5 14Z" fill="#404963" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 19.25C3.5 18.7668 3.89175 18.375 4.375 18.375H23.625C24.1082 18.375 24.5 18.7668 24.5 19.25C24.5 19.7332 24.1082 20.125 23.625 20.125H4.375C3.89175 20.125 3.5 19.7332 3.5 19.25Z" fill="#404963" />
                                </svg>
                            </a>
                            <div class="esimok_canvasMenu offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <a href="<?php echo home_url() ?>" class='mb-3'>
                                        <svg width="149" height="28" viewBox="0 0 149 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.4201 24.1483C25.6757 24.9978 27.3078 25.6652 29.3795 26.2112C31.3883 26.6966 33.5227 27 35.8455 27.1214C38.4193 27.1214 40.6165 26.6966 42.3742 25.9685C44.132 25.1798 45.5131 24.209 46.392 22.9348C47.2708 21.6607 47.7103 20.2652 47.7103 18.6876C47.7103 16.8674 47.208 15.4112 46.2036 14.3798C45.1992 13.3483 44.0064 12.5596 42.6881 12.0742C41.3698 11.5888 39.6749 11.164 37.6032 10.7393C35.7827 10.3753 34.4644 10.0112 33.6483 9.64719C32.8322 9.28315 32.3928 8.73708 32.3928 8.06966C32.3928 7.34157 32.7066 6.79551 33.3972 6.37079C34.0877 5.94607 35.2177 5.70337 36.7243 5.70337C39.1099 5.70337 41.5582 6.37079 44.132 7.70562L46.4547 2.24494C45.1364 1.51685 43.6298 0.910112 41.9348 0.546067C40.2398 0.182022 38.4821 0 36.7243 0C34.1505 0 31.9533 0.364045 30.2584 1.15281C28.5006 1.8809 27.1195 2.91236 26.2406 4.18652C25.3618 5.46067 24.9223 6.91685 24.9223 8.49438C24.9223 10.3146 25.4245 11.7101 26.3662 12.8022C27.3706 13.8337 28.5006 14.6225 29.8817 15.1079C31.2628 15.5933 32.9577 16.018 34.9666 16.4427C36.7871 16.8674 38.1682 17.2315 38.9843 17.5955C39.8004 17.9596 40.2398 18.5056 40.2398 19.2337C40.2398 20.6292 38.7332 21.3573 35.8455 21.3573C34.2761 21.3573 32.7066 21.1146 31.1372 20.6292C29.505 20.1438 28.1239 19.5371 26.9312 18.7483L24.4201 24.1483ZM7.34487 18.2014H22.4113C22.474 17.1092 22.5368 16.5025 22.5996 16.3811C22.5996 14.1969 22.0974 12.3766 21.093 10.7991C20.0885 9.22159 18.7702 8.06878 17.0753 7.21934C15.3803 6.43058 13.497 6.00586 11.4254 6.00586C9.29095 6.00586 7.34487 6.43058 5.58712 7.34069C3.82938 8.2508 2.51107 9.46429 1.50664 11.0418C0.502213 12.6193 0 14.3789 0 16.3811C0 18.3834 0.502213 20.1429 1.50664 21.7811C2.51107 23.3587 3.95493 24.5721 5.77545 25.4823C7.59598 26.3924 9.73038 26.8171 12.1787 26.8171C16.0708 26.8171 19.0213 25.725 21.0302 23.5407L17.2008 19.6575C16.4475 20.2643 15.7569 20.7497 15.0036 20.9924C14.3131 21.2957 13.4342 21.4171 12.4298 21.4171C11.1115 21.4171 9.98149 21.1137 9.10262 20.5677C8.22374 20.0216 7.65875 19.2328 7.34487 18.2014ZM7.21932 14.5002C7.40765 13.4081 7.90986 12.5587 8.66318 11.9519C9.4165 11.3452 10.3581 11.0418 11.4254 11.0418C12.5553 11.0418 13.497 11.3452 14.2503 11.9519C15.0036 12.6193 15.5058 13.4688 15.6942 14.5002H7.21932ZM51.0371 0.546875H58.6331V26.4547H51.0371V0.546875ZM87.9659 12.6464L88.0281 27H95H104C99.649 24.0071 96.7285 18.7854 96.7285 12.8632C96.7285 7.70519 98.9338 3.0566 102.391 0H95H88.7128L79.5622 15.6183L70.2249 0H64V26.9368H70.9719V13.0258L77.757 24.281H81.1185L87.9659 12.6464ZM144.719 0L133.356 11.4988L148.674 27H137.939L128.02 16.9624L126.074 18.9318V27H118.478V20.3294C117.035 21.3459 115.277 21.9176 113.456 21.9176C108.56 21.9176 104.542 17.8518 104.542 12.8965C104.542 7.94118 108.56 3.87529 113.456 3.87529C115.277 3.87529 117.035 4.44706 118.478 5.46353V0H126.074V8.00471L133.984 0H144.719Z" fill="url(#paint0_linear_460_8187)" />
                                            <defs>
                                                <linearGradient id="paint0_linear_460_8187" x1="0" y1="27" x2="217.605" y2="27" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#08A212" />
                                                    <stop offset="1" stop-color="#65EC14" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </a>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="esimok_itemMenu">
                                        <li>
                                            <a href='#'>Blog</a>
                                        </li>
                                        <li>
                                            <a href='#'>About us</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
