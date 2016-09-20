<?php // template name: Registreringsside

// redirect logged in users to their page
if(is_user_logged_in()){
    wp_redirect(get_author_posts_url(get_current_user_id()));
}

get_header();
get_template_part('template-parts/header/site-header');

?>
<section class="main-section">
    <main>
        <?php while(have_posts()) : the_post(); ?>
        <article class="form-article">
            <header>
                <h1><?php the_title(); ?></h1>
            </header>
                <section class="article-section">
                    <h2>Log ind på <?php bloginfo('title') ?></h2>
                    <form action="http://192.168.1.4/atlex/wp-login.php" method="post">
                        <input type="hidden" name="rememberme" value="forever">
                        <input type="hidden" name="redirect_to" value="http://192.168.1.4/atlex/login/">

                        <fieldset class="half">
                            <label for="user_login">Brugernavn eller e-mail</label>
                            <input type="text" name="log" id="user_login" class="input" value="" size="20">
                        </fieldset>

                        <fieldset class="half right">
                            <label for="user_pass">Adgangskode</label>
                            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20">
                        </fieldset>
                        <fieldset class="align-center">
                            <input type="submit" name="wp-submit" class="gold" value="Log ind">
                        </fieldset>
                    </form>
                    <span class="login-or"></span>
                    <div class="fb-login">
                        <?php smamo_flogin('true', __('Log ind med Facebook','smamo') ); ?>
                    </div>
                </section>
                <section class="article-section">
                    <h2>Endnu ikke registreret? Opret en ny profil</h2>
                    <?php the_content(); ?>
                    <form action="" method="post" class="registration-form">
                        <fieldset>
                            <label for="usr">Brugernavn</label>
                            <input type="text" name="usr">
                        </fieldset>
                        <fieldset>
                            <label for="email">Email</label>
                            <input type="email" name="email">
                        </fieldset>
                        <fieldset>
                            <label for="description">Profiltekst (valgfri)</label>
                            <textarea name="description" rows="5"></textarea>
                        </fieldset>
                        <fieldset class="half">
                            <label for="fname">Fornavn</label>
                            <input type="text" name="fname">
                        </fieldset>
                        <fieldset class="half right">
                            <label for="lname">Efternavn</label>
                            <input type="text" name="lname">
                        </fieldset>
                        <fieldset class="half">
                            <label for="pass">Adgangskode</label>
                            <input type="password" name="pass">
                        </fieldset>
                        <fieldset class="half right">
                            <label for="pass_2">Gentag adgangskode</label>
                            <input type="password" name="pass_2">
                        </fieldset>
                        <fieldset class="align-center">
                            <input type="submit" name="submit" value="Opret profil og log ind" class="gold">
                        </fieldset>
                    </form>
                </section>
        </article>
        <?php endwhile; ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>
    </aside>
</section>
<?php

get_footer();
