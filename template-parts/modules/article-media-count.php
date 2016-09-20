<?php
$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template

$images = get_post_meta(get_the_ID(),'images',false);
$video = get_post_meta(get_the_ID(),'video',false);
$count_str = '';
$img_count = 0;
$vid_count = 0;
if (is_array($images) && !empty($images)) {
    foreach($images as $m){
        $img_count ++;
    }
}

if (is_array($video) && !empty($video[0])) {
    foreach($video as $v){
        $vid_count ++;
    }
}

$count_str = $img_count . ' billede' . ( $img_count !== 1 ? 'r' : '' ) . ' / ';
$count_str .= $vid_count . ' video' . ( $vid_count !== 1 ? 'er' : '' );

?>
<span class="article-media-count"><?php echo $count_str ?></span>
<?php elseif($tpl): ?>
{{if type==='ovelse' || type==='forlob'}}
<span class="article-media-count">
{{* window.mc = 0; window.vc = 0; }}
{{for images}}
    {{* mc ++; }}
{{/for}}
{{for video}}
    {{* vc ++; }}
{{/for}}
{{* :mc }} billede{{if mc!==1}}r{{/if}} / {{* :vc }} video{{if vc!=='1'}}er{{/if}}
</span>
{{/if}}
<?php endif;
