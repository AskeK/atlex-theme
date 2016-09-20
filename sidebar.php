
<div class="fixed-aside">
    <a href="#" class="fixed-aside-toggle">
        <svg><use xlink:href=#icon-settings></use></svg>
    </a>
    <div class="inner">
    <?php
    $template = array(

        'home'      => is_front_page(),
        '404'       => is_404(),
        'search'    => is_search(),
        'author'    => is_author(),
        'archive'   => is_home() || is_archive(),
        'page'      => is_page() && is_singular(),
        'single'    => is_singular() || is_single(),

    );

    $f = true;
    foreach($template as $t => $b){
        if($b && $f){
            get_template_part('template-parts/sidebar/' . $t);
            $f = false; // hent kun første godkendte template
        }
    }

    ?>
    </div>
</div>
