<?php

$p = false;
$usr_subpage = (isset($wp_query->query_vars['usr_subpage'])) ? esc_attr(urldecode($wp_query->query_vars['usr_subpage'])) : false;

// Hvis id er indstillet og bruger er logget ind
if ($usr_subpage && is_user_logged_in()){

    $post_author = get_user_by('ID', get_post_field('post_author', esc_attr($usr_subpage)));
    $current_user = wp_get_current_user();

    // Kun brugere som har oprettet denne post kan redigere den
    if($post_author && $post_author->login === $current_user->login){
        $p = get_post($usr_subpage);
    }

    // Medmindre de er administratorer
    elseif(current_user_can('manage_options')){
        $p = get_post($usr_subpage);
    }

    // Sikr at posttypen er enten øvelse eller forløb
    if($p && !in_array($p->post_type, array('ovelse','forlob'))){
        $p = false;
    }
}

// Evt. ny, indstil post type
$post_type = 'ovelse';
if($usr_subpage){

    $post_type = ($p) ? $p->post_type : 'ovelse';
    if(in_array($usr_subpage, array(
        'ovelse',
        'forlob',
    ))){
        $post_type = $usr_subpage;
    }
}

?>
<article class="form-article">
<header>
    <h1>
    <?php
    if($p){ _e('Rediger: ' . $p->post_title, 'smamo'); }
    elseif('forlob' === $post_type){ _e('Du er ved at oprette et nyt forløb','smamo'); }
    else{ _e('Du er ved at oprette en ny øvelse','smamo'); }
    ?>
    </h1>
</header>

    <?php if('ovelse' === $post_type){ include get_template_directory() . '/template-parts/forms/ovelse-form.php';} ?>

    <?php if('forlob' === $post_type) : ?>
    <div class="article-pages" data-page="1">
        <div class="article-page">
            <?php include get_template_directory() . '/template-parts/forms/forlob-form.php'; ?>
        </div>
        <div class="article-page">
            <a href="#" class="article-back-btn clear-ovelse-form">
                <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-expand"></use></svg>
                <span>Fortryd og vend tilbage til forløb</span>
            </a>
            <?php $forlob_ovelse = true; include get_template_directory() . '/template-parts/forms/ovelse-form.php'; ?>
        </div>
    </div>
    <?php endif; ?>

</article>
