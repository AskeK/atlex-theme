<?php

$saved_o = get_user_meta(get_current_user_id(),'saved_ovelse',false);
$lis = get_posts(array(
    'post_type' => 'ovelse',
    'post_author' => get_current_user_id(),
    'posts__in' => $saved_o,
    'posts_per_page' => -1,
    'post_status' => array('draft','publish'),
));

if($p && 'forlob' !== $p->post_type){$p = false;}
if($p && 'forlob' === $p->post_type){

    $att = get_post_meta($p->ID,'attach_ovelse',false);
    $a_o = false;
    if(!empty($att)){
        $a_o = new WP_Query(array(
            'post__in' => $att,
            'orderby' => 'post__in',
            'post_type' => 'ovelse',
            'post_status' => array('publish','draft'),
        ));
    }
}

?>
<form class="ajax-form forlob-form" action="<?php echo admin_url('admin-ajax.php') ?>">
    <input type="hidden" name="action" value="form_submit">
    <input type="hidden" name="do" value="insert-post">
    <input type="hidden" name="post-id" value="<?php echo ($p) ? esc_attr($p->ID): '0'; ?>">
    <?php if ($p && has_post_thumbnail($p->ID)) : $src = wp_get_attachment_image_url(get_post_thumbnail_id( $p->ID),'dz');?>
    <input type="hidden" name="coverphoto" value="<?php echo get_post_thumbnail_id( $p->ID ); ?>" data-url="<?php echo $src ?>">
    <?php endif; if ($p && !empty(get_post_meta($p->ID,'images',false))) : foreach(get_post_meta($p->ID,'images',false) as $img) : $src = wp_get_attachment_image_url($img,'dz'); ?>
    <input type="hidden" name="images[]" value="<?php echo $img ?>" data-url="<?php echo $src ?>">
    <?php endforeach; endif; ?>
    <input type="hidden" name="post-type" value="forlob">
    <?php wp_nonce_field(); ?>
    <section class="form-section" id="forlob-title">
        <fieldset>
            <label for="title">Navngiv forløbet</label>
            <?php $val = ($p) ? ' value="'.$p->post_title.'"': ''; ?>
            <input type="text" name="title" placeholder="Forløbets navn" maxlength="60" required<?php echo $val; ?>>
        </fieldset>
    </section>
    <section class="form-section" id="forlob-images">
        <div class="images">
            <fieldset class="file-upload inline">
                <label for="cover-photo">Coverbillede (1)</label>
                <div class="file-upload-dz gold cover-photo" data-max="1"></div>
            </fieldset>
        </div>
    </section>
    <section class="form-section" id="forlob-content">
        <fieldset>
            <label for="content">Beskriv forløbet</label>
            <textarea name="content" rows="4" placeholder="Beskriv med ord" maxlength="1500" required><?php echo ($p) ? $p->post_content : ''; ?></textarea>
        </fieldset>
    </section>
    <section class="form-section" id="forlob-added-ovelse">
        <p class="p-label">De øvelser du har tilføjet vises her</p>
        <ul class="attach-ovelse-list" id="attach-ovelse-list">
           <?php if($a_o && $a_o->have_posts()) : while($a_o->have_posts()) : $a_o->the_post(); ?>
               <?php get_template_part('template-parts/modules/attach-ovelse'); ?>
           <?php endwhile; endif; wp_reset_postdata(); ?>
        </ul>
    </section>
    <section class="form-section" id="forlob-add-ovelse">
        <fieldset class="typeselect">
            <label for="ovelse-picker">Tilføj øvelse eller opret en ny</label>
            <input type="text" name="ovelse-picker" placeholder="skriv et øvelsesnavn eller vælg på listen">
            <input type="hidden" name="ovelse-picker-id" value="">
            <ul>
                <?php foreach($lis as $li) : ?>
                <li data-option="<?php echo $li->ID ?>"><?php echo $li->post_title ?></li>
                <?php endforeach; ?>
            </ul>
            <a class="input-btn"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-expand"></use></svg></a>
        </fieldset>
        <fieldset class="align-center">
            <a class="submit gold add-btn">Tilføj den valgte øvelse</a>
            <span class="inline-or">Eller</span>
            <a class="submit article-page-toggle" data-page="2" data-nav-to="ovelse-title" href="#">Opret en helt ny øvelse</a>
        </fieldset>
    </section>
    <section class="form-section">
        <?php if (!$p || 'draft' === $p->post_status) : ?>
        <fieldset class="align-center">
            <input type="submit" name="wp-save-draft" value="Gem kladde" class="draft">
        </fieldset>
        <?php endif; ?>
        <fieldset class="align-center">
            <input type="submit" name="wp-submit" class="gold" value="<?php echo ($p && 'draft' !== $p->post_status)  ? 'Gem ændringer' : 'Udgiv';?>">
        </fieldset>
    </section>
</form>
