<?php
defined('C5_EXECUTE') or die("Access Denied.");
$ih = Loader::helper('concrete/interface');
$form = Loader::helper('form');
?> 

<div id="ccm-custom-objects-search-results">

	<div class="ccm-pane-body">
		<div style="margin-bottom: 10px">
			<?php print $ih->button(t('Add Custom Object'), View::url('/dashboard/custom_objects/add'), 'right', 'primary'); ?>
			<div class="clearfix"></div>
		</div>
		<div id="ccm-list-wrapper">
			<a name="ccm-custom-object-list-wrapper-anchor"></a>
			<?php
			$txt = Loader::helper('text');
			$title = $_REQUEST['title'];
			$url = Loader::helper('concrete/urls');
			$bu = $url->getToolsURL('custom_objects/search_results', 'custom_objects_demo');

			if (count($customObjects) > 0) {
				?>	
				<table border="0" cellspacing="0" cellpadding="0" id="ccm-custom-object-list" class="ccm-results-list">
					<tr>
						<th class="<?php echo $customObjectsList->getSearchResultsClass('title') ?>">
							<a href="<?php echo $customObjectsList->getSortByURL('title', 'asc', $bu) ?>">
							<?php echo t("Title"); ?>
							</a>
						</th>
						<th width="135px"></th>
					</tr>
					<?php
					foreach ($customObjects as $customObject) {
						$editAction = View::url('/dashboard/custom_objects/add', 'edit', $customObject->getCustomObjectID());
						$deleteAction = View::url('/dashboard/custom_objects/add', 'confirm_delete', $customObject->getCustomObjectID());

						if (!isset($striped) || $striped == 'ccm-list-record-alt') {
							$striped = '';
						} else if ($striped == '') {
							$striped = 'ccm-list-record-alt';
						}
						?>

						<tr class="ccm-list-record <?php echo $striped ?>">
							<td><?php echo $txt->highlightSearch($customObject->getTitle(), $title); ?></td>
							<td>
								<?php print $ih->button(t('Edit'), $editAction, 'right', 'primary', array('style' => "margin-left: 10px")); ?>
								<?php print $ih->button(t('Delete'), $deleteAction, 'right', 'error'); ?>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			<?php } else { ?>
				<div id="ccm-list-none"><?php echo t('No Custom Objects Found.') ?></div>
			<?php } ?>

		</div>

		<?php $customObjectsList->displaySummary(); ?>
		<div class="clearfix"></div>
	</div>

	<div class="ccm-pane-footer">
		<?php $customObjectsList->displayPagingV2($bu, false); ?>
		<div class="clearfix"></div>
	</div>

</div>