<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php  
$cobj = Page::getByID(HOME_CID);
$th = $cobj->getCollectionThemeObject(); ?>
<?php  Loader::packageElement('editor_config', 'custom_objects_demo', array('theme' => $th)); ?> 
<?php  Loader::element('editor_controls'); ?>