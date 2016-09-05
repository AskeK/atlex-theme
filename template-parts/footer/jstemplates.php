<?php
$GLOBALS['jstemplates'] = true;
$tpls = array(
    'article',
);

foreach($tpls as $tpl) : ?>
<script type="text/x-jsrender" id="jsTemplate-<?php echo $tpl; ?>">
   <?php get_template_part('template-parts/modules/' . $tpl); ?>
</script>
<?php endforeach;
