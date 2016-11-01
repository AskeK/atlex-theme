<?php
$tpl = $GLOBALS['jstemplates'];
$mv = array();

if (!$tpl){
    $mv['type'] = get_post_type(get_the_ID());
    $mv['name'] = ('ovelse' === $mv['type']) ? 'øvelser': 'forløb';

    $mv['add-url'] = '#';
    if(is_user_logged_in()){
        $mv['add-url'] = $author_base = get_author_posts_url(get_current_user_id()) . '/edit/' . $mv['type'] . '/';
    }

    else{
        $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'templates/register.php', ));
        foreach($pages as $p){$u_href = get_permalink($p->ID);}

        $mv['add-url'] = $u_href;
    }

}

else {
    $mv['type'] = '{{:type}}';
    $mv['name'] = '{{if "ovelse" === type}}øvelser{{else}}forløb{{/if}}';
    $mv['add-url'] = '#';
}
?>
<header class="article-page-header article-page-header-<?php echo $mv['type'] ?>">
    <h2>Du har fundet disse <?php echo $mv['name']; ?></h2>
    <nav>
        <a href="#" class="order-by-pop">
            <svg viewBox="0 0 16 16"><use xlink:href="#icon-popular"></use></svg>
            <span>Populæreste</span>
        </a>
        <a href="#" class="order-by-rand">
            <svg viewBox="0 0 16 16"><use xlink:href="#icon-random"></use></svg>
            <span>Tilfældige</span>
        </a>
        <a href="<?php echo $mv['add-url'] ?>" class="add-new">
            <svg viewBox="0 0 16 16"><use xlink:href="#icon-plus"></use></svg>
            <span>Tilføj ny</span>
        </a>
    </nav>
</header>
