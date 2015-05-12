<?php


require 'connection.php';

class transfer_finish{
	private $db,$sql,$stmt,$row,$date_now;
	
	public function __construct(){
		$this->db = new connection();
		$this->db = $this->db->dbConnect();

	}
	public function updatefields(){
		
		/*$this->sql =
        "INSERT INTO archv_finished 
        (strjrfnum,strquarter,strmon,stryear,strdate,strtime,strusername,strusereadd,strcompany,strdepartment,strloc,strposition,strtelephone,strcostcent,strsubject,strnature,strarea,strdescript,strattach,strpriority,strduedate,strstatus,strlastedit,strcategory,strassigned,strdatecomplete,strifoverdue,strwithpr,strremarks,sap_num)
        SELECT strjrfnum,strquarter,strmon,stryear,strdate,strtime,strusername,strusereadd,strcompany,strdepartment,strloc,strposition,strtelephone,strcostcent,strsubject,strnature,strarea,strdescript,strattach,strpriority,strduedate,strstatus,strlastedit,strcategory,strassigned,strdatecomplete,strifoverdue,strwithpr,strremarks,sap_num FROM  jrf_tbl
        WHERE strstatus='Finished'";*/
		$this->sql= "DELETE FROM jrf_tbl WHERE strstatus='Finished'";
		//$this->sql = "UPDATE jrf_tbl SET strifoverdue ='overdue' WHERE strstatus <> 'Finished' AND strstatus <> 'Cancelled' AND  strduedate < '$date_now' ";
		$this->stmt = $this->db->prepare($this->sql);
		$this->stmt->execute();

			if($this->stmt->rowCount()){
				while($this->row = $this->stmt->fetch(PDO::FETCH_OBJ)){
				}
				"<br> Affected rows: ". $this->stmt->rowCount();
				};
		}


}//End Class

	$OverDue = new transfer_finish();
	$OverDue->updatefields();