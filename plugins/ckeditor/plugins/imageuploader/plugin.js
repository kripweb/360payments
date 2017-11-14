// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md
var site_url = $("#site_url").val();
CKEDITOR.plugins.add( 'imageuploader', {
    init: function( editor ) {
        editor.config.filebrowserBrowseUrl = site_url+'/plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});
