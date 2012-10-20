<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardCustomObjectsSearchController extends Controller {

     public function on_start() {

          Loader::model('custom_object', 'custom_objects_demo');
          Loader::model('custom_object_list', 'custom_objects_demo');
          $this->set('form', Loader::helper('form'));
          $this->set('valt', Loader::helper('validation/token'));
          $this->set('valc', Loader::helper('concrete/validation'));
          $this->set('ih', Loader::helper('concrete/interface'));
          $this->set('av', Loader::helper('concrete/avatar'));
          $this->set('dtt', Loader::helper('form/date_time'));

          $this->error = Loader::helper('validation/error');
     }

     public function view() {
          $html = Loader::helper('html');
          $form = Loader::helper('form');
          $this->set('form', $form);
          $this->addHeaderItem('<script type="text/javascript">$(function() { ccm_setupAdvancedSearch(\'custom-objects\'); });</script>');
          $customObjectsList = $this->getRequestedSearchResults();
          $customObjects = $customObjectsList->getPage();

          $this->set('customObjectsList', $customObjectsList);
          $this->set('customObjects', $customObjects);

          if ($_REQUEST['custom_object_created']) {
               $this->set('message', t('Custom Object Created.'));
               $customObject = CustomObject::getByID($_REQUEST['coID']);
               $this->set('customObject', $customObject);
          }

          if ($_REQUEST['custom_object_updated']) {
               $this->set('message', t('Custom Object Updated.'));
               $customObject = CustomObject::getByID($_REQUEST['coID']);
               $this->set('customObject', $customObject);
          }

          if ($_REQUEST['custom_object_deleted']) {
               $this->set('message', t('Custom Object Deleted.'));
          }
     }

     public function getRequestedSearchResults() {

          Loader::model('custom_object', 'custom_objects_demo');
          Loader::model('custom_object_list', 'custom_objects_demo');

          $customObjectsList = new CustomObjectList();

          if ($_REQUEST['title'] != '') {
               $customObjectsList->filterByTitle($_GET['title']);
          }
          if ($_REQUEST['numResults']) {
               $customObjectsList->setItemsPerPage($_REQUEST['numResults']);
          }
          return $customObjectsList;
     }

}