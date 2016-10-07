<?php

$tpl = $GLOBALS['jstemplates'];
if (!$tpl) :

if (in_array(get_post_type(get_the_ID()),array('forlob','ovelse'))) :
$saved_posts = (is_user_logged_in()) ? get_user_meta(get_current_user_id(),'saved_posts',false) : array();
$checked = (in_array(get_the_ID(),$saved_posts) ) ? ' checked': '';

$text = ('ovelse' === get_post_type(get_the_ID())) ? 'Vil du huske denne øvelse?': 'Vil du huske dette forløb?';

?>
<div class="article-save-post<?php echo $checked ?>">
    <input type="checkbox" name="save-post" class="article-save-post-cb" <?php echo $checked ?>>
    <span><?php echo $text ?></span>
</div>
<?php endif; else : ?>
{{* window.checked = ''}}
{{if ~current_user}}
    {{for ~current_user.saved_posts ~post_id=id}}
        {{if ~post_id == #data}}
        {{* checked = ' checked'}}
        {{/if}}
    {{/for}}
{{/if}}
<div class="article-save-post{{*:checked}}">
    <input type="checkbox" name="save-post" class="article-save-post-cb"{{*:checked}}>
    <span>{{if type === 'ovelse'}}Vil du huske denne øvelse?{{else}}Vil du huske dette forløb?{{/if}}</span>
</div>
<?php endif;
