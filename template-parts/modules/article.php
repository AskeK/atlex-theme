<?php

$tpl = $GLOBALS['jstemplates'];
if (!$tpl){

    $post_class = 'main-article post-' . get_the_ID();
    if($GLOBALS['current_id'] === get_the_ID() ){$post_class .= ' current expanded';}
    else{$post_class .= ' collapsed';}
}

else { $post_class = 'main-article post-{{:id}} current collapsed post-type-{{:type}}'; }

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
);

?>
<article class="<?php echo $post_class ?>" id="post-<?php echo $mv['id'] ?>">
    <a href="<?php echo $mv['link']; ?>" class="article-link"></a>
    <div class="article-img" data-bg="<?php echo $mv['img']; ?>"></div>
    <header class="article-header" data-bg="<?php echo $mv['img'] ?>">
        <ul class="article-breadcrumbs">
            <li><span><?php echo $mv['title']; ?></span></li>
        </ul>
        <div class="share-links">
            <a target="_blank" href="<?php echo $mv['fb_link']; ?>" class="share-link share-facebook">Facebook</a>
            <a target="_blank" href="<?php echo $mv['tw_link']; ?>" class="share-link share-twitter">Twitter</a>
        </div>
    </header>
    <div class="article-title">
        <h1><?php echo $mv['title']; ?></h1>
        <svg><use xlink:href="#icon-read-more"></use></svg>
        <?php get_template_part('template-parts/modules/article-media-count'); ?>
    </div>
    <div class="article-content wp-styles"><?php echo $mv['content']; ?></div>
    <?php get_template_part('template-parts/modules/article-media'); ?>
    <footer class="article-footer">
        <a target="_blank" href="<?php echo $mv['fb_link']; ?>" class="share-link share-facebook">Facebook</a>
        <a target="_blank" href="<?php echo $mv['tw_link']; ?>" class="share-link share-twitter">Twitter</a>
    </footer>
</article>
