<div class="js-templates">
<?php
$GLOBALS['jstemplates'] = true;
$tpls = array(
    'article',
    'article-no-posts',
    'inner-article',
    'attach-ovelse',
    'article-page-header',
);

foreach($tpls as $tpl) : ?>
<script defer type="text/x-jsrender" id="jsTemplate-<?php echo $tpl; ?>">
   <?php get_template_part('template-parts/modules/' . $tpl); ?>
   <?php get_template_part('template-parts/article/' . $tpl); ?>
</script>
<?php endforeach; ?>
</div>
