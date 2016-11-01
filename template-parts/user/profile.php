<?php $u = wp_get_current_user(); ?>
<article class="form-article">
   <header>
       <h1>Rediger <?php echo esc_attr($u->display_name) ?>'s profil</h1>
   </header>
    <form class="ajax-form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post">
        <input type="hidden" name="action" value="form_submit">
        <input type="hidden" name="do" value="update-user">
        <input type="hidden" name="user_id" value="<?php echo $u->ID ?>">
        <section class="form-section">
            <fieldset class="half">
                <label for="fname">Fornavn</label>
                <input type="text" name="fname" value="<?php echo $u->first_name ?>">
            </fieldset>
            <fieldset class="half right">
                <label for="lname">Efternavn</label>
                <input type="text" name="lname" value="<?php echo $u->last_name ?>">
            </fieldset>
        </section>
        <section class="form-section">
            <fieldset>
                <label for="email">Email adresse</label>
                <input type="email" name="email" value="<?php echo $u->user_email ?>">
            </fieldset>
        </section>
        <section class="form-section">
            <fieldset>
                <label for="pass">Nyt password</label>
                <input type="password" name="pass" autocomplete="new-password">
            </fieldset>
            <fieldset>
                <label for="pass_2">Nyt password (gentag)</label>
                <input type="password" name="pass_2" autocomplete="new-password">
            </fieldset>
        </section>
        <section class="form-section">
            <fieldset class="align-center">
                <input type="submit" name="wp-submit" value="opdater" class="gold">
            </fieldset>
        </section>
    </form>
</article>
