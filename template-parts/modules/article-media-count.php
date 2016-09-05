<?php
$tpl = $GLOBALS['jstemplates'];
if ( !$tpl && !in_array( get_post_type( get_the_ID() ), array('post','page') ) ) : // PHP template

$media = get_post_meta(get_the_ID(),'media',true);
$count_str = '';
$img_count = 0;
$vid_count = 0;
if (is_array($media)) {
    foreach($media as $m){

        if($m['media_type'] === '1'){
            $img_count ++;
        }

        else{
            $vid_count ++;
        }
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
{{for media}}
    {{if media_type==='1'}}
        {{* mc ++; }}
    {{/if}}
    {{if media_type && media_type!=='1'}}
        {{* vc ++; }}
    {{/if}}
{{/for}}
{{* :mc }} billede{{if mc!==1}}r{{/if}} / {{* :vc }} video{{if vc!=='1'}}er{{/if}}
</span>
{{/if}}
<?php endif;
