<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$cnt = Loader::controller('/dashboard/custom_objects/search');
$customObjectsList = $cnt->getRequestedSearchResults();

$customObjects = $customObjectsList->getPage();

Loader::packageElement('custom_objects/search_results', 'custom_objects_demo', array('customObjects' => $customObjects, 'customObjectsList' => $customObjectsList));