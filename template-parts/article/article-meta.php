<?php
$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template

$images = get_post_meta(get_the_ID(),'images',false);
$video = get_post_meta(get_the_ID(),'video-id',true);
$count_str = '';
$img_count = (has_post_thumbnail()) ? 1 : 0;
$vid_count = 0;
if (is_array($images) && !empty($images[0])) {
    foreach($images as $m){
        $img_count ++;
    }
}

if ($video) {
    $vid_count =1;
}

if ('ovelse' === get_post_type(get_the_ID())){
    $count_str = $img_count . ' billede' . ( $img_count !== 1 ? 'r' : '' ) . ' / ';
    $count_str .= $vid_count . ' video' . ( $vid_count !== 1 ? 'er' : '' );
}

elseif('forlob' === get_post_type(get_the_ID())){
    $count_str = count(get_post_meta(get_the_ID(),'attach_ovelse',false)) . ' Øvelser';
}

?>
<div class="article-author"><?php the_author(); ?></div>
<div class="article-saved-count"><span><?php echo (get_post_meta(get_the_ID(),'saved_count', true )) ? get_post_meta(get_the_ID(),'saved_count', true ) : '0'; ?></span> anvender</div>
<?php if ($count_str) : ?>
<div class="article-media-count"><?php echo $count_str ?></div>
<?php endif; ?>
<?php elseif($tpl): ?>
{{if type==='ovelse' || type==='forlob'}}
<div class="article-author">{{:author_name}}</div>
<div class="article-saved-count"><span>{{:saved_count || '0'}}</span> anvender</div>
<div class="article-media-count">
{{if type === 'ovelse'}}
    {{* window.mc = 0; window.vc = 0; }}
    {{if has_cover==true}}
    {{* mc = 1;}}
    {{/if}}
    {{for images}}
        {{* mc ++; }}
    {{/for}}
    {{if video-id}}
        {{* vc = 1; }}
    {{/if}}
    {{* :mc }} billede{{if mc!==1}}r{{/if}} / {{* :vc }} video{{if vc!=='1'}}er{{/if}}
{{else}}
    {{* window.oc = 0;}}
    {{for attach_ovelse}}
        {{* oc ++}}
    {{/for}}
    {{* :oc}} øvelser
{{/if}}
</div>
{{/if}}
<?php endif;
