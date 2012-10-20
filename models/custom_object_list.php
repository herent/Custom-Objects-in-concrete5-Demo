<?php

defined('C5_EXECUTE') or die("Access Denied.");

/**
 *
 * A filtered list of custom objects
 * @package Item List Demo
 *
 */
class CustomObjectList extends DatabaseItemList {

private $queryCreated;
protected $autoSortColumns = array("title");
protected $itemsPerPage = 10;

protected function setBaseQuery() {
	$this->setQuery('SELECT * FROM customObjects');
}

public function createQuery() {
	if (!$this->queryCreated) {
		$this->setBaseQuery();
		$this->queryCreated = 1;
	}
}

public function get($itemsToGet = 0, $offset = 0) {
	Loader::model("custom_object", "custom_objects_demo");
	$customObjectsList = array();
	$this->createQuery();
	$r = parent::get($itemsToGet, $offset);
	foreach ($r as $row) {
		$customObject = CustomObject::getByID($row['coID']);
		$customObjectsList[] = $customObject;
	}
	return $customObjectsList;
}

public function getTotal() {
	$this->createQuery();
	return parent::getTotal();
}

public static function getAllCustomObjects() {
	Loader::model("custom_object", "custom_objects_demo");
	$customObjectList = array();
	$customObjectList = new CustomObjectList();
	$customObjectList->createQuery();
	$customObjects = $customObjectList->get();
	return $customObjects;
}

public function filterByTitle($title){
	$db = Loader::db();
	$title = $db->quote("%" . $title . "%");
	$this->filter(false, '(title LIKE ' . $title . ")");
}

}
