<?php
	class View{  
  
		// Path to template
    private $path = 'templates';  
    private $template = 'default';  
  
  
    // Varibles to send to template
    private $_ = array();  
  
    
    // Variables get a key
    public function assign($key, $value){  
        $this->_[$key] = $value;  
    }  
  
  
    //Set the name of the template
    public function setTemplate($template = 'default'){  
        $this->template = $template;  
    }  
  
    
    // Load template file 
    public function loadTemplate(){  
        $tpl = $this->template;  
               
        // Set path to the template 
        $file = $this->path . DIRECTORY_SEPARATOR . $tpl . '.php';  
        $exists = file_exists($file);  
  
        if ($exists){  
            ob_start();  
                  
            include $file;  
            
            $output = ob_get_contents();  
            ob_end_clean();  
              
            return $output;  
        }  
        else {  
            return 'could not find template';  
        }  
    }  
	} 
?>