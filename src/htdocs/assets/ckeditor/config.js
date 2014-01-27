/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.language = 'ru';

    config.toolbar = [
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
        { name: 'colors', items : [ 'TextColor' ] },
        { name: 'insert', items : [ 'Image'] },
    ];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Smiley,PageBreak,Flash,Sub';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre';

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
    config.removePlugins = 'elementspath';
    config.resize_enabled = false;

    config.allowedContent = true;

    config.height = '50px';
};
