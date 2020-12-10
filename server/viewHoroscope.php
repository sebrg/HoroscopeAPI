<?php 


session_start();

    include "./addHoroscope.php";

        if(isset($_SERVER['REQUEST_METHOD'])) {

            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                
                //Request method is GET
   
                if(isset($_SESSION["date"])) { 
                      
                    echo json_encode(unserialize($_SESSION["date"]));
                
                }
                        else {
                            echo json_encode(false);
                        }
            
            }   
        
        
    }  
   


?>