<?php if($p && 'ovelse' !== $p->post_type){$p = false;} ?>
<form class="ajax-form ovelse-form" action="<?php echo admin_url('admin-ajax.php') ?>">
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
    <!--<section class="form-section" id="ovelse-video">
        <fieldset>
            <p class="p-label">Tilføj en video (1)</p>
            <fieldset class="video-upload">
                <div class="video-upload-dz gold" data-max="1"></div>
            </fieldset>
        </fieldset>
    </section> -->
    <section class="form-section" id="ovelse-type">
        <p class="p-label">Øvelsestype</p>
        <fieldset class="select">
            <span class="select-clone">
                <select name="type[]">
                    <option value="0">Vælg fra listen</option>
                    <?php $terms = get_terms('type',array('hide_empty' => false)); foreach($terms as $t) : ?>
                    <option value="<?php echo $t->term_id ?>"><?php echo $t->name ?></option>
                    <?php endforeach; ?>
                </select>
                <a href="#" class="clone-add"><svg><use xlink:href="#icon-plus"></use></svg></a>
                <a href="#" class="clone-remove"><svg><use xlink:href="#icon-cross"></use></svg></a>
            </span>
        </fieldset>
    </section>
    <section class="form-section" id="ovelse-styrke">
        <p class="p-label">Denne øvelse styrker</p>
        <?php $terms = get_terms('styrke',array('hide_empty' => false)); foreach($terms as $t) : ?>
        <fieldset class="cb">
            <label for="styrke[]"><?php echo $t->name ?></label>
            <input type="checkbox" name="styrke[]" value="<?php echo $t->term_id ?>">
        </fieldset>
        <?php endforeach; ?>
    </section>
    <section class="form-section" id="ovelse-time">
        <fieldset class="range range-postfix" data-postfix="minut;minutter">
            <label for="time">Hvor lang tid tager øvelsen ca.</label>
            <?php $val = ($p) ? get_post_meta($p->ID,'time',true) : 1; ?>
            <output><?php echo $val . ' minut'; echo ($val !== 1) ? 'ter' : ''; ?></output>
            <input data-meta="time" data-meta-compare=">" type="range" value="<?php echo $val ?>" min="1" max="90" name="time">
        </fieldset>
    </section>
    <section class="form-section" id="ovelse-beacon">
        <p class="p-label">Øvelsens placering</p>
        <fieldset class="select">
            <span>
                <select name="beacon">
                    <option value="0">Tilføj en placering på Atlex hvor øvelsen skal udføres (iBeacon)</option>
                    <?php $b = get_posts(array('post_type' => 'beacon','posts_per_page' => -1)); foreach($b as $b) : ?>
                    <option value="<?php echo $b->ID ?>"><?php echo $b->post_title ?></option>
                    <?php endforeach; ?>
                </select>
            </span>
    </fieldset>
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
