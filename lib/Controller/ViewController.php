<?php

namespace OCA\RobsFileViewer\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\NotFoundResponse;
use OCP\AppFramework\Http\TemplateResponse;

// Request: GET /index.php/apps/files_textviewer/somefile.txt

class ViewController extends Controller {
	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function fetch($path) {
		$path = "/$path";
		$renderAs = '';
		if (!\OC\Files\Filesystem::file_exists($path)) {
			return new NotFoundResponse();
		}
		$parameters = array();
		$parameters['root'] = '/' === $path;
		if ( $parameters['root'] ) {
			$parameters['title'] = 'Text File Viewer';
		} else {
			$parameters['title'] = pathinfo( $path, PATHINFO_BASENAME );
		}
		if (\OC\Files\Filesystem::is_file($path)) {
			$templateName = 'pretty';
			if (\OC\Files\Filesystem::filesize($path) > 1048576) {
				$parameters['title'] = 'Error';
				$parameters['fulltext'] = 'File Was Too Big.  Limited to 1 MB.';
			} else {
				$fulltext = \OC\Files\Filesystem::file_get_contents($path);
				if ( 'UTF-8' !== mb_detect_encoding( $fulltext, 'UTF-8', true ) ) {
					$parameters['fulltext'] = mb_convert_encoding( $fulltext, 'UTF-8', 'Windows-1252' );
				} else {
					$parameters['fulltext'] = $fulltext;
				}
			}
		} elseif (\OC\Files\Filesystem::is_dir($path)) {
			$templateName = 'list';
			$dirInfo = \OC\Files\Filesystem::getFileInfo($path);
			$files = \OCA\Files\Helper::getFiles($path, 'name', false);
			$parameters['files'] = $files;
			$parameters['path']  = $path;
			$urlGenerator = \OC::$server->getURLGenerator();
			$parameters['webdav'] = $urlGenerator->linkTo('', 'remote.php');
		} else {
			return new NotFoundResponse();
		}
		return new TemplateResponse($this->appName, $templateName, $parameters, $renderAs);
	}
}
