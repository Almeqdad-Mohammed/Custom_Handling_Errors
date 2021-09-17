<?php
// class to set connection database
class Connect{

  // properties of connection database
  private $host = "localhost";
  private $dbname = "checking";
  private $user = "root";
  private $pass = "";
// other fann_clear_scaling_params
public $message =  array();
private $handle_execption;
private $success_message;
// private $error_message = array();

  public function __construct(){

    // set the param connection to data source name
    $dsn  = "mysql:host=" . $this->host .";dbname=" . $this->dbname;

    $option = array( PDO::ATTR_PERSISTENT =>true ,
                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

      // try to connect database
      try {
        $connect = new PDO($dsn , $this->user , $this->pass , $option);

        // assign successful message to array message
        return $this->success_message= "connection successfuly ";

      } catch (PDOException $execption) { // if not connected throw this messages

        // assign the execption object to this var
        $this->handle_execption= $execption;
      }

  }

  public function getExecptions(){
    // put your custom  execption message here
    $this->message[]= "Number of execption   :  " . $this->handle_execption->getCode();
    $this->message[]= "this message ". $this->handle_execption->getMessage() . " occurred on line ";
    $this->message[]= "<strong> " . $this->handle_execption->getLine() . " </strong>";
     // echo $trace =  explode( $this->handle_execption->getTrace() , '/');
    $this->message[]= $this->handle_execption->getTrace();
    $this->message[]= "And in the file ";
    $this->message[]= "<strong>" . $this->handle_execption->getFile() . "</srtong>";

    // finaly return this message to current function for output weathers
    return $this->message ;
    // if you want to logs this Errors or to sent someone have to
    error_log($this->message, 1 , 'techTeam@gmail.com', 'from: reportingTeam@gmail.com');

    // if the execption has been done serious then stop execution and tell the maintenance techTeam
    if ($this->handle_execption->getCode() !== E_NOTICE) {
      // say something to who use This system to know what going on

      die("Sorry the system is down for maintenance, please try later.....!");
    }
  }

}




  // create object from  current class to see what is happen inside class

  $conn = new Connect();

   // if info of connection is valid will get successful connection by this code
   #   echo $conn
   //  else will put empty array on the screen
    echo "<pre>";
     print_r($conn->getExecptions());  //  why using p----***-- rint_r because it's an array consertion not vars string
    echo "</pre>";

 ?>
