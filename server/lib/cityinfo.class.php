<?php
/**
 * City info class.
 * 
 * @package stalker_portal
 * @author zhurbitsky@gmail.com
 */

class Cityinfo extends AjaxResponse 
{
    public static $instance = NULL;
    
    public static function getInstance(){
        if (self::$instance == NULL)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function __construct(){
        parent::__construct();
    }
    
    private function getData(){
        
        $offset = $this->page * MAX_PAGE_ITEMS;
        
        $part = $_REQUEST['part'];
        
        if ($part == 'main'){
            $table = 'main_city_info';
        }elseif ($part == 'help'){
            $table = 'help_city_info';
        }else{
            $table = 'other_city_info';
        }
        
        return $this->db
                        ->from($table)
                        ->limit(MAX_PAGE_ITEMS, $offset);
    }
    
    public function getOrderedList(){
        
        $result = $this->getData();
        
        $result = $result->orderby('num');
        
        $this->setResponseData($result);
        
        return $this->getResponse('prepareData');
    }
    
    public function prepareData(){
        
        return $this->response;
    }
}

?>