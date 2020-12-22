/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// An array of stylesheets to style the WYSIWYG area.
	// Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.


	/*********************** Replace http://localhost/esurat/ With The Original Web Address ***********************/
	/*********************** Replace http://localhost/esurat/ With The Original Web Address ***********************/
	/*********************** Replace http://localhost/esurat/ With The Original Web Address ***********************/

	// config.contentsCss = [ 
	// 'http://localhost/esurat/assets/ckeditor_4.14.1_full/contents.css', 
	// 'http://localhost/esurat/assets/ckeditor_4.14.1_full/mystyles.css' 
	// ];
	// config.filebrowserBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=files';
	// config.filebrowserImageBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=images';
	// config.filebrowserFlashBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=flash';
	// config.filebrowserUploadUrl = 'http://localhost/assets/esurat/kcfinder-2.51/upload.php?type=files';
	// config.filebrowserImageUploadUrl = 'http://localhost/esurat/assets/kcfinder-2.51/upload.php?type=images';
	// config.filebrowserFlashUploadUrl = 'http://localhost/esurat/assets/kcfinder-2.51/upload.php?type=flash';

	/*********************** Dont Remove Just Make it Disable ***********************/
	/*********************** Dont Remove Just Make it Disable ***********************/
	/*********************** Dont Remove Just Make it Disable ***********************/

	config.contentsCss = [ 
	'http://localhost/esurat/assets/ckeditor_4.14.1_full/contents.css', 
	'http://localhost/esurat/assets/ckeditor_4.14.1_full/mystyles.css' 
	];
	
	config.filebrowserBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=files';
	config.filebrowserImageBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 'http://localhost/esurat/assets/kcfinder-2.51/browse.php?type=flash';
	config.filebrowserUploadUrl = 'http://localhost/assets/esurat/kcfinder-2.51/upload.php?type=files';
	config.filebrowserImageUploadUrl = 'http://localhost/esurat/assets/kcfinder-2.51/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 'http://localhost/esurat/assets/kcfinder-2.51/upload.php?type=flash';


	config.language = 'en';
	config.uiColor = '#AADC6E';
	config.protectedSource.push( /<\?[\s\S]*?\?>/g ); 
	// config.height = 800;

	// ExtraPlugin
	config.extraPlugins = 'qrc,autogrow';
	config.autoGrow_minHeight = 200;
	config.autoGrow_maxHeight = 800;
	
	// Define the toolbar: https://ckeditor.com/docs/ckeditor4/latest/features/toolbar.html
	// The full preset from CDN which we used as a base provides more features than we need.
	// Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
	
	// config.toolbarGroups = [
	// { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// { name: 'styles', groups: [ 'styles' ] },
	// { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// { name: 'forms', groups: [ 'forms' ] },
	// { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// { name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
	// { name: 'links', groups: [ 'links' ] },
	// { name: 'insert', groups: [ 'insert' ] },
	// { name: 'colors', groups: [ 'colors' ] },
	// { name: 'tools', groups: [ 'tools' ] },
	// { name: 'about', groups: [ 'about' ] },
	// { name: 'others', groups: [ 'others' ] }
	// ];	

	config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	{ name: 'forms', groups: [ 'forms' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	{ name: 'links', groups: [ 'links' ] },
	{ name: 'insert', groups: [ 'insert' ] },
	'/',
	{ name: 'styles', groups: [ 'styles' ] },
	{ name: 'colors', groups: [ 'colors' ] },
	{ name: 'tools', groups: [ 'tools' ] },
	{ name: 'others', groups: [ 'others' ] },
	{ name: 'about', groups: [ 'about' ] }
	];


	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Save,NewPage,Templates,Copy,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Link,Unlink,Anchor,Flash,Smiley,SpecialChar,Iframe,About';

	// config.removeButtons = 'Save,NewPage,Checkbox,Form,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,Templates,Copy,Paste,PasteText,PasteFromWord,SelectAll,Anchor,HorizontalRule,CreateDiv,BidiLtr,BidiRtl,Language,ShowBlocks,TextColor,BGColor,SpecialChar,PageBreak,Iframe,Cut,Styles,CodeSnippet,CodeSnippetGeshi';

	// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
	config.bodyClass = 'document-editor';

	// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Define the list of styles which should be available in the Styles dropdown list.
    // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
    // (and on your website so that it rendered in the same way).
    // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
    // that file, which means one HTTP request less (and a faster startup).
    // For more information see https://ckeditor.com/docs/ckeditor4/latest/features/styles.html

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};