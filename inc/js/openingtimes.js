(function() {

    tinymce.create('tinymce.plugins.openingtimes', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('cx_openingtimes_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        //content =  '[shortcode]'+selected+'[/shortcode]';
                        alert("Sorry, this won't work if you have selected text. Please click the place you'd like the opening times to appear and then press this button again.");
                        content = content;
                    }else{
                        content =  '<h2>Our opening times</h2> [opening-times]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('openingtimes', {title : 'Insert a list of your weekly opening times. See "Settings > Opening Times" for help.', cmd : 'cx_openingtimes_insert_shortcode', image: url + '/buttons/opening-times.png' });
        },   
    });
    
    tinymce.create('tinymce.plugins.openingtimestoday', {
            init : function(ed, url) {
                    // Register command for when button is clicked
                    ed.addCommand('cx_openingtimestoday_insert_shortcode', function() {
                        selected = tinyMCE.activeEditor.selection.getContent();
    
                        if( selected ){
                            //If text is selected when button is clicked
                            //Wrap shortcode around it.
                            //content =  '[shortcode]'+selected+'[/shortcode]';
                            alert("Sorry, this won't work if you have selected text. Please click the place you'd like the opening times to appear and then press this button again.");
                            content = content;
                        }else{
                            content =  '[opening-times-today open="We are open today from" closed="Sorry, we\'re closed today"]';
                        }
    
                        tinymce.execCommand('mceInsertContent', false, content);
                    });
    
                // Register buttons - trigger above command when clicked
                ed.addButton('openingtimestoday', {title : 'Insert the current day\'s opening times. This updates automatically to always show the correct opening times on the date the page is being viewed. See "Settings > Opening Times" for help.', cmd : 'cx_openingtimestoday_insert_shortcode', image: url + '/buttons/opening-times-today.png' });
            },   
        });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('openingtimes', tinymce.plugins.openingtimes);
    tinymce.PluginManager.add('openingtimestoday', tinymce.plugins.openingtimestoday);
})();