<?php

    $tpl = $GLOBALS['jstemplates'];
    $mv = array(
        'id' => (!$tpl) ? get_the_ID() : '{{:id}}',
        'title' => (!$tpl) ? get_the_title() : '{{:title.rendered}}',
        'author' => (!$tpl) ? get_the_author() : '{{:author_name}}',
        'img' => (!$tpl) ? get_image_link(get_the_ID(), 'dz') : '{{:img.dz}}',
        'blink_class' => (!$tpl) ? '' : ' blink',
    );

?>


<li class="attach-ovelse-item ovelse-item-<?php _e($mv['id']); _e($mv['blink_class']) ?>">
    <div class="ovelse-img" data-bg="<?php _e($mv['img']); ?>"></div>
    <h3 class="ovelse-title"><?php _e($mv['title']); ?></h3>
    <div class="ovelse-meta">
        <span><?php _e($mv['author']); ?></span>
        <span>5 billeder / 1 video</span>
    </div>
    <div class="ovelse-delete">
        <svg><use xlink:href="#icon-cross"></use></svg>
    </div>
    <input type="hidden" class="order" name="attach_ovelse[]" value="<?php _e($mv['id']) ?>">
</li>
