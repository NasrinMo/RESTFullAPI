<?php 
/**
 * 
 */
class ControllerAppointment
{
	private $_appointment;

	public function __construct(){
        $this->_appointment = new Appointment();
    }

    public function list($userId){
        
        $appointments = $this->_appointment->getAllAppointments($userId);
        $jsonAppointments = json_encode($appointments);
        
        echo $jsonAppointments;
    }

    public function getAppointment($id){

        $appointment = $this->_appointment->getAppointmentByID($id);
        $jsonAppointment = json_encode($appointment);
        
        echo $jsonAppointment;
    }

	public function create($array){ 
        
        $result = $this->_appointment->createappointment($array); 
		$jsonResult = json_encode($result);

		echo $jsonResult;
    }

    public function remove($id_appointment){ 
        $result = $this->_appointment->removeAppointment($id_appointment);
		$jsonResult = json_encode($result);

		echo $jsonResult;
    }

    public function edit($array){ 
   		$result =$this->_appointment-> updateAppointment($array);
		$jsonResult = json_encode($result);

		echo $jsonResult;
    }

    public function pwd_validate($user,$pass) {
        $users = array('582P41' => 'ABC123!');

        if (isset($users[$user]) && ($users[$user] == $pass)) {
            return true;
        } else {
            return false;
        }
    }


}