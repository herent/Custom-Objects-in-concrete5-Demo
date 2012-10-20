<?php

defined('C5_EXECUTE') or die("Access Denied.");

class CustomObjectListPageTypeController extends Controller {

     public function on_start() {
          Loader::model('custom_object', 'custom_objects_demo');
          Loader::model('custom_object_list', 'custom_objects_demo');
          $html = Loader::helper('html');
          $this->addHeaderItem($html->css('custom_object_list.css', 'custom_objects_demo'));
     }

     public function view($customObject = "") {
          $txt = Loader::helper('text');
          $allCustomObjects = CustomObjectList::getAllCustomObjects();
          $this->set('allCustomObjects', $allCustomObjects);

          if ($customObject == "") {
               $selectedCustomObject = $allCustomObjects[0];
          } else {
               $customObjectTitle = $txt->unhandle($customObject);
               $selectedCustomObject = CustomObject::getByTitle($customObjectTitle);
          }

          $this->set('selectedCustomObject', $selectedCustomObject);
     }

}

?>