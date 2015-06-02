/**
 * Hotel events modile.
 */

(function(){
    
    function hotelevents_constructor(){
        
        this.layer_name = 'hotelevents';
        
        this.row_blocks = ['title'];
        
        this.load_params = {
            "type"   : "hotelevents",
            "action" : "get_ordered_list"
        };
        
        this.superclass = ListLayer.prototype;
        
        this.row_callback_timer;
        this.row_callback_timeout = 300;
        
        this.shift_row_callback = function(item){
            
            window.clearTimeout(this.row_callback_timer);
            
            var self = this;
            
            this.row_callback_timer = window.setTimeout(function(){
                
                self.fill_short_info(item);
                
            },
            this.row_callback_timeout);
        };
        
        this.fill_short_info = function(item){
            _debug('hotelevents.fill_short_info');
            
            this.short_info_box.innerHTML = '<span>' + item.title + ', '+item.datum+'</span><br><br>' + item.number;
        };
        
        this.init_short_info = function(){
            this.info_box = create_block_element('', this.main_container);
            
            this.short_info_box = create_block_element('hotelevents_info_box', this.info_box);
        };
        
        this.sort_menu_switcher = function(){
            if (this.sort_menu && this.sort_menu.on){
                this.sort_menu.hide();
            }else{
                this.sort_menu.show();
            }
        };
        
        this.init_sort_menu = function(map, options){
            this.sort_menu = new bottom_menu(this, options);
            this.sort_menu.init(map);
            this.sort_menu.bind();
        };
    }
    
    hotelevents_constructor.prototype = new ListLayer();
    
    var hotelevents = new hotelevents_constructor();
    
    hotelevents.bind();
    hotelevents.init();
    
    hotelevents.init_short_info();
    
    hotelevents.set_middle_container();
    
    hotelevents.init_left_ear(word['ears_back']);
    
    hotelevents.init_color_buttons([
        {"label" : word['cityinfo_sort'], "cmd" : hotelevents.sort_menu_switcher},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''}
    ]);
    
    hotelevents.init_sort_menu(
        [
            {"label" : word['hotelevents_main'], "cmd" : function(){this.parent.load_params.part = 'main'}},
            {"label" : word['hotelevents_help'], "cmd" : function(){this.parent.load_params.part = 'help'}},
            {"label" : word['hotelevents_other'], "cmd" : function(){this.parent.load_params.part = 'other'}}
        ],
        {
            "offset_x" : 27,
            "color"    : "red"
        }
    );
    
    hotelevents.init_header_path(word['hotelevents_title']);
    
    hotelevents.hide();
    
    module.hotelevents = hotelevents;
    
    if (!module.infoportal_sub){
        module.infoportal_sub = [];
    }
    
    module.infoportal_sub.push({
        "title" : word['hotelevents_title'],
        "cmd"   : function(){
            main_menu.hide();
            module.hotelevents.show();
        }
    })
    
    loader.next();
    
})();
