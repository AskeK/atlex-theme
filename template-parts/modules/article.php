<?php
$post_class = 'main-article';
if($GLOBALS['current_id'] === get_the_ID() ){
    $post_class .= ' current expanded';
}
else{
    $post_class .= ' collapsed';
}

?>
<article <?php  post_class($post_class); ?>>
    <a href="<?php the_permalink(); ?>" class="article-link"></a>

    <div class="article-img" data-bg="<?php echo get_image_link(get_the_ID()); ?>"></div>
    <header class="article-title">
        <?php the_title('<h1>','</h1>'); ?>
        <svg><use xlink:href="#icon-read-more"></use></svg>
        <span class="article-media-count">3 fotos / 1 video</span>
    </header>
    <div class="article-content wp-styles">
        <?php the_content(); ?>
    </div>
    <div class="article-media"></div>
    <footer class="article-footer">
        <a target="_blank" href="<?php echo smamo_share(get_the_ID(), 'fb'); ?>" class="share-link share-facebook">Facebook</a>
        <a target="_blank" href="<?php echo smamo_share( get_the_ID(), 'tw'); ?>" class="share-link share-twitter">Twitter</a>
    </footer>
</article>
