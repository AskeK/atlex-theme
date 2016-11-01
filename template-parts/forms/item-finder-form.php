<?php $cur_term = false; if (is_tax('type')){$cur_term = get_query_var('type');} ?>
<form method="get" action="" class="item-finder-form">
    <a href="#" data-type="ovelse" class="item-finder-toggle toggle-ovelse<?php echo ('ovelse' === get_post_type(get_the_ID()) || is_home()) ? ' active': ''; ?>">
        <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-ovelser"></use></svg>
        <span>Øvelser</span>
    </a>
    <a href="#" data-type="forlob" class="item-finder-toggle toggle-forlob<?php echo ('forlob' === get_post_type(get_the_ID()) && !is_home()) ? ' active': ''; ?>">
        <svg viewBox="0 0 50 50"><use xlink:href="#icon-alle-forlob"></use></svg>
        <span>Forløb</span>
    </a>
    <div class="item-finder-list">
        <ul>
           <li data-slug="false"<?php if (!is_tax('type')){ echo 'class="active"';}?>>
                <a href="<?php echo esc_url(get_bloginfo('url')); ?>/ovelse/">
                    <span>Alle Øvelser</span>
                    <i><?php echo count(get_posts(array('post_type' => 'ovelse', 'numberposts' => -1))); ?></i>
                </a>
            </li>
            <?php $types = get_terms('type'); foreach($types as $type) :?>
            <li data-slug="<?php echo $type->slug ?>" <?php if ($type->slug === $cur_term){echo ' class="active"';} ?>>
                <a href="<?php echo get_term_link($type->term_id) ?>">
                    <span><?php echo esc_attr($type->name); ?></span>
                    <i><?php echo count(get_posts(array('post_type' => 'ovelse','type' => $type->slug))) ?></i>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</form>
