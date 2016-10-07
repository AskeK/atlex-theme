<?php

$tpl = $GLOBALS['jstemplates'];
if (!$tpl){

    $post_class = 'main-article post-' . get_the_ID();
    if($GLOBALS['current_id'] === get_the_ID() ){$post_class .= ' current expanded';}
    else{$post_class .= ' collapsed';}

    $post_class .= ' post-type-' . get_post_type(get_the_ID());

    $saved_posts = (is_user_logged_in()) ? get_user_meta(get_current_user_id(),'saved_posts',false) : array();
    $post_class .= (in_array(get_the_ID(),$saved_posts) ) ? ' saved': '';
}

else { $post_class = 'main-article post-{{:id}} collapsed post-type-{{:type}} {{* :saved}}'; }

$mv = array(
    'id'        => (!$tpl) ? get_the_ID() : '{{:id}}',
    'type'      => (!$tpl) ? get_post_type(get_the_ID()) : '{{:type}}',
    'title'     => (!$tpl) ? get_the_title() : '{{:title.rendered}}',
    'type'      => (!$tpl) ? get_post_type(get_the_ID()) : '{{:title.rendered}}',
    'link'      => (!$tpl) ? get_the_permalink() : '{{:link}}',
    'fb_link'   => (!$tpl) ? smamo_share(get_the_ID(), 'fb') : '{{:fb_link}}',
    'tw_link'   => (!$tpl) ? smamo_share(get_the_ID(), 'tw') : '{{:tw_link}}',
    'img'       => (!$tpl) ? get_image_link(get_the_ID(), 'widescreen') : '{{:img.widescreen}}',
    'content'   => (!$tpl) ? apply_filters('the_content', get_the_content()) : '{{:content.rendered}}',
    't'         => (!$tpl) ? get_post_meta(get_the_ID(),'time',true) : '{{:time}}',
);

if($tpl){
    $mv['s'] = '{{:styrke}}';
    $mv['ao'] = '{{*window.ovelse_count=0}}{{for attach_ovelse}}{{* ovelse_count++}}{{:#data}},{{/for}}';
    echo '{{* window.saved = ""}}{{if ~current_user}} {{for ~current_user.saved_posts ~post_id=id}} {{if ~post_id == #data}} {{* saved = " saved"}} {{/if}} {{/for}}{{/if}}';
}

else{

    $mv['s'] = '';
    $s = wp_get_post_terms(get_the_ID(),'styrke');
    $i = 0;
    foreach($s as $s){
        $i ++; if($i !== 1){ $mv['s'] .= ',';}
        $mv['s'] .= $s->term_id;
    }

    $mv['ao'] = '';
    $ovelse_count = 0;
    if('forlob' === get_post_type(get_the_ID())){
        $o = get_post_meta(get_the_ID(),'attach_ovelse',false);
        if($o && is_array($o)){
            foreach($o as $o){
                $ovelse_count ++; if($ovelse_count !== 1){ $mv['ao'] .= ',';}
                $mv['ao'] .= $o;
            }
        }
    }
}


?>


<article class="<?php echo $post_class ?>" id="post-<?php echo $mv['id'] ?>" data-s="<?php echo $mv['s'] ?>" data-t="<?php echo $mv['t'] ?>" data-a-o="<?php echo $mv['ao'] ?>">
    <a href="<?php echo $mv['link']; ?>" class="article-link"></a>
    <div class="article-img loading" data-bg="<?php echo $mv['img']; ?>"></div>
    <header class="article-header loading" data-bg="<?php echo $mv['img'] ?>">
    </header>
    <div class="article-title">
        <h1><?php echo $mv['title']; ?></h1>
        <svg><use xlink:href="#icon-read-more"></use></svg>
    </div>
    <div class="article-meta">
        <?php get_template_part('template-parts/article/article-meta'); ?>
    </div>
    <div class="article-content wp-styles"><?php echo $mv['content']; ?></div>
    <?php get_template_part('template-parts/article/article-media'); ?>
    <footer class="article-footer">
        <div class="article-footer-social">
            <a target="_blank" href="<?php echo $mv['fb_link']; ?>" class="share-link share-facebook">Facebook</a>
            <a target="_blank" href="<?php echo $mv['tw_link']; ?>" class="share-link share-twitter">Twitter</a>
        </div>
    </footer>
    <?php if ('forlob' === get_post_type(get_the_ID()) && !$tpl) : ?>
    <div class="article-ovelse-count">Dette forløb består af disse <?php echo $ovelse_count; ?> øvelser</div>
    <?php elseif ($tpl) : ?>
    {{if type == 'forlob'}}
    <div class="article-ovelse-count">Dette forløb består af disse {{* :ovelse_count}} øvelser</div>
    {{/if}}
    <?php endif; ?>
    <?php get_template_part('template-parts/article/article-save-post'); ?>
    <?php get_template_part('template-parts/article/article-edit-close'); ?>
</article>
