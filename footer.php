            <footer class="site-footer">
                <div class="footer-branding">
                    <svg viewBox="0 0 254 50"><use xlink:href="#vector-logo"></use></svg>
                </div>
                <div class="footer-logo">
                    <a href="#" class="footer-logo-ol">
                        <img src="<?php echo get_template_directory_uri() ?>/statics/logo-verdens-bedste.png">
                        <span>Verdens mest innovative udendørs idrætsanlæg 2015</span>
                        <span>Den internationale Olympiske Komite</span>
                    </a>
                    <ul class="footer-logo-list">
                        <?php
                        $logos = get_theme_mod('footer_info_logo'); if ($logos) : foreach($logos as $logo) :
                            $img_src = wp_get_attachment_image_url($logo['img']);
                            $target = ($logo['blank']) ? ' target="blank"' : '';
                        ?>
                        <li>
                            <a href="<?php echo esc_url($logo['url']); ?>"<?php echo $target; ?>>
                               <img src="<?php echo $img_src; ?>">
                            </a>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
                <div class="footer-info">
                    <?php $lines = get_theme_mod('footer_info_lines'); if($lines) : foreach($lines as $line) : ?>
                    <span><?php echo esc_attr($line['text']); ?></span>
                    <?php endforeach; endif; ?>
                </div>
            </footer>
        </div>
        <?php get_template_part('template-parts/footer/jstemplates'); ?>
        <?php wp_footer(); ?>
    </body>
</html>
