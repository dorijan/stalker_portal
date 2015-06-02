/**
 * Hotel events modile.
 */

(function(){
    
    function hotelinfo_constructor(){
        
        this.layer_name = 'hotelinfo';
        
        this.row_blocks = ['title'];
        
        this.load_params = {
            "type"   : "hotelinfo",
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
            _debug('hotelinfo.fill_short_info');
            
            this.short_info_box.innerHTML = '<span>' + item.title + '</span><br><br>' + item.number;
        };
        
        this.init_short_info = function(){
            this.info_box = create_block_element('', this.main_container);
            
            this.short_info_box = create_block_element('hotelinfo_info_box', this.info_box);
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
    
    hotelinfo_constructor.prototype = new ListLayer();
    
    var hotelinfo = new hotelinfo_constructor();
    
    hotelinfo.bind();
    hotelinfo.init();
    
    hotelinfo.init_short_info();
    
    hotelinfo.set_middle_container();
    
    hotelinfo.init_left_ear(word['ears_back']);
    
    hotelinfo.init_color_buttons([
        {"label" : word['cityinfo_sort'], "cmd" : hotelinfo.sort_menu_switcher},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''},
        {"label" : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "cmd" : ''}
    ]);
    
    hotelinfo.init_sort_menu(
        [
            {"label" : word['hotelinfo_main'], "cmd" : function(){this.parent.load_params.part = 'main'}},
            {"label" : word['hotelinfo_help'], "cmd" : function(){this.parent.load_params.part = 'help'}},
            {"label" : word['hotelinfo_other'], "cmd" : function(){this.parent.load_params.part = 'other'}}
        ],
        {
            "offset_x" : 27,
            "color"    : "red"
        }
    );
    
    hotelinfo.init_header_path(word['hotelinfo_title']);
    
    hotelinfo.hide();
    
    module.hotelinfo = hotelinfo;
    
    if (!module.infoportal_sub){
        module.infoportal_sub = [];
    }
    
    module.infoportal_sub.push({
        "title" : word['hotelinfo_title'],
        "cmd"   : function(){
            main_menu.hide();
            module.hotelinfo.show();
        }
    })
    
    loader.next();
    
})();
