(function() {
    tinymce.PluginManager.add( 'twittervisualeditor_button', function( editor, url ) {
        editor.addButton( 'twittervisualeditor_button', {
			title: 'Share on Twitter',
            icon: 'icon dashicons-twitter',
			onclick: function() {
			    editor.windowManager.open( {
			        title: 'Share on Twitter',
			        body: [{
			            type: 'textbox',
			            name: 'text',
			            label: 'Texto',
						value: 'Compartir en Twitter',
			        },{
				    type: 'listbox',
				    name: 'size',
				    label: 'Tamaño Icono',
					value: 'small',
				    'values': [
				        {text: 'Pequeño', value: 'small'},
				        {text: 'Grande', value: 'big'}
				    ]
				}],
			        onsubmit: function( e ) {
			            editor.insertContent( '[sct_sharetwitter text=&quot;' + e.data.text + '&quot; size=&quot;' + e.data.size + '&quot;]' );
			        }
			    });
			}
        });
    });
})();