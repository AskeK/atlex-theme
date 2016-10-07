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
        <a href="#" class="item-finder-list-nav prev"><svg><use xlink:href="#icon-collapse"></use></svg></a>
        <a href="#" class="item-finder-list-nav next"><svg><use xlink:href="#icon-expand"></use></svg></a>
        <ul>

           <li data-slug="false"<?php if (!is_tax('type')){ echo 'class="active"';}?>>
                <a href="#">
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
    <div class="item-finder-ranges">

        <?php $terms = get_terms('styrke',array('hide_empty' => false)); foreach($terms as $t) : ?>
        <fieldset class="range range-step">
            <label for="<?php echo $t->slug ?>"><?php echo $t->name ?></label>
            <output>nej</output>
            <input data-term="styrke" data-term-id="<?php echo $t->term_id; ?>" type="range" value="0" name="<?php echo $t->slug ?>">
        </fieldset>
        <?php endforeach; ?>
        <fieldset class="range range-postfix" data-postfix="minut;minutter">
            <label for="time">Tid minimum</label>
            <output>1 minut</output>
            <input data-meta="time" data-meta-compare=">" type="range" value="1" min="1" max="90" name="time">
        </fieldset>
    </div>
</form>
