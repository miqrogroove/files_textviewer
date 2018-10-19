<?php

namespace OCA\RobsFileViewer\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;

// Request: GET /index.php/apps/files_textviewer/somefile.txt

class ViewController extends Controller {
    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function fetch($path) {
	$path = "/$path";
	$templateName = 'pretty';
	if (!\OC\Files\Filesystem::file_exists($path)) {
                $parameters = [
                        'title' => 'Error',
                        'fulltext' => 'File Not Found',
                ];
	} elseif (\OC\Files\Filesystem::is_file($path)) {
		if (\OC\Files\Filesystem::filesize($path) > 1048576) {
			$parameters = [
				'title' => 'Error',
				'fulltext' => 'File Was Too Big.  Limited to 1 MB.',
			];
		} else {
			$fulltext = \OC\Files\Filesystem::file_get_contents($path);
			if ( 'UTF-8' !== mb_detect_encoding( $fulltext, 'UTF-8', true ) ) {
				$fulltext = mb_convert_encoding( $fulltext, 'UTF-8', 'Windows-1252' );
			}
			$parameters = [
				'title' => $path,
				'fulltext' => $fulltext,
			];
		}
	} elseif (\OC\Files\Filesystem::is_dir($path)) {
		$templateName = 'list';
		$dirInfo = \OC\Files\Filesystem::getFileInfo($path);
		$files = \OCA\Files\Helper::getFiles($path, 'name', false);

		$parameters = [
                        'title' => $path,
                        'files' => $files,
                ];
	}
	$renderAs = '';
	return new TemplateResponse($this->appName, $templateName, $parameters, $renderAs);
    }

}
