<?php
include('adminCommon.html');
class patientmessage
{
  private $d_name;
  private $p_id;
  private $time;
  private $date;


  public function getd_name() {return $this->d_name; }
  public function getp_id() {return $this->p_id; }
  public function gettime(){return $this->time;}
  public function getdate() {return $this->date; }
  
}

$did= filter_input(INPUT_GET, "did");
try{
include('connection.php');

$query= "call send_message8(:did)";
$data=$con->prepare($query);
$data->bindParam(':did',$did);
$data->execute();

$query = "delete from doctor where d_id=:did";
$data=$con->prepare($query);
$data->bindParam(':did',$did);
$data->execute();

print "Doctor was deleted from the databases and all the patients with appointments under him were notified";

}
catch(PDOException $ex) {
  echo 'ERROR: '.$ex->getMessage();
}

catch(Exception $ex) {
  echo 'ERROR: '.$ex->getMessage();
}

?>
