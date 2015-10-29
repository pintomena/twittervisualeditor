(function() {
    tinymce.PluginManager.add( 'twittervisualeditor_button', function( editor, url ) {
        editor.addButton( 'twittervisualeditor_button', {
			title: 'Share on Twitter',
            icon: 'icon dashicons-twitter',
            onclick: function() {
                editor.insertContent( '[sct_sharetwitter]' );
            }
        });
    });
})();