(function() {

    tinymce.PluginManager.add('wpmk_block', function( editor )
    {
        var shortcodeValues = [];
        jQuery.each( shortcodes_button, function(i)
        {
            shortcodeValues.push({text: shortcodes_button[i], value:i});
        });

        editor.addButton('wpmk_block', {
            type: 'listbox',
            tooltip:"Block Shortcode",
            icon: 'copy',
            onselect: function(e) {
                var wpmk_block_slug = (this.text());
                
                tinyMCE.activeEditor.selection.setContent( '[wpmk-block slug="' + wpmk_block_slug + '" class="' + wpmk_block_slug + '"]' );
            },
            values: shortcodeValues
        });
    });
})();