<?php
namespace OCA\RobsFileViewer\AppInfo;

use \OCP\AppFramework\App;
use \OCA\RobsFileViewer\Controller\ViewController;

class Application extends App {

	public function __construct(array $urlParams=[]){
		parent::__construct('files_textviewer', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('ViewController', function($c) {
			return new ViewController(
				$c->query('AppName'),
				$c->query('Request')
			);
		});
	}
}
