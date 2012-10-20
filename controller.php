<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class CustomObjectsDemoPackage extends Package {

     protected $pkgHandle = 'custom_objects_demo';
     protected $appVersionRequired = '5.5.2.1';
     protected $pkgVersion = '0.9';

     public function getPackageDescription() {
          return t('A demo for creating custom objects, lists, and page types.');
     }

     public function getPackageName() {
          return t('Custom Objects Demo');
     }

     public function install() {

          $pkg = parent::install();
		
          $this->installSinglePages($pkg);
          $this->installPageTypes($pkg);
     }

     public function uninstall() {

          parent::uninstall();
		$db = Loader::db();
          $db->Execute('truncate table customObjects');
     }

     private function installPageTypes($pkg) {
          Loader::model('collection_types');

          $custom_object_list = CollectionType::getByHandle('custom_object_list');
          if (!is_object($custom_object_list)) {
               $data = array('ctHandle' => 'custom_object_list', 'ctName' => t('Custom Object List'));
               $custom_object_list = CollectionType::add($data, $pkg);
          }
     }

     private function installSinglePages($pkg) {
          Loader::model('single_page');

          $def = SinglePage::add('/dashboard/custom_objects', $pkg);
          $def->update(array('cName' => t('Custom Objects'), 'cDescription' => t('Page for Administrators to add, edit and create new Custom Objects.')));

          $def = SinglePage::add('/dashboard/custom_objects/search', $pkg);
          $def->update(array('cName' => t('Search Custom Objects'), 'cDescription' => t('Search Custom Objects.')));
		
		$def = SinglePage::add('/dashboard/custom_objects/add', $pkg);
          $def->update(array('cName' => t('Add / Edit Custom Objects'), 'cDescription' => t('Add and Edit Custom Objects.')));
	}

}