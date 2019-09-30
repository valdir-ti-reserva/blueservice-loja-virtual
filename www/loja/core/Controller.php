<?php
class Controller {

	protected $db;

	public function __construct() {
		global $config;
	}

	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
  }

  public function loadAdminView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/admin/'.$viewName.'.php';
	}

	public function loadAdminTemplate($viewName, $viewData = array()) {
		include 'views/admin/template.php';
	}

  public function loadAdminViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/admin/'.$viewName.'.php';
	}

}
