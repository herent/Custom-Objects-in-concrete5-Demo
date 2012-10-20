<?php  defined('C5_EXECUTE') or die("Access Denied."); ?> 
<?php  $form = Loader::helper('form'); 
$url = Loader::helper('concrete/urls');
$urlSearchAction = $url->getToolsURL('custom_objects/search_results', 'custom_objects_demo');
?>
	
	<form method="get" id="ccm-custom-objects-advanced-search" action="<?php echo $urlSearchAction;?>">
	<input type="hidden" name="search" value="1" />
	
	<div class="ccm-pane-options-permanent-search">

		<div style="width: 160px; margin-left: 20px; float: left;">
		<?php echo $form->label('title', t('Title'))?>
			<?php echo $form->text('title', $_REQUEST['title'], array('placeholder' => t('Title'), 'style'=> 'width: 140px')); ?>
		</div>
		<div  style="width: 100px; margin-left: 20px; float: left;">
		<?php echo $form->label('numResults', t('# Per Page'))?>
			<?php echo $form->select('numResults', array(
				'10' => '10',
				'25' => '25',
				'50' => '50',
				'100' => '100',
				'500' => '500'
			), $_REQUEST['numResults'], array('style' => 'width:65px'))?>
		</div>
		<div  style="width: 100px; margin-left: 20px; float: left;">
		<?php echo $form->submit('ccm-search-custom-objects', t('Search'), array('style' => 'margin-left: 10px; margin-top: 20px;'))?>
		<img src="<?php echo ASSETS_URL_IMAGES?>/loader_intelligent_search.gif" width="43" height="11" class="ccm-search-loading" id="ccm-custom-objects-search-loading" />
		</div>
	</div>
</form>
