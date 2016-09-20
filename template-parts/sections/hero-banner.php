<?php

$hb_video = get_theme_mod('front_banner_video');
$hb_img = get_theme_mod('front_banner_img');

if(!$hb_video){
    $hb_video = 'https://www.youtu.be/wSHR0H9QXwY';
}

?>
<section class="hero-banner" style="background-image:url(<?php echo esc_url($hb_img) ?>);">
    <div class="video-container hero-banner-video">
        <div id="ytplayer" data-src="<?php echo esc_url($hb_video) ?>"></div>
    </div>
</section>
