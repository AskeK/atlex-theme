<header class="main-header" data-bg="<?php echo get_image_link(get_the_ID()); ?>">
    <ul class="article-breadcrumbs">
        <?php foreach( get_post_ancestors(get_the_ID()) as $id) : $p = get_post($id);?>
        <li><a href="<?php echo get_permalink($id) ?>"><?php echo $p->post_name ?></a></li>
        <?php endforeach; ?>
        <li><span><?php the_title(); ?></span></li>
    </ul>
    <div class="share-links">
        <a target="_blank" href="<?php echo smamo_share(get_the_ID(), 'fb'); ?>" class="share-link share-facebook">Facebook</a>
        <a target="_blank" href="<?php echo smamo_share( get_the_ID(), 'tw'); ?>" class="share-link share-twitter">Twitter</a>
    </div>
</header>
