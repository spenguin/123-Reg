
(function() {
    tinymce.PluginManager.add('fp_foundation_3_button', function( editor, url ) {
        editor.addButton( 'fp_foundation_3_button', {
            title: fp_foundation_assistant_localized_script.button_shortcodes,
            type: 'menubutton',
            icon: 'icon fp-icon-01',
            menu: [
             {
                text: fp_foundation_assistant_localized_script.grid,
                menu: [
                {
                    text: fp_foundation_assistant_localized_script.grid,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.grid,
                            width : 400,
                            height: 250,
                            body: [{
                                type: 'listbox', 
                                name: 'columns', 
                                label: fp_foundation_assistant_localized_script.no_of_columns, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                    {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                    {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                    {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                    {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                    {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                    {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                    {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                    {text: fp_foundation_assistant_localized_script.ten, value: '10'},
                                    {text: fp_foundation_assistant_localized_script.eleven, value: '11'},
                                    {text: fp_foundation_assistant_localized_script.twelve, value: '12'},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'centered', 
                                label: fp_foundation_assistant_localized_script.element_align, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.centered, value: "centered='true'"},
                                ]
                            },{
                                type: 'checkbox',
                                name: 'offsets',
                                text: fp_foundation_assistant_localized_script.offsets,  
                                classes: 'fp-checkbox'                
                            },{
                                type: 'checkbox',
                                name: 'source_ordering',
                                text: fp_foundation_assistant_localized_script.source_ordering,  
                                classes: 'fp-checkbox'                  
                            },{
                                type: 'checkbox',
                                name: 'block_grids',
                                text: fp_foundation_assistant_localized_script.block_grids,     
                                classes: 'fp-collapse'                    
                            },{
                                type: 'checkbox',
                                name: 'collapse',
                                text: fp_foundation_assistant_localized_script.collapse,     
                                classes: 'fp-collapse'                    
                            }],


                            onsubmit: function( e ) {

                                var fp_column_classes = new Array();
                                var fp_row_classes = new Array();

                                if( e.data.offsets === true ) { fp_column_classes.push( "offset=''" ); }
                                if( e.data.source_ordering === true ) { fp_column_classes.push( "push='' pull=''" ); } 
                                if( e.data.block_grids === true ) { fp_row_classes.push( "up='' small_up=''" ); } 
                                if( e.data.collapse === true ) { fp_row_classes.push( "collapse='true'" ); } 
                                if( e.data.centered.length !== 0 ) { fp_column_classes.push( e.data.centered ); }


                                if ( fp_column_classes.length !== 0 ) { fp_column_classes = ' ' + fp_column_classes.join( " " ); }
                                if ( fp_row_classes.length !== 0 ) { fp_row_classes = ' ' + fp_row_classes.join( " " ); }
                                
                                var rawTemplate = "[fp-rows{{row_classes}}]<br>";

                                for (var i = 0; i < e.data.columns; i++) {
                                        var columns = i + 1;
                                        rawTemplate += "[fp-columns column=''{{column_classes}}][/fp-columns]<br>";                                    
                                    } 

                                rawTemplate += '[/fp-rows]<br>';  
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    column_classes: fp_column_classes,
                                    row_classes: fp_row_classes,                                                              
                                }));

                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.visibility_classes,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.visibility_classes,
                            width : 550,
                            height: 250,
                            body: [{
                                type: 'listbox', 
                                name: 'small_size', 
                                label: fp_foundation_assistant_localized_script.small_visibility, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.show_small_only, value: "show_small_only='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_small_only, value: "hide_small_only='true'"},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'medium_size', 
                                label: fp_foundation_assistant_localized_script.medium_visibility, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.show_medium_down, value: "show_medium_down='true'"},
                                    {text: fp_foundation_assistant_localized_script.show_medium_only, value: "show_medium_only='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_medium_down, value: "hide_medium_down='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_medium_only, value: "hide_medium_only='true'"},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'large_size', 
                                label: fp_foundation_assistant_localized_script.large_visibility, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.show_large, value: "show_large='true'"},
                                    {text: fp_foundation_assistant_localized_script.show_large_only, value: "show_large_only='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_large, value: "hide_large='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_large_only, value: "hide_large_only='true'"},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'xlarge_size', 
                                label: fp_foundation_assistant_localized_script.xlarge_visibility, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.show_xlarge, value: "show_xlarge='true'"},
                                    {text: fp_foundation_assistant_localized_script.hide_xlarge, value: "hide_xlarge='true'"},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'orientation', 
                                label: fp_foundation_assistant_localized_script.orientation, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.none, value: ''},
                                    {text: fp_foundation_assistant_localized_script.show_portrait, value: "show_portrait='true'"},
                                    {text: fp_foundation_assistant_localized_script.show_landscape, value: "show_landscape='true'"},
                                ]
                            }],

                            onsubmit: function( e ) {

                                var fp_visible_classes = new Array();

                                fp_visible_classes.push( 
                                    e.data.orientation, 
                                    e.data.small_size, 
                                    e.data.medium_size, 
                                    e.data.large_size, 
                                    e.data.xlarge_size 
                                );

                                if ( fp_visible_classes.length !== 0 ) { fp_visible_classes = ' ' + fp_visible_classes.join( " " ); }
                                
                                var rawTemplate = '[fp-visible{{visible_classes}}]';
                                rawTemplate += '[/fp-visible]<br>';  
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    visible_classes: fp_visible_classes,
                                }));

                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.float_classes,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.float_classes,
                            width : 300,
                            height: 80,
                            body: [{
                                type: 'listbox', 
                                name: 'float_classes', 
                                label: fp_foundation_assistant_localized_script.element_float, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.float_left, value: "float='left'"},
                                    {text: fp_foundation_assistant_localized_script.float_right, value: "float='right'"}
                                ]
                            }],

                            onsubmit: function( e ) {

                                var fp_float_classes = new Array();

                                if( e.data.float_classes.length !== 0 ) { fp_float_classes.push( e.data.float_classes ); }

                                if ( fp_float_classes.length !== 0 ) { fp_float_classes = ' ' + fp_float_classes.join( " " ); }    
                                
                                var rawTemplate = '[fp-float{{float_classes}}]';
                                rawTemplate += '[/fp-float]<br>';  
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    float_classes: fp_float_classes,
                                }));

                            }
                        });
                    }
                }]   
            },{
                text: fp_foundation_assistant_localized_script.tabs_accordions,
                menu: [
                {
                    text: fp_foundation_assistant_localized_script.tabs,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.no_of_tabs,
                            width : 300,
                            height: 120,
                            body: [{
                                type: 'listbox', 
                                name: 'level', 
                                label: fp_foundation_assistant_localized_script.tabs, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                    {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                    {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                    {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                    {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                    {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                    {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                    {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                    {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                                ]
                            }, {
                                type: 'listbox', 
                                name: 'type', 
                                label: fp_foundation_assistant_localized_script.tabs_type, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.type_horizontal_tabs, value: ''},
                                    {text: fp_foundation_assistant_localized_script.type_vertical_tabs, value: "vertical='true'"}                                    
                                ]
                            }],
                            onsubmit: function( e ) {

                                var fp_tabs_classes = new Array();

                                if( e.data.type.length !== 0 ) { fp_tabs_classes.push( e.data.type ); }

                                if ( fp_tabs_classes.length !== 0 ) { fp_tabs_classes = ' ' + fp_tabs_classes.join( " " ); }

                                var rawTemplate = '[fp-tabs{{tabs_classes}}]<br>'; 

                                for (var i = 0; i < e.data.level; i++) {
                                    var tab = i + 1;
                                   
                                    if (tab === 1) {
                                        rawTemplate += "[fp-tab open='true' title='{{title}} "+ tab +"']{{content}} "+ tab +"[/fp-tab]<br>"; 
                                    } else { 
                                        rawTemplate += "[fp-tab title='{{title}} "+ tab +"']{{content}}  "+ tab +"[/fp-tab]<br>"; 
                                    }                                     
                                } 

                                rawTemplate += '[/fp-tabs]<br>';
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 

                                editor.insertContent(compiledTemplate({ 
                                    title: fp_foundation_assistant_localized_script.element_title,
                                    content: fp_foundation_assistant_localized_script.tab_content, 
                                    tabs_classes: fp_tabs_classes,                            
                                }));                  
                                
                            }
                        });
                    }
                },
                {   
                    text: fp_foundation_assistant_localized_script.accordion,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.no_of_items,
                            width: 300,
                            height: 100,
                            body: [{
                                type: 'listbox',                                 
                                name: 'level', 
                                label: fp_foundation_assistant_localized_script.items, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                    {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                    {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                    {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                    {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                    {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                    {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                    {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                    {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                                ]
                            },
                            {
                                type: 'listbox', 
                                name: 'option', 
                                label: fp_foundation_assistant_localized_script.element_options, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.all_closed, value: '2'},
                                ]
                            }],

                            onsubmit: function( e ) {

                            if( e.data.option == 2) {

                                var rawTemplate = '[fp-accordion-wrap]<br>';

                                for (var i = 0; i < e.data.level; i++) {
                                    var tab = i + 1;                                   
                                    rawTemplate += "[fp-accordion title='{{title}} " + tab + "']{{content}} " + tab + "[/fp-accordion]<br>";                                   
                                } 

                                rawTemplate += '[/fp-accordion-wrap]<br>';
                                rawTemplate += '&nbsp;';

                            } else if (e.data.option == 1) {

                                var rawTemplate = '[fp-accordion-wrap]<br>';

                                for (var i = 0; i < e.data.level; i++) {
                                    var tab = i + 1;
                                   
                                    if (tab === 1) {
                                        rawTemplate += "[fp-accordion open='true' title='{{title}} " + tab + "']{{content}} " + tab + "[/fp-accordion]<br>";
                                    } else {
                                        rawTemplate += "[fp-accordion title='{{title}} " + tab + "']{{content}} " + tab + "[/fp-accordion]<br>";
                                    }                                     
                                } 

                                rawTemplate += '[/fp-accordion-wrap]<br>';
                                rawTemplate += '&nbsp;';                         
                            }
                                var compiledTemplate = Handlebars.compile(rawTemplate);
                                editor.insertContent(compiledTemplate({
                                    title: fp_foundation_assistant_localized_script.element_title,
                                    content: fp_foundation_assistant_localized_script.tab_content, 
                                }));
                            }                            
                        });
                    }
                },
                ]
            },{
                text: fp_foundation_assistant_localized_script.carousels,
                menu: [
            {
                text: fp_foundation_assistant_localized_script.carousel_orbit,
                onclick: function() {
                    editor.windowManager.open( {
                        title: fp_foundation_assistant_localized_script.carousel_orbit,
                        width: 300,
                        height: 100,
                        body: [{
                            type: 'listbox',                                 
                            name: 'level', 
                            label: fp_foundation_assistant_localized_script.slides, 
                            'values': [
                                {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                            ]
                        }],
                        onsubmit: function( e ) {
                            var rawTemplate = "[fp-orbits label='']<br>";

                            for (var i = 0; i < e.data.level; i++) {
                                    var tab = i + 1;
                                   
                                    if (tab === 1) {
                                    rawTemplate += "[fp-orbit title='{{title}} " + tab + "']{{content}} " + tab + "[/fp-orbit]<br>"; }
                                    else {rawTemplate += "[fp-orbit title='{{title}} " + tab + "']{{content}} " + tab + "[/fp-orbit]<br>";}                                     
                                } 

                            rawTemplate += '[/fp-orbits]<br>';  
                            rawTemplate += '&nbsp;';

                            var compiledTemplate = Handlebars.compile(rawTemplate); 

                                editor.insertContent(compiledTemplate({
                                    title: fp_foundation_assistant_localized_script.element_title,
                                    content: fp_foundation_assistant_localized_script.tab_content, 
                                }));

                        }
                    });
                }
            },{
                text: fp_foundation_assistant_localized_script.carousel_owl,
                onclick: function() {
                    editor.windowManager.open( {
                        title: fp_foundation_assistant_localized_script.carousel_owl,
                        width : 300,
                        height: 120,
                        body: [{
                            type: 'listbox', 
                            name: 'columns', 
                            label: fp_foundation_assistant_localized_script.no_of_columns, 
                            'values': [
                                {text: fp_foundation_assistant_localized_script.one, value: "columns='one'"},
                                {text: fp_foundation_assistant_localized_script.two, value: "columns='two'"},
                                {text: fp_foundation_assistant_localized_script.three, value: "columns='three'"},
                                {text: fp_foundation_assistant_localized_script.four, value: "columns='four'"},
                                {text: fp_foundation_assistant_localized_script.five, value: "columns='five'"},
                                {text: fp_foundation_assistant_localized_script.six, value: "columns='six'"}
                            ]
                        },
                        {
                            type: 'listbox', 
                            name: 'items', 
                            label: fp_foundation_assistant_localized_script.slides, 
                            'values': [
                                {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                            ]
                        }],
                        onsubmit: function( e ) {

                            var fp_carousel_classes = new Array();

                            if (e.data.columns.length !== 0 ) { fp_carousel_classes.push( e.data.columns ); }   

                            if ( fp_carousel_classes.length !== 0 ) { fp_carousel_classes = ' ' + fp_carousel_classes.join( " " ); }    

                            var rawTemplate = '[fp-carousel{{carousel_classes}}]<br>';

                            for (var i = 0; i < e.data.items; i++) {
                                    var slider = i + 1;
                                    rawTemplate += "[fp-carousel-item image='' title='']{{content}} " + slider + "[/fp-carousel-item]<br>";                                    
                                } 

                            rawTemplate += '[/fp-carousel]<br>';  
                            rawTemplate += '&nbsp;';

                            var compiledTemplate = Handlebars.compile(rawTemplate); 
                            editor.insertContent(compiledTemplate({ 
                                content: fp_foundation_assistant_localized_script.tab_content, 
                                carousel_classes: fp_carousel_classes,                     
                            }));
                        }
                    });
                }
            }]
            },
            {
                text: fp_foundation_assistant_localized_script.menus,
                menu: [
                {
                    text: fp_foundation_assistant_localized_script.menu,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.menu,
                            width : 350,
                            height: 80,
                            body: [{
                                type: 'listbox', 
                                name: 'items', 
                                label: fp_foundation_assistant_localized_script.no_of_items, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                    {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                    {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                    {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                    {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                    {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                    {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                    {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                    {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                                ]
                            }],

                            onsubmit: function( e ) {
                                
                                var rawTemplate = '[fp-menu]<br>';

                                for (var i = 0; i < e.data.items; i++) {
                                        var item = i + 1;
                                        rawTemplate += "[fp-menu-item title='{{menu_item}} " + item + "' link='http://' ]<br>[/fp-menu-item]<br>";                                    
                                    } 

                                rawTemplate += '[/fp-menu]<br>';  
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({
                                    menu_item: fp_foundation_assistant_localized_script.menu_item,                                    
                                }));

                            }
                        });
                    }
                },{
                    text: fp_foundation_assistant_localized_script.nested_menu,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.nested_menu,
                            width : 350,
                            height: 90,
                            body: [{
                                type: 'listbox', 
                                name: 'items', 
                                label: fp_foundation_assistant_localized_script.no_of_items, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.one, value: '1'},
                                    {text: fp_foundation_assistant_localized_script.two, value: '2'},
                                    {text: fp_foundation_assistant_localized_script.three, value: '3'},
                                    {text: fp_foundation_assistant_localized_script.four, value: '4'},
                                    {text: fp_foundation_assistant_localized_script.five, value: '5'},
                                    {text: fp_foundation_assistant_localized_script.six, value: '6'},
                                    {text: fp_foundation_assistant_localized_script.seven, value: '7'},
                                    {text: fp_foundation_assistant_localized_script.eight, value: '8'},
                                    {text: fp_foundation_assistant_localized_script.nine, value: '9'},
                                    {text: fp_foundation_assistant_localized_script.ten, value: '10'}
                                ]
                            }],


                            onsubmit: function( e ) {
                                
                                var rawTemplate = '[fp-menu-nested]<br>';

                                for (var i = 0; i < e.data.items; i++) {
                                        var item = i + 1;
                                        rawTemplate += "[fp-submenu-item title='{{submenu_item}} " + item + "' link='http://' ]<br>[/fp-submenu-item]<br>";                                    
                                    } 

                                rawTemplate += '[/fp-menu-nested]<br>';  
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({
                                    submenu_item: fp_foundation_assistant_localized_script.submenu_item,                                    
                                }));

                            }
                        });
                    }
                }]   
            },
            {
                text:fp_foundation_assistant_localized_script.foundation_elements,
                menu: [
                {
                    text: fp_foundation_assistant_localized_script.buttons,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.buttons,
                            width : 300,
                            height: 230,
                            body: [{
                                type: 'listbox', 
                                name: 'type', 
                                label: fp_foundation_assistant_localized_script.element_type, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.element_button, value: ''},
                                    {text: fp_foundation_assistant_localized_script.element_link, value: "type='link'"},
                                    {text: fp_foundation_assistant_localized_script.element_submit, value: "type='submit'"},
                                    {text: fp_foundation_assistant_localized_script.element_reset, value: "type='reset'"},
                                ]
                            },{
                                type: 'listbox', 
                                name: 'size', 
                                label: fp_foundation_assistant_localized_script.element_size, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.tiny, value: "size='tiny'"},
                                    {text: fp_foundation_assistant_localized_script.small, value: "size='small'"},
                                    {text: fp_foundation_assistant_localized_script.large, value: "size='large'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'color', 
                                label: fp_foundation_assistant_localized_script.element_color, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.primary, value: ''},
                                    {text: fp_foundation_assistant_localized_script.secondary, value: "color='secondary'"},
                                    {text: fp_foundation_assistant_localized_script.success, value: "color='success'"},
                                    {text: fp_foundation_assistant_localized_script.alert, value: "color='alert'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'shape', 
                                label: fp_foundation_assistant_localized_script.element_shape, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.round, value: "shape='round'"},
                                    {text: fp_foundation_assistant_localized_script.radius, value: "shape='radius'"},
                                ]
                            },{
                                type: 'checkbox',
                                name: 'dropdown',
                                text: fp_foundation_assistant_localized_script.dropdown,   
                                classes: 'fp-dropdown-button'                 
                            }],
                            onsubmit: function( e ) {

                                var fp_button_classes = new Array();

                                if (e.data.size.length !== 0 ) { fp_button_classes.push( e.data.size); }   
                                if (e.data.color.length !== 0 ) { fp_button_classes.push( e.data.color); }   
                                if (e.data.type.length !== 0 ) { fp_button_classes.push( e.data.type); } 
                                if ( e.data.shape.length !== 0 ) { fp_button_classes.push( e.data.shape ); }
                                if ( e.data.dropdown === true) { fp_button_classes.push("dropdown='true'"); } 

                                if ( fp_button_classes.length !== 0 ) { fp_button_classes = ' ' + fp_button_classes.join( " " ); }
                    
                                var rawTemplate = '';
                                rawTemplate += "[fp-button{{button_classes}} link='']"; 
                                rawTemplate += '[/fp-button]<br>';  
                                rawTemplate += '&nbsp;';                  

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    button_classes: fp_button_classes,
                                }));
                                
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.callout,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.callout,
                            width: 300,
                            height: 100,
                            body: [{
                                type: 'listbox', 
                                name: 'color', 
                                label: fp_foundation_assistant_localized_script.element_color, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.alert, value: "color='alert'"},
                                    {text: fp_foundation_assistant_localized_script.secondary, value: "color='secondary'"},
                                    {text: fp_foundation_assistant_localized_script.success, value: "color='success'"}                                    
                                ]
                            },{
                                type: 'checkbox',
                                name: 'closable',
                                text: fp_foundation_assistant_localized_script.closable,   
                                classes: 'fp-closable-callout'                 
                            }],
                            onsubmit: function( e ) {

                                var fp_callout_classes = new Array();
 
                                if (e.data.color.length !== 0 ) { fp_callout_classes.push( e.data.color); }                                  
                                if( e.data.closable === true) { fp_callout_classes.push("closable='true'"); } 

                                if ( fp_callout_classes.length !== 0 ) { fp_callout_classes = ' ' + fp_callout_classes.join( " " ); }

                                var rawTemplate = "[fp-callout{{callout_classes}}]"; 
                                rawTemplate += "{{place_content}}"; 
                                rawTemplate += "[/fp-callout]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                     place_content: fp_foundation_assistant_localized_script.place_content,
                                     callout_classes:fp_callout_classes,
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.dropdown,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.dropdown,
                            width: 350,
                            height: 70,
                            body: [{
                                type: 'container',
                                name: 'container',
                                html: fp_foundation_assistant_localized_script.place_dropdown,   
                                classes: 'fp-dropdown'                 
                            }],
                            onsubmit: function( e ) {

                                var fp_dropdown_classes = new Array();
                                if ( fp_dropdown_classes.length !== 0 ) { fp_dropdown_classes = ' ' + fp_dropdown_classes.join( " " ); }

                                var rawTemplate = "[fp-dropdown{{dropdown_classes}} title='{{title}}']"; 
                                rawTemplate += "{{place_content}}"; 
                                rawTemplate += "[/fp-dropdown]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({                                    
                                    title: fp_foundation_assistant_localized_script.element_title,
                                    place_content: fp_foundation_assistant_localized_script.place_content,                                    
                                    dropdown_classes: fp_dropdown_classes,
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.flex_video,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.flex_video,
                            width: 300,
                            height: 90,
                            body: [{
                                type: 'checkbox',
                                name: 'widescreen',
                                text: fp_foundation_assistant_localized_script.widescreen,   
                                classes: 'fp-widescreen-video'                 
                            },{
                                type: 'checkbox',
                                name: 'vimeo',
                                text: fp_foundation_assistant_localized_script.vimeo,   
                                classes: 'fp-vimeo-video'                 
                            }],
                            onsubmit: function( e ) {

                                var fp_video_classes = new Array();

                                if(  e.data.widescreen === true  ) { fp_video_classes.push( "widescreen='true'" ); }
                                if(  e.data.vimeo === true  ) { fp_video_classes.push( "vimeo='true'" ); }

                                if ( fp_video_classes.length !== 0 ) { fp_video_classes = ' ' + fp_video_classes.join( " " ); }
                
                                var rawTemplate = "[fp-video{{video_clases}} link='{{embed_link}}' ]<br>"; 
                                rawTemplate += "[/fp-video]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({
                                    embed_link:fp_foundation_assistant_localized_script.embed_link,
                                    video_clases: fp_video_classes,      
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.interchange,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.interchange,
                            width: 370,
                            height:70,
                            body: [{
                                type: 'container', 
                                name: 'container', 
                                html: fp_foundation_assistant_localized_script.place_interchange                          
                            }],
                            onsubmit: function( e ) {

                                var rawTemplate = "[fp-interchange small='' medium='' large='']"; 
                                rawTemplate += "[/fp-interchange]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate());                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.element_label,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.element_label,
                            width: 300,
                            height: 110,
                            body: [{
                                type: 'listbox', 
                                name: 'color', 
                                label: fp_foundation_assistant_localized_script.element_color, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.primary, value: '' },
                                    {text: fp_foundation_assistant_localized_script.secondary, value: "color='secondary'"},
                                    {text: fp_foundation_assistant_localized_script.success, value: "color='success'"},
                                    {text: fp_foundation_assistant_localized_script.alert, value: "color='alert'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'shape', 
                                label: fp_foundation_assistant_localized_script.element_shape, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.round, value: "shape='round'" },
                                    {text: fp_foundation_assistant_localized_script.radius, value: "shape='radius'" },
                                ]
                            }],
                            onsubmit: function( e ) {

                                var fp_label_classes = new Array();

                                if ( e.data.color.length !== 0 ) { fp_label_classes.push( e.data.color ); } 
                                if ( e.data.shape.length !== 0 ) { fp_label_classes.push( e.data.shape ); } 

                                if ( fp_label_classes.length !== 0 ) { fp_label_classes = ' ' + fp_label_classes.join( " " ); }

                                var rawTemplate = "[fp-label{{label_classes}}]"; 
                                rawTemplate += "{{place_content}}"; 
                                rawTemplate += "[/fp-label]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    place_content: fp_foundation_assistant_localized_script.place_content,         
                                    label_classes: fp_label_classes,                                                           
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.progress,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.progress,
                            width: 300,
                            height: 150,
                            body: [{
                                type: 'listbox', 
                                name: 'color', 
                                label: fp_foundation_assistant_localized_script.element_color, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.primary, value: ''},
                                    {text: fp_foundation_assistant_localized_script.secondary, value: "color='secondary'"},
                                    {text: fp_foundation_assistant_localized_script.success, value: "color='success'"},
                                    {text: fp_foundation_assistant_localized_script.alert, value: "color='alert'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'size', 
                                label: fp_foundation_assistant_localized_script.element_size, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.small, value: "size='small'"},
                                    {text: fp_foundation_assistant_localized_script.large, value: "size='large'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'shape', 
                                label: fp_foundation_assistant_localized_script.element_shape, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.round, value: "shape='round'"},
                                    {text: fp_foundation_assistant_localized_script.radius, value: "shape='radius'"},
                                ]
                            }],
                            onsubmit: function( e ) {

                                var fp_progress_classes = new Array();

                                if ( e.data.color.length !== 0 ) { fp_progress_classes.push( e.data.color ); } 
                                if ( e.data.size.length !== 0 ) { fp_progress_classes.push( e.data.size ); } 
                                if ( e.data.shape.length !== 0 ) { fp_progress_classes.push( e.data.shape ); } 

                                if ( fp_progress_classes.length !== 0 ) { fp_progress_classes = ' ' + fp_progress_classes.join( " " ); }

                                var rawTemplate = "[fp-progress{{progress_classes}} width='50' ][/fp-progress]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    progress_classes: fp_progress_classes,
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.reveal,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.reveal,
                            width: 300,
                            height: 80,
                            body: [{
                                type: 'listbox', 
                                name: 'size', 
                                label: fp_foundation_assistant_localized_script.element_size, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.expand, value: "size='expand'"},
                                    {text: fp_foundation_assistant_localized_script.small, value: "size='small'"},
                                    {text: fp_foundation_assistant_localized_script.medium, value: "size='medium'"},
                                    {text: fp_foundation_assistant_localized_script.large, value: "size='large'"},
                                    {text: fp_foundation_assistant_localized_script.xlarge, value: "size='xlarge'"}
                                ]
                            }],
                            onsubmit: function( e ) {

                                var fp_reveal_classes = new Array();

                                if ( e.data.size.length !== 0 ) { fp_reveal_classes.push( e.data.size ); } 

                                if ( fp_reveal_classes.length !== 0 ) { fp_reveal_classes = ' ' + fp_reveal_classes.join( " " ); }

                                var rawTemplate = "[fp-reveal{{reveal_classes}} title='']"; 
                                rawTemplate += "{{place_content}}"; 
                                rawTemplate += "[/fp-reveal]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    place_content: fp_foundation_assistant_localized_script.place_content,                    
                                    reveal_classes: fp_reveal_classes,                                          
                                }));                            
                            }
                        });
                    }
                },
                {
                    text: fp_foundation_assistant_localized_script.tooltip,
                    onclick: function() {
                        editor.windowManager.open( {
                            title: fp_foundation_assistant_localized_script.tooltip,
                            width: 300,
                            height: 100,
                            body: [{
                                type: 'listbox', 
                                name: 'position', 
                                label: fp_foundation_assistant_localized_script.element_position, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.position_top, value: "position='top'"},
                                    {text: fp_foundation_assistant_localized_script.position_right, value: "position='right'"},
                                     {text: fp_foundation_assistant_localized_script.position_left, value: "position='left'"},
                                    {text: fp_foundation_assistant_localized_script.position_bottom, value: "position='bottom'"}
                                ]
                            },{
                                type: 'listbox', 
                                name: 'shape', 
                                label: fp_foundation_assistant_localized_script.element_shape, 
                                'values': [
                                    {text: fp_foundation_assistant_localized_script.basic, value: ''},
                                    {text: fp_foundation_assistant_localized_script.square, value: "shape='square'"}
                                ]
                            }],
                            onsubmit: function( e ) {

                                var fp_tooltip_classes = new Array();

                                if ( e.data.position.length !== 0 ) { fp_tooltip_classes.push( e.data.position ); } 
                                if ( e.data.shape.length !== 0 ) { fp_tooltip_classes.push( e.data.shape ); } 

                                if ( fp_tooltip_classes.length !== 0 ) { fp_tooltip_classes = ' ' + fp_tooltip_classes.join( " " ); }

                                var rawTemplate = "[fp-tooltip{{tooltip_classes}} title='']"; 
                                rawTemplate += "{{place_content}}"; 
                                rawTemplate += "[/fp-tooltip]<br>"; 
                                rawTemplate += '&nbsp;';

                                var compiledTemplate = Handlebars.compile(rawTemplate); 
                                editor.insertContent(compiledTemplate({ 
                                    place_content: fp_foundation_assistant_localized_script.place_content, 
                                    tooltip_classes: fp_tooltip_classes,                                 
                                }));                            
                            }
                        });
                    }
                }
                ]
            }   
           ]
        });
    });
})();	

