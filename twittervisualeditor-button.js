(function() {
    tinymce.PluginManager.add( 'twittervisualeditor_button', function( editor, url ) {
        editor.addButton( 'twittervisualeditor_button', {
            text: 'Share on Twitter',
            icon: false,
            onclick: function() {
                editor.insertContent( '[sct_sharetwitter]' );
            }
        });
    });
})();