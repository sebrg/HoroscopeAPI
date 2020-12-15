<?php

session_start(); //Session, som localstorage ungefär... 

    if(isset($_SERVER['REQUEST_METHOD'])) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //Request method is POST
                
            if($_POST["date"] == null) { //Tar bort session om datum är fel.
                session_abort();
        }

                if(isset($_POST["date"])) {
                   
                    if(!isset($_SESSION["date"])) {

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

    function dateToZodiac($date) {
        $arr = array(
            "Capricorn" => "12-22-01-20",
            "Aquarius" => "01-21-02-18",
            "Pisces" => "02-19-03-19",
            "Aries" =>  "03-20-04-19",
            "Taurus" => "04-20-05-20",
            "Gemini" =>  "05-21-06-20",
            "Cancer" =>  "06-21-07-22",
            "Leo" =>     "07-23-08-22",
            "Virgo" =>   "08-23-09-22",
            "Libra" =>   "09-23-10-22",
            "Scorpio" => "10-23-11-21",
            "Sagittarius" => "11-22-12-21"
        );
        $splitString = explode("-", $date);
        $month = $splitString[1]; //index 1
        $day = $splitString[2]; //index 2

        foreach($arr as $myZodiacs => $myDates) {
            $dateTimeRange = explode("-", $myDates);
            $firstMonth = $dateTimeRange[0]; //Första månaden i ordningen i array.
            $firstDay = $dateTimeRange[1]; //första dagen i ordningen.
            $endMonth = $dateTimeRange[2]; //Sista månaden i ordningen.
            $endDay = $dateTimeRange[3]; //Sista dagen i ordningen.

            //Om månaden är exakt lika första månaden & dagen är större eller lika med första dagen i ordningen, eller
            //månaden är exakt lika slutmånaden & dagen är mindre eller lika med slutdagen i ordningen.
            if(($month === $firstMonth && $day >= $firstDay) || ($month === $endMonth && $day <= $endDay)) {
                    return $myZodiacs;
                  
            }
        }
    }   

?>