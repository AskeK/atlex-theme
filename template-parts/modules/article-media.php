<?php

$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template


$images = get_post_meta(get_the_ID(),'images',false);
$video = get_post_meta(get_the_ID(),'video',true);

?>
<ul class="article-media">
    <?php if (is_array($images)) : foreach($images as $m) : ?>
    <li>
        <div class="image-container">
            <img data-id="<?php echo $m ?>" data-id-size="widescreen">
        </div>
    </li>
    <?php endforeach; endif; ?>
</ul>
<?php elseif($tpl) : // jsRender template ?>
{{if type==='ovelse' || type==='forlob'}}
<ul class="article-media">
{{for images}}
    <li>
        <div class="image-container">
            <img data-id="{{:img[0]}}" data-size="widescreen">
        </div>
    </li>
{{/for}}
</ul>
{{/if}}
<?php endif;
