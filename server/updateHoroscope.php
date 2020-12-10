<?php 

session_start();

include "./addHoroscope.php";

    if(isset($_SERVER['REQUEST_METHOD'])) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Request method is GET
            if(isset($_POST["date"])) {

                if(isset($_SESSION["date"])) { 
                  
                    $myHoroscope = dateToZodiac($_POST["date"]); 
                    $_SESSION["date"] = serialize($myHoroscope); 
                    echo json_encode(true); 
                }  
        }

                    else {
                        echo json_encode(false);
                    }
        
    }   
    
    
}  




?>