function textviewerGo(file, data) {
	window.location = OC.generateUrl('apps/files_textviewer{file}', {
            'file': data.dir + '/' + file
        }, {escape: false});
}

function textviewerHooks() {
	OCA.Files.fileActions.registerAction({
		name: 'viewtext',
		displayName: 'View',
		mime: 'text',
		permissions: OC.PERMISSION_READ,
		icon: OC.imagePath('files_textviewer', 'eye'), //Icon made by Freepik from www.flaticon.com
		actionHandler: textviewerGo
	});
	//OCA.Files.fileActions.setDefault('text', 'viewtext');
}

$(document).ready(function () {
    if (typeof OCA !== 'undefined' && typeof OCA.Files !== 'undefined' && typeof OCA.Files.fileActions !== 'undefined') {
        textviewerHooks();
    }
    return true;
});
