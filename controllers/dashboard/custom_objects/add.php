<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardCustomObjectsAddController extends Controller {

     public function on_start() {
          Loader::model('custom_object', 'custom_objects_demo');
          Loader::model('custom_object_list', 'custom_objects_demo');
          $this->set('form', Loader::helper('form'));
          $this->set('valt', Loader::helper('validation/token'));
          $this->set('valc', Loader::helper('concrete/validation'));
          $this->set('ih', Loader::helper('concrete/interface'));

          $this->error = Loader::helper('validation/error');
     }

     public function view() {

          $vals = Loader::helper('validation/strings');
          $valt = Loader::helper('validation/token');
          $valc = Loader::helper('concrete/validation');

          if ($_POST['create']) {

               $title = $_POST['title'];
               if (!$vals->notempty($title)) {
                    $this->error->add(t('Please include a title.'));
               }

               $content = $_POST['content'];
               if (!$vals->notempty($content)) {
                    $this->error->add(t('Please include content.'));
               }

               if (!$valt->validate('create_custom_object')) {
                    $this->error->add($valt->getErrorMessage());
               }

               if (!$this->error->has()) {
                    $data = array(
                        'title' => $title,
                        'content' => $content);
                    $customObject = CustomObject::add($data);
                    if (is_a($customObject, "CustomObject")) {
                         $this->redirect('/dashboard/custom_objects/search?coID=' . $customObject->getCustomObjectID() . '&custom_object_created=1');
                    } else {
                         $this->error->add(t('An error occurred while trying to create this Custom Object.'));
                         $this->set('error', $this->error);
                    }
               } else {
                    $this->set('error', $this->error);
               }
          }

          if ($_POST['update']) {

               $coID = $_POST['coID'];
               if (!intval($coID) > 0) {
                    $this->error->add(t('Invalid Custom Object ID.'));
               }

               $title = $_POST['title'];
               if (!$vals->notempty($title)) {
                    $this->error->add(t('Please include a title.'));
               }

               $content = $_POST['content'];
               if (!$vals->notempty($content)) {
                    $this->error->add(t('Please include content.'));
               }

               if (!$valt->validate('update_custom_object')) {
                    $this->error->add($valt->getErrorMessage());
               }

               if (!$this->error->has()) {
                    $customObject = CustomObject::getByID($coID);
                    $data = array(
                        'title' => $title,
                        'content' => $content);
                    if (is_a($customObject, "CustomObject")) {
                         $customObject->save($data);
                         $this->redirect('/dashboard/custom_objects/search?coID=' . $customObject->getCustomObjectID() . '&custom_object_updated=1');
                    } else {
                         $this->error->add(t('An error occurred while trying to update this Custom Object.'));
                         $this->set('error', $this->error);
                    }
               } else {
                    $this->set('error', $this->error);
               }
          }
     }

     public function edit($coID) {
          $customObject = CustomObject::getByID($coID);
          if (is_a($customObject, "CustomObject")) {
               $this->set("customObject", $customObject);
               $this->view();
          } else {
               $this->error->add(t("Invalid Custom Object ID"));
          }
     }

     public function delete($coID) {
          $valt = Loader::helper('validation/token');
          if (!$valt->validate('delete_custom_object')) {
               $this->error->add($valt->getErrorMessage());
          }

          if (!$this->error->has()) {

               $customObject = CustomObject::getByID($coID);

               if (is_a($customObject, "CustomObject")) {
                    $customObject->delete();
                    $this->redirect('/dashboard/custom_objects/search?custom_object_deleted=1');
               }
          } else {
               $customObject = CustomObject::getByID($coID);
               if (is_a($customObject, "Custom Object")) {
                    $this->set("customObject", $customObject);
                    $this->set("delete", 1);
                    $this->view();
               } else {
                    $this->error->add(t("Invalid Custom Object ID"));
               }
               $this->set('error', $this->error);
          }
     }

     public function confirm_delete($coID) {
          $customObject = CustomObject::getByID($coID);
          if (is_a($customObject, "CustomObject")) {
               $this->set("customObject", $customObject);
               $this->set("delete", 1);
               $this->view();
          } else {
               $this->error->add(t("Invalid Custom Object ID"));
               $this->view();
          }
     }

}
