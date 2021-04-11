/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};

CKEDITOR.on( 'dialogDefinition', function( ev )
   {
      var dialogName = ev.data.name;
      var dialogDefinition = ev.data.definition;

      if (dialogName == 'image' || dialogName == 'flash')
      {
         // remove Upload tab
         dialogDefinition.removeContents( 'Upload' );
      }
   });
