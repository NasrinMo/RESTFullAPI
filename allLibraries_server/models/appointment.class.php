<?php

class Appointment {


    public function __construct(){
        
    }

    function getAllAppointments($userId){

        $db = SingletonPDO::getInstance();
        $oPDOStatement = $db->prepare(
            'SELECT a.id,b.title,l.name,a.appointmentDate,a.status
                FROM books b,libraries l,appointments a,library_book lb
                where b.id =lb.id_book
                and l.id =lb.id_library
                and a.id_library_book = lb.id
                and a.id_user = :id
                order by appointmentDate'
        );

        $oPDOStatement->bindParam(':id', $userId, PDO::PARAM_INT);

        $oPDOStatement->execute();
        $arrondissements = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $arrondissements;
    }

    function getAppointmentByID($id){

        $db = SingletonPDO::getInstance();
        $oPDOStatement = $db->prepare(
            "SELECT  a.id 'id_appointment',a.id_library_book,b.title,b.id 'id_book' ,l.name,l.id 'id_library',a.appointmentDate,a.status
                FROM books b,libraries l,appointments a,library_book lb
                where b.id =lb.id_book
                and l.id =lb.id_library
                and a.id_library_book = lb.id
                and a.id = :id
                order by appointmentDate"
        );

        $oPDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $oPDOStatement->execute();
        $arrondissement = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        
        return $arrondissement;
    }

    function createappointment($inputs){
        $arrayInputs = json_decode($inputs["postData"], true);
        $db = SingletonPDO::getInstance();

        $resultCkeckTime = $this -> checkTimeLibrary($arrayInputs);

        if ($resultCkeckTime["status"] === false) {
            $array = $resultCkeckTime;
        }else{

            //checking book for be not reserved at this time and this date
            $result = $this -> checkAppointment_insert($arrayInputs);

            if ($result["status"] === false) {
                
                $array = $result;
                $arraySuggestion = $this-> AppointmentsSuggestion($arrayInputs,"insert");

                if (count($arraySuggestion) > 0) {
                    $array["suggestion"] = $arraySuggestion ;
                }
            }else{

                $oPDOStatement = $db->prepare(
                    'INSERT INTO appointments 
                        ( id_user , id_library_book , status ,appointmentDate) 
                     VALUES (:id,
                             (select id from library_book where id_book=:id_book and id_library=:id_library) , 
                             "reserved" ,
                             :appointmentDate)'  
                  );

                $oPDOStatement->bindParam(':id', $arrayInputs["id-user"], PDO::PARAM_INT);
                $oPDOStatement->bindParam(':id_library', $arrayInputs["id_library"], PDO::PARAM_INT);
                $oPDOStatement->bindParam(':id_book', $arrayInputs["id_book"], PDO::PARAM_INT);
                $oPDOStatement->bindParam(':appointmentDate', $arrayInputs["appointmentDate"], PDO::PARAM_STR);

                if ($oPDOStatement->execute()) {
                     $array = array("status"  => true ,
                                    "message" => "Appointment Date Reserved Successfully");
                }else{
                     $array = array("status"  => false ,
                                    "message" => "Failed");
                }
            }
        }
       
        return  $array;    
        
    }


    function updateAppointment($input){
        
        $arrayInputs = json_decode($input["postData"], true);
        $db = SingletonPDO::getInstance();
        
        $resultCkeckTime = $this -> checkTimeLibrary($arrayInputs);

        if ($resultCkeckTime["status"] === false) {
            $array = $resultCkeckTime;
        }else{
            $result = $this -> checkAppointment_update($arrayInputs,"update");
            
            if ($result["status"] === false) {

                $array = $result;
                $arraySuggestion = $this-> AppointmentsSuggestion($arrayInputs,"update");

                if (count($arraySuggestion) > 0) {
                    $array["suggestion"] = $arraySuggestion ;
                }
            }else{

                $oPDOStatement = $db->prepare(
                    'UPDATE appointments 
                     SET appointmentDate = :appointmentDate
                     , id_library_book = (select id from library_book where id_book = :id_book  and id_library = :id_library) 
                     where id = :id'  
                );

                $oPDOStatement->bindParam(':appointmentDate', $arrayInputs["appointmentDate"], PDO::PARAM_STR);
                $oPDOStatement->bindParam(':id', $arrayInputs["id"], PDO::PARAM_INT);
                $oPDOStatement->bindParam(':id_book', $arrayInputs["id_book"], PDO::PARAM_INT);
                $oPDOStatement->bindParam(':id_library', $arrayInputs["id_library"], PDO::PARAM_INT);
                if ($oPDOStatement->execute()) {
                     $array = array("status"  => true ,
                                    "message" => "Successfully");
                }else{
                     $array = array("status"  => false ,
                                    "message" => "Failed");
                }
            }
        }

        return  $array;  
    }

    function checkAppointment_insert($array){  
        $db = SingletonPDO::getInstance();

        $appointmentDate = strtotime($array["appointmentDate"]);
        $newTime = date("H:i",$appointmentDate);
        $newTimePlus30 = date("H:i", strtotime('+30 minutes',strtotime($newTime)));
        $newDate = date("Y:m:d",$appointmentDate);

        $oPDOStatement = $db->prepare(
            'SELECT DATE_FORMAT(appointmentDate, "%H:%i") as `time` from appointments where DATE(appointmentDate) = :newDate
                AND status = "reserved"    
                ANd id_library_book = (select id 
                                       from library_book 
                                       where id_book =:id_book 
                                       and id_library=:id_library) '
        );
        
        $oPDOStatement->bindParam(':newDate', $newDate, PDO::PARAM_STR);
        $oPDOStatement->bindParam(':id_book', $array["id_book"], PDO::PARAM_INT);
        $oPDOStatement->bindParam(':id_library', $array["id_library"], PDO::PARAM_INT);

        $oPDOStatement->execute();
        $hours = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

        $flag = true;
        foreach ($hours as $key => $value) {

            $time = strtotime($value["time"]);
            $startTimeReserved = date("H:i", $time);
            $endTimeReserved = date("H:i", strtotime('+30 minutes',$time));
        
            if ( ($newTime >= $startTimeReserved && $newTime <= $endTimeReserved)
                || ($newTimePlus30 >= $startTimeReserved && $newTimePlus30 <= $endTimeReserved ) ) {
                $flag = false;
            }
            
        }
       
        if ( $flag === true) {
             $array = array("status"  => true ,
                              "message" => "valid time");
        }else{
             $array = array("status"  => false ,
                                "message" => "Appointment time range is in reserved range");
        }

        return $array;
    }

    function checkAppointment_update($array){  
        $db = SingletonPDO::getInstance();
   
        $appointmentDate = strtotime($array["appointmentDate"]);
        $newTime = date("H:i",$appointmentDate);
        $newTimePlus30 = date("H:i", strtotime('+30 minutes',strtotime($newTime)));
        $newDate = date("Y:m:d",$appointmentDate);

        $oPDOStatement = $db->prepare(
            'SELECT DATE_FORMAT(appointmentDate, "%H:%i") as `time` 
                from appointments where DATE(appointmentDate) = :newDate
                AND status = "reserved" 
                AND id <> :id_appointment
                ANd id_library_book = (select id 
                                       from library_book 
                                       where id_book =:id_book 
                                       and id_library=:id_library) '
        );
        
        $oPDOStatement->bindParam(':newDate', $newDate, PDO::PARAM_STR);
        $oPDOStatement->bindParam(':id_book', $array["id_book"], PDO::PARAM_INT);
        $oPDOStatement->bindParam(':id_library', $array["id_library"], PDO::PARAM_INT);
        $oPDOStatement->bindParam(':id_appointment', $array["id"], PDO::PARAM_INT);

        $oPDOStatement->execute();
        $hours = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

        $flag = true;

        if (count($hours) > 0) {
            foreach ($hours as $key => $value) {

                $time = strtotime($value["time"]);
                $startTimeReserved = date("H:i", $time);
                $endTimeReserved = date("H:i", strtotime('+30 minutes',$time));
            
                if ( ($newTime >= $startTimeReserved && $newTime <= $endTimeReserved)
                    || ($newTimePlus30 >= $startTimeReserved && $newTimePlus30 <= $endTimeReserved ) ) {
                    $flag = false;
                }
                
            }
        }
    
        if ( $flag === true) {
             $array = array("status"  => true ,
                              "message" => "valid time");
        }else{
             $array = array("status"  => false ,
                                "message" => "Appointment time range is in reserved range");
        }

        return $array;
    }

    function AppointmentsSuggestion($array,$action){
        
        $db = SingletonPDO::getInstance();

        $oPDOStatement = $db->prepare(
            'SELECT lb.* ,l.name
            FROM library_book lb,books b,libraries l
            where b.id = lb.id_book
            and l.id = lb.id_library
            and lb.id_book = :id_book
            and lb.id_library <> :id_library'  
          );
       
        $oPDOStatement->bindParam(':id_library', $array["id_library"], PDO::PARAM_INT);
        $oPDOStatement->bindParam(':id_book', $array["id_book"], PDO::PARAM_INT);
  
        $oPDOStatement->execute();
        $libraries = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);  

        $arrayinput = array( "appointmentDate" => $array["appointmentDate"],
                            "id_book" => $array["id_book"],
                            "id" => $array["id"] );
        //set appointment id we need it in checkAppointment function

        $validlibraries = "";

         

        foreach ($libraries as $key => $value) {

            $arrayinput["id_library"] =  $value["id_library"] ;

            if ($action == "insert") {
                $resultCheck = $this->checkAppointment_insert($arrayinput);
            }elseif($action == "update"){
                $resultCheck = $this->checkAppointment_update($arrayinput);

            }
           
            if ($resultCheck["status"]) {
               $validlibraries .= $value["id_library"]. ",";

            }
            
        }

        $validlibraries = substr( $validlibraries, 0, -1);

        $oPDOStatement = $db->prepare(
            'SELECT lb.* ,l.name
            FROM library_book lb,books b,libraries l
            where b.id = lb.id_book
            and l.id = lb.id_library
            and lb.id_book = :id_book
            and lb.id_library in ('.$validlibraries.')'
        );
   
        $oPDOStatement->bindParam(':id_book', $array["id_book"], PDO::PARAM_INT);
  
        $oPDOStatement->execute();
        $librariesSuggestion = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
 
        return $librariesSuggestion; 
    }

    function checkTimeLibrary($array){
        
        $db = SingletonPDO::getInstance();

        $oPDOStatement = $db->prepare(
            'SELECT p.* , lp.* 
                  from workpattern p 
                  join library_patern lp on p.id = lp.id_pattern 
                  where id_library = :id_library
                         '  
          );
       
        $oPDOStatement->bindParam(':id_library', $array["id_library"], PDO::PARAM_STR);

        $oPDOStatement->execute();
        $data = $oPDOStatement->fetch(PDO::FETCH_ASSOC);

        $arrayPattern = json_decode($data["pattern"],true);

        $timestamp = strtotime($array["appointmentDate"]);
        $day = date('l', $timestamp);
        $patternTime = $arrayPattern[$day];   
        
        if ($patternTime === "close") {
            $array = array("status"  => false ,
                                "message" => "Library is Closed For Selected Time");
        }else{
            $startTimePattern = substr($patternTime,0,5);
            $sTime = strtotime($startTimePattern);
            $startLibraryTime = date('H:i', $sTime);

            $endTimePattern = substr($patternTime,6);
            $eTime = strtotime($endTimePattern);
            $endLibraryTime = date('H:i', $eTime);

            $time = strtotime($array["appointmentDate"]);
            $appointmentTime = date('H:i', $time);
          
            if ( $appointmentTime >  $startLibraryTime &&  $appointmentTime < $endLibraryTime) {
                $array = array("status"  => true ,
                                "message" => "Valid Time");
            }else{
                $array = array("status"  => false ,
                                "message" => "Appointment Time is not valid for this library");
            }
        }
 
        return $array;

    }

    function removeAppointment($id_appointment){
        $db = SingletonPDO::getInstance();
        $oPDOStatement = $db->prepare(
            'DELETE from appointments where id = :id_appointment '  
          );

        $oPDOStatement->bindParam(':id_appointment', $id_appointment, PDO::PARAM_INT);

        if ($oPDOStatement->execute()) {
             $array = array("status"  => true ,
                            "message" => "Appointment Deleted Successfully");
        }else{
             $array = array("status"  => false ,
                            "message" => "Failed");
        }

        return $array;
    }

    
}