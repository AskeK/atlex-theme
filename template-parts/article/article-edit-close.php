<?php

$tpl = $GLOBALS['jstemplates'];
if (!$tpl) :

global $post;
$cur_user = (is_user_logged_in()) ? (int)get_current_user_id() : false;
$cur_author = (int)$post->post_author;

if ($cur_author === $cur_user && in_array(get_post_type($post->ID),array('ovelse','forlob'))) :

    $edit_link = get_author_posts_url($cur_user) . 'edit/' . $post->ID . '/';
?>
<div class="article-close can-edit">
    <a href="<?php echo esc_url($edit_link); ?>">
        <svg><use xlink:href="#icon-edit"></use></svg>
        <span>Rediger</span>
    </a>
    <a class="article-close-link" href="#">
        <svg><use xlink:href="#icon-cross"></use></svg>
        <span class="open"><?php echo ('ovelse' === get_post_type(get_the_ID())) ? 'Åben beskrivelsen': 'Åben forløbet';?></span>
        <span class="close"><?php echo ('ovelse' === get_post_type(get_the_ID())) ? 'Luk beskrivelsen': 'Luk forløbet';?></span>
    </a>
</div>
<?php elseif (in_array(get_post_type($post->ID),array('ovelse','forlob'))) : ?>
<div class="article-close">
    <a class="article-close-link" href="#">
        <svg><use xlink:href="#icon-cross"></use></svg>
        <span class="open"><?php echo ('ovelse' === get_post_type(get_the_ID())) ? 'Åben beskrivelsen': 'Åben forløbet';?></span>
        <span class="close"><?php echo ('ovelse' === get_post_type(get_the_ID())) ? 'Luk beskrivelsen': 'Luk forløbet';?></span>
    </a>
</div>
<?php endif; else : ?>
<div class="article-close{{if ~current_user }}{{if author === ~current_user.id}} can-edit{{/if}}{{/if}}">
    {{if ~current_user && ~current_user.id === author}}
    <a href="{{:~current_user.link}}edit/{{:id}}">
        <svg><use xlink:href="#icon-edit"></use></svg>
        <span>Rediger</span>
    </a>
    {{/if}}
    <a class="article-close-link" href="#">
        <svg><use xlink:href="#icon-cross"></use></svg>
        <span class="open">{{if type == 'ovelse' }}Åben beskrivelsen{{else}}Åben forløbet{{/if}}</span>
        <span class="close">{{if type == 'ovelse' }}Luk beskrivelsen{{else}}Luk forløbet{{/if}}</span>
    </a>
</div>
<?php endif; ?>
