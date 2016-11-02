<?php
if($p && 'ovelse' !== $p->post_type){$p = false;}
$video_id = ($p && get_post_meta($p->ID,'video-id',true)) ? esc_attr(get_post_meta($p->ID,'video-id',true)) : false;


?>
<form class="ajax-form ovelse-form" action="<?php echo admin_url('admin-ajax.php') ?>">
    <?php if ($video_id) : ?>
    <input type="hidden" name="video-id" value="<?php echo $video_id ?>">
    <?php endif; ?>
    <input type="hidden" name="action" value="form_submit">
    <input type="hidden" name="do" value="insert-post">
    <input type="hidden" name="post-id" value="<?php echo ($p) ? esc_attr($p->ID): '0'; ?>">
    <?php if ($p && has_post_thumbnail($p->ID)) : $img = get_post_thumbnail_id( $p->ID ); ?>
    <input type="hidden" name="coverphoto" id="image-<?php echo $img ?>" value="<?php echo $img ?>" data-url="<?php echo wp_get_attachment_image_url($img,'dz'); ?>">
    <?php endif; if ($p && !empty(get_post_meta($p->ID,'images',false))) : foreach(get_post_meta($p->ID,'images',false) as $img) : ?>
    <input type="hidden" id="image-<?php echo $img ?>" name="images[]" value="<?php echo $img ?>" data-url="<?php echo wp_get_attachment_image_url($img,'dz'); ?>">
    <?php endforeach; endif; ?>
    <input type="hidden" name="post-type" value="ovelse">
    <?php wp_nonce_field(); ?>
    <section class="form-section" id="ovelse-title">
        <fieldset>
            <label for="title">Navngiv din øvelse</label>
            <?php $val = ($p) ? ' value="'.$p->post_title.'"': ''; ?>
            <input type="text" name="title" placeholder="Øvelsens navn" maxlength="60" required<?php echo $val; ?>>
        </fieldset>
    </section>
    <section class="form-section" id="ovelse-content">
        <fieldset>
            <label for="content">Beskriv din øvelse</label>
            <textarea name="content" rows="4" placeholder="Beskrive med ord" maxlength="1500" required><?php echo ($p) ? $p->post_content : ''; ?></textarea>
        </fieldset>
    </section>
    <section class="form-section" id="ovelse-images">
        <div class="images">
            <fieldset class="file-upload inline">
                <label for="cover-photo">Coverbillede (1)</label>
                <div class="file-upload-dz gold cover-photo" data-max="1"></div>
            </fieldset>
            <fieldset class="file-upload inline">
                <label for="photos">Flere billeder (max 4)</label>
                <div class="file-upload-dz" data-max="4"></div>
            </fieldset>
        </div>
    </section>
    <section class="form-section" id="ovelse-video">
        <fieldset class="video-upload<?php echo ($video_id) ? ' has-video': ''; ?>">
            <label id="videotitle">Video <span id="video-statustext"></span></label>
            <div class="video-input">
                <input type="file" id="video-file" accept="video/*" >
                <input type="button" name="Upload" value="Upload" id="video-upload-btn" >
            </div>
            <div class="video-preview">
                <iframe src="<?php if ($video_id) { echo 'https://youtube.com/embed/' . $video_id; }?>" frameborder="0"></iframe>
                <a href="#" class="video-preview-delete">Slet</a>
            </div>
        </fieldset>
    </section>
    <section class="form-section" id="ovelse-type">
        <p class="p-label">Øvelsestype</p>
        <?php $active_terms = array(); if ($p) {$p_terms = wp_get_post_terms($p->ID,'type'); foreach($p_terms as $p_term) { $active_terms[] = $p_term->term_id; }}?>
        <?php $terms = get_terms('type',array('hide_empty' => false)); foreach($terms as $t) : ?>
        <fieldset class="cb">
            <label for="type[]"><?php echo $t->name ?></label>
            <input type="checkbox" name="type[]" value="<?php echo $t->term_id ?>"<?php if(in_array($t->term_id,$active_terms)){ echo ' checked';} ?>>
        </fieldset>
        <?php endforeach; ?>
    </section>
    <section class="form-section">
        <?php if ($forlob_ovelse) : ?>
        <fieldset class="align-center">
            <a class="submit wp-save-to-forlob gold">Gem og tilføj til forløb</a>
        </fieldset>
        <?php else : if (!$p || 'draft' === $p->post_status) : ?>
        <fieldset class="align-center">
            <input type="submit" name="wp-save-draft" value="Gem kladde" class="draft">
        </fieldset>
        <?php endif; ?>
        <fieldset class="align-center">
            <input type="submit" name="wp-submit" class="gold" value="<?php echo ($p && 'draft' !== $p->post_status)  ? 'Gem ændringer' : 'Udgiv';?>">
        </fieldset>
        <?php endif; ?>
    </section>
</form>
