<article class="form-article">
<header>
    <h1>Du er ved at oprette en ny øvelse</h1>
</header>
<form class="ajax-form" action="<?php echo admin_url('admin-ajax.php') ?>">
    <input type="hidden" name="action" value="form_submit">
    <input type="hidden" name="do" value="insert-post">
    <input type="hidden" name="post-id" value="<?php echo (isset($_GET['id'])) ? esc_attr($_GET['id']): '0'; ?>">
    <input type="hidden" name="cover-photo" value="">
    <input type="hidden" name="post-type" value="ovelse">
    <?php wp_nonce_field(); ?>
    <section class="form-section">
        <fieldset>
            <label for="title">Navngiv din øvelse</label>
            <input type="text" name="title" placeholder="Øvelsens navn" maxlength="60" required>
        </fieldset>
    </section>
    <section class="form-section">
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
    <section class="form-section">
        <fieldset>
            <label for="content">Beskriv din øvelse</label>
            <textarea name="content" rows="4" placeholder="Beskrive med ord" maxlength="1500" required></textarea>
        </fieldset>
    </section>
    <section class="form-section">
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
    <section class="form-section">
        <p class="p-label">Denne øvelse styrker</p>
        <?php $terms = get_terms('styrke',array('hide_empty' => false)); foreach($terms as $t) : ?>
        <fieldset class="cb">
            <label for="styrke[]"><?php echo $t->name ?></label>
            <input type="checkbox" name="styrke[]" value="<?php echo $t->term_id ?>">
        </fieldset>
        <?php endforeach; ?>
    </section>
    <section class="form-section">
        <fieldset class="range range-postfix" data-postfix="minut;minutter">
            <label for="time">Hvor lang tid tager øvelsen ca.</label>
            <output>1 minut</output>
            <input data-meta="time" data-meta-compare=">" type="range" value="1" min="1" max="90" name="time">
        </fieldset>
    </section>
    <section class="form-section">
        <fieldset class="align-center">
            <input type="submit" name="wp-save-draft" value="Gem kladde" class="draft">
        </fieldset>
        <fieldset class="align-center">
            <input type="submit" name="wp-submit" class="gold" value="Udgiv øvelsen">
        </fieldset>
    </section>
</form>
</article>
