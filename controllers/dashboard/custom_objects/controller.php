<?php 
defined('C5_EXECUTE') or die("Access Denied.");

class DashboardCustomObjectsController extends Controller {


	public function __construct() { 
		$this->redirect('/dashboard/custom_objects/search');	
	}
	
}

?>