<?php

    global $post; $user_base = get_author_posts_url( $post->post_author );
    if(get_current_user_id() === (int)$post->post_author) :
    $p = (isset($wp_query->query_vars['usr_page'])) ? esc_attr(urldecode($wp_query->query_vars['usr_page'])) : false;
    $sp = (isset($wp_query->query_vars['usr_subpage'])) ? esc_attr(urldecode($wp_query->query_vars['usr_subpage'])) : false;
    $c = ' class="current-menu-item"';
?>
<nav class="sidebar-menu js-menu sub-nav">
    <ul id="menu-sidemenu" class="menu">
        <li<?php echo ($p === 'forlob' || $sp === 'forlob') ? $c : ''; ?>>
            <a href="#">Forløb</a>
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
            </svg>
            <ul class="sub-menu">
                <li>
	                <a href="<?php echo $user_base ?>forlob/">Oprettet af mig</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>forlob/saved">Gemt af mig</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>forlob/draft">Mine kladder</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>edit/forlob">+ Opret nyt forløb</a>
                </li>
            </ul>
        </li>
        <li<?php echo ($p === 'ovelse' || $sp === 'ovelse') ? $c : ''; ?>>
            <a href="#">Øvelser</a>
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
            </svg>
            <ul class="sub-menu">
                <li>
	                <a href="<?php echo $user_base ?>ovelse/">Oprettet af mig</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>ovelse/saved">Gemt af mig</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>ovelse/draft">Mine kladder</a>
                </li>
                <li>
	                <a href="<?php echo $user_base ?>edit/ovelse">+ Opret ny øvelse</a>
                </li>
            </ul>
        </li>
        <li<?php echo ($p === 'profile') ? $c : ''; ?>>
            <a href="#">Kontoindstillinger</a>
            <svg>
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
            </svg>
            <ul class="sub-menu">
	            <li>
	                <a href="<?php echo $user_base ?>profile/">Rediger profil</a>
                </li>
                <li>
	                <?php smamo_flogin('true', __('Tilknyt Facebook','smamo'), $user_base ); ?>
                </li>
                <li>
                    <a href="<?php echo wp_logout_url( home_url() ); ?>">Log ud af Atlex</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>


<?php endif;
