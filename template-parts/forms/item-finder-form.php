<form method="get" action="" class="item-finder-form">
    <a href="#" data-type="ovelse" class="item-finder-toggle active">Øvelser</a>
    <a href="#" data-type="forlob" class="item-finder-toggle">Forløb</a>
    <div class="item-finder-list">
        <a href="#" class="item-finder-list-nav prev"><svg><use xlink:href="#icon-collapse"></use></svg></a>
        <a href="#" class="item-finder-list-nav next"><svg><use xlink:href="#icon-expand"></use></svg></a>
        <ul>

           <li class="active" data-slug="false">
                <a href="#">
                    <span>Alle Øvelser</span>
                    <i><?php echo count(get_posts(array('post_type' => 'ovelse', 'numberposts' => -1))); ?></i>
                </a>
            </li>
            <?php $types = get_terms('type'); foreach($types as $type) : ?>
            <li data-slug="<?php echo $type->slug ?>">
                <a href="<?php echo get_term_link($type->term_id) ?>">
                    <span><?php echo esc_attr($type->name); ?></span>
                    <i><?php echo count(get_posts(array('post_type' => 'ovelse','type' => $type->slug))) ?></i>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="item-finder-ranges">

        <fieldset class="range range-step">
            <label for="arms">Arme</label>
            <output>nej</output>
            <input type="range" value="0" name="arms">
        </fieldset>

        <fieldset class="range range-step">
            <label for="legs">Ben</label>
            <output>nej</output>
            <input type="range" value="0" name="legs">
        </fieldset>

        <fieldset class="range range-step">
            <label for="abs">Mave</label>
            <output>nej</output>
            <input type="range" value="0" name="abs">
        </fieldset>

        <fieldset class="range range-step">
            <label for="chest">Bryst</label>
            <output>nej</output>
            <input type="range" value="0" name="chest">
        </fieldset>

        <fieldset class="range range-step">
            <label for="back">Ryg</label>
            <output>nej</output>
            <input type="range" value="0" name="back">
        </fieldset>

        <fieldset class="range range-postfix" data-postfix="minut;minutter">
            <label for="time">Tid</label>
            <output>1 minut</output>
            <input type="range" value="1" min="1" max="90" name="time">
        </fieldset>

    </div>
</form>
