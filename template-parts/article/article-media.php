<?php

$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template


$images = get_post_meta(get_the_ID(),'images',false);
$video = get_post_meta(get_the_ID(),'video',true);
?>
<ul class="article-media">
    <?php if (is_array($images)) : foreach($images as $m) : if ($m) :?>
    <li>
        <div class="image-container">
            <img data-img-id="<?php echo esc_attr($m) ?>" data-id-size="widescreen-half" class="loading">
        </div>
    </li>
    <?php endif; endforeach; endif; ?>
</ul>
<?php elseif($tpl) : // jsRender template ?>
{{if type==='ovelse' || type==='forlob'}}
<ul class="article-media">
{{if images}}
{{for images}}
    <li>
        <div class="image-container">
            <img data-img-id="{{>#data}}" data-id-size="widescreen-half" class="loading">
        </div>
    </li>
{{/for}}
{{/if}}
</ul>
{{/if}}
<?php endif;
