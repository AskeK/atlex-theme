<div class="inner-article collapsed">
    <a href="{{:link}}" class="article-link"></a>
    <div class="article-img loading" data-bg="{{:img.widescreen}}"></div>
    <header class="article-header loading" data-bg="{{:img.widescreen}}?>">
    </header>
    <div class="article-title">
        <h1>{{:title.rendered}}</h1>
        <svg><use xlink:href="#icon-read-more"></use></svg>
    </div>
    <div class="article-meta">
        <?php get_template_part('template-parts/article/article-meta'); ?>
    </div>
    <div class="article-content wp-styles">{{:content.rendered}}</div>
    <?php get_template_part('template-parts/article/article-media'); ?>
    <footer class="article-footer">
        <div class="article-footer-social">
            <a target="_blank" href="{{:fb_link}}" class="share-link share-facebook">Facebook</a>
            <a target="_blank" href="{{:tw_link}}" class="share-link share-twitter">Twitter</a>
        </div>
    </footer>
</div>
