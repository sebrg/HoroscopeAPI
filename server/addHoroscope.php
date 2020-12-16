<?php

session_start(); //Session, som localstorage ungefär... 

include "./horoscopeFunction.php";

    if(isset($_SERVER['REQUEST_METHOD'])) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //Request method is POST
                
            if($_POST["date"] == null) { //Tar bort session om datum är fel.
                session_abort();
        }

                if(isset($_POST["date"])) {
                   
                    if(!isset($_SESSION["date"])) { //Går endast att spara om det inte finns session.

                        $myHoroscope = dateToZodiac($_POST["date"]);
                        $_SESSION["date"] = serialize($myHoroscope); 
                        echo json_encode(true); 
                    }
                }
                            else {
                                echo json_encode("Did not get date");
                            }
        }   
      
    }

    

?>