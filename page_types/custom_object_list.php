<?php defined('C5_EXECUTE') or die(_('Access Denied.'));

Loader::model("custom_object", "custom_objects_demo");
$txt = Loader::helper("text");
$c = Page::getCurrentPage();
$filter_custom_objects_url = BASE_URL . View::url($c->getCollectionPath());
?>
<div class="left">
     <h2><?php echo t("Custom Objects"); ?></h2>
     <ul id="custom-objects-list">
          <?php
          $selectedCustomObjectID = intval($selectedCustomObject->getCustomObjectID());
          foreach ($allCustomObjects as $customObject) {
               $title = $customObject->getTitle();
               $handle = $txt->sanitizeFileSystem($title);
               $coID = $customObject->getCustomObjectID();
               if ($selectedCustomObjectID == $coID) {
                    ?>
                    <li class="selected">
                         <?php echo $title; ?>
                    </li>
               <?php } else { ?>
                    <li>
                         <a href="<?php echo $filter_custom_objects_url . $handle; ?>">
                              <?php echo $title; ?>
                         </a>
                    </li>
               <?php } ?>
          <?php } ?>
     </ul>
</div>
<div class="right">
     <?php Loader::packageElement("custom_objects/frontend_display", "custom_objects_demo", array("customObject" => $selectedCustomObject)); ?>
</div>