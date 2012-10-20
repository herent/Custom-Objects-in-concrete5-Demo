<?php
defined('C5_EXECUTE') or die("Access Denied.");
$ih = Loader::helper('concrete/interface');
?>


<?php if ($_REQUEST['custom_object_created'] || $_REQUEST['custom_object_updated']) { ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Custom Object Details'), "", false, false); ?>
	<div class="ccm-pane-options">
		<?php print $ih->button(t('Edit Again'), $this->url('/dashboard/custom_objects/add/', 'edit', $customObject->getCustomObjectID()), 'left', 'primary'); ?>
		<?php print $ih->button(t('Delete'), $this->url('/dashboard/custom_objects/add/', 'confirm_delete', $customObject->getCustomObjectID()), 'left', 'error'); ?>
		<?php print $ih->button(t('Back to List'), $this->url('/dashboard/custom_objects/search/'), 'right', 'primary'); ?>
	</div>
	<div class="ccm-pane-body">
		<dl>
			<dt><?php echo t("Title");?></dt>
			<dd><?php echo $customObject->getTitle();?></dd>
			<dt><?php echo t("Content");?></dt>
			<dd><?php echo $customObject->getContent();?></dd>
		</dl>
	</div>
<?php } else { ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Search Custom Objects'), t('Search and Edit Custom Objects.'), false, false); ?>
	<div class="ccm-pane-options" id="ccm-custom-objects-pane-options">
		<?php
		Loader::packageElement('custom_objects/search_form', 'custom_objects_demo');
		?>
	</div>

	<?php
	Loader::packageElement(
		   'custom_objects/search_results', 'custom_objects_demo', array(
	    'customObjects' => $customObjects,
	    'customObjectsList' => $customObjectsList));
	?>
<?php } ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>
