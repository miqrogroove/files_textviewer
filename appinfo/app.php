<?php

namespace OCA\RobsFileViewer\AppInfo;

use OCP\Util;

\OC::$server->getNavigationManager()->add(function () {
	$urlGenerator = \OC::$server->getURLGenerator();
	return [
		// The string under which your app will be referenced in owncloud
		'id' => 'files_textviewer',

		// The sorting weight for the navigation.
		// The higher the number, the higher will it be listed in the navigation
		'order' => 10,

		// The route that will be shown on startup
		'href' => $urlGenerator->linkToRoute('files_textviewer.view.fetch', array('path' => '')),

		// The icon that will be shown in the navigation, located in img/
		// Icon made by Freepik from www.flaticon.com 
		'icon' => $urlGenerator->imagePath('files_textviewer', 'txt2.svg'),

		// The application's title, used in the navigation & the settings page of your app
		'name' => 'Text',
	];
});

\OC::$server->getEventDispatcher()->addListener(
    'OCA\Files::loadAdditionalScripts',
    function() {
        Util::addScript('files_textviewer', 'menu');
    }
);
