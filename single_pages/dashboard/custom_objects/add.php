
<?php
defined('C5_EXECUTE') or die("Access Denied.");

$th = Loader::helper('text');

if (is_a($customObject, "CustomObject") && intval($_POST['create']) == 0) {
     $useCustomObjectDetails = 1;
     $isUpdate = 1;
}
if (intval($_POST['isUpdate']) > 0) {
     $isUpdate = 1;
}
if (is_a($customObject, "CustomObject") && $delete) {
     $confirmDelete = 1;
}
?>
<?php
if ($confirmDelete) {
     ?>
     <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Delete Custom Object'), false, false, false); ?>
     <form method="post" enctype="multipart/form-data" id="cm-delete-custom-object-form" action="<?php echo $this->url('/dashboard/custom_objects/add', 'delete', $customObject->getCustomObjectID()) ?>">
          <?php echo $valt->output('delete_custom_object'); ?>
          <div class="ccm-pane-body">
               <h2><?php echo t("Do you really want to delete this Custom Object?"); ?></h2>
               <dl>
                    <dt><?php echo t("Title"); ?></dt>
                    <dd><?php echo $customObject->getTitle(); ?></dd>
                    <dt><?php echo t("Content"); ?></dt>
                    <dd><?php echo $customObject->getContent(); ?></dd>
               </dl>
          </div>
          <div class="ccm-pane-footer">
               <div class="ccm-buttons">
                    <input type="hidden" name="do_delete" value="1" />
                    <input type="hidden" name="coID" value="<?php echo $customObject->getCustomObjectID(); ?>" />
                    <?php print $ih->button(t('Cancel'), $this->url('/dashboard/custom_objects/search'), 'left', 'error') ?>
                    <?php print $ih->submit(t('Delete Permanently'), 'ccm-user-form', 'right', 'primary'); ?>
               </div>	
          </div>
     <?php } else {
          ?>
          <?php if ($isUpdate) { ?>
               <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Edit Custom Object'), false, false, false); ?>
          <?php } else { ?>
               <?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add Custom Object'), false, false, false); ?>
          <?php } ?>
          <form method="post" enctype="multipart/form-data" id="cm-custom-object-form" action="<?php echo $this->url('/dashboard/custom_objects/add') ?>">
               <div class="ccm-pane-body">			
                    <?php
                    if ($useCustomObjectsDetails || $isUpdate) {
                         echo $valt->output('update_custom_object');
                         ?>
                    <?php } else {
                         echo $valt->output('create_custom_object');
                         ?>
                    <?php } ?>

                    <table border="0" cellspacing="0" cellpadding="0" width="100%" class="ccm-grid">
                         <thead>
                              <tr>
                                   <th><?php echo t('Custom Object Information') ?></th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr>
                                   <td><?php echo t('Title') ?> <span class="required">*</span></td>
                              </tr>
                              <tr>
                                   <?php if ($useCustomObjectDetails) { ?>
                                        <td><input type="text" id="title" name="title" autocomplete="off" value="<?php echo $customObject->getTitle(); ?>" style="width: 95%"></td>
                                   <?php } else { ?>
                                        <td><input type="text" id="title" name="title" autocomplete="off" value="<?php echo $_POST['title'] ?>" style="width: 95%"></td>
                                   <?php } ?>
                              </tr>
                              <tr>
                                   <td><?php echo t('Custom Object Content') ?> <span class="required">*</span></td>
                              </tr>
                              <tr>
                                        <?php if ($useCustomObjectDetails) { ?>
                                        <td>
                                        <?php Loader::packageElement('editor_init', 'custom_objects_demo'); ?>
                                             <textarea 
                                                  id="ccm-content-amenity" 
                                                  class="advancedEditor ccm-advanced-editor" 
                                                  name="content" 
                                                  style="width: 580px; height: 380px">
                                        <?php echo ($customObject->getContentEditMode()); ?>
                                             </textarea>
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                        <?php Loader::packageElement('editor_init', 'custom_objects_demo'); ?>
                                             <textarea 
                                                  id="ccm-content-amenity" 
                                                  class="advancedEditor ccm-advanced-editor" 
                                                  name="content" 
                                                  style="width: 580px; height: 380px">
                                        <?php echo ($_POST['content']); ?>
                                             </textarea>
                                        </td>
                                        <?php } ?>
                              </tr>

                         </tbody>
                    </table>

               </div>

               <div class="ccm-pane-footer">
                    <div class="ccm-buttons">
                         <?php if ($useCustomObjectDetails || $isUpdate) { ?>
                              <input type="hidden" name="update" value="1" />
                              <input type="hidden" name="isUpdate" value="1" />
                              <?php if ($useCustomObjectDetails) { ?>
                                   <input type="hidden" name="coID" value="<?php echo $customObject->getCustomObjectID(); ?>" />
                              <?php } else { ?>
                                   <input type="hidden" name="coID" value="<?php echo $_POST['coID']; ?>" />
                              <?php } ?>
                              <?php print $ih->button(t('Cancel'), $this->url('/dashboard/custom_objects/search'), 'left', 'error') ?>
                              <?php print $ih->submit(t('Update'), 'ccm-user-form', 'right', 'primary'); ?>
                         <?php } else { ?>
                              <input type="hidden" name="create" value="1" />
                              <?php print $ih->button(t('Cancel'), $this->url('/dashboard/custom_objects/search'), 'left', 'error') ?>
                              <?php print $ih->submit(t('Add'), 'ccm-user-form', 'right', 'primary'); ?>
                         <?php } ?>
                    </div>	
               </div>

          </form>
<?php } ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>