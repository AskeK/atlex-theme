<?php

$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template

$media = get_post_meta(get_the_ID(),'media',true);

?>
<ul class="article-media">
    <?php if (is_array($media)) : foreach($media as $m) : ?>
    <li>
        <?php if ($m['media_type'] === '1' ) : ?>
        <div class="image-container">
            <img data-id="<?php echo $m['img']['0'] ?>" data-id-size="widescreen">
        </div>
        <?php else : ?>
        <div class="video-container">
            <iframe src="<?php echo esc_url($m['video_url']) ?>" frameborder="0"></iframe>
        </div>
        <?php endif; ?>
    </li>
    <?php endforeach; endif; ?>
</ul>
<?php elseif($tpl) : // jsRender template ?>
{{if type==='ovelse' || type==='forlob'}}
<ul class="article-media">
{{for media}}
    {{if media_type==='1'}}
    <li>
        <div class="image-container">
            <img data-id="{{:img[0]}}" data-size="widescreen">
        </div>
    </li>
    {{/if}}
    {{if media_type && media_type!=='1'}}
    <li>
        <div class="video-container">
            <iframe src="{{:video_url}}" frameborder="0"></iframe>
        </div>
    </li>
    {{/if}}
{{/for}}
</ul>
{{/if}}
<?php endif;
