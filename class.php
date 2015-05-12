<?php

include_once 'connection.php';

class general{
    public $db, $sql, $set_id, $msg, $stmt, $addlogs,$rows; //for query
    public $name,$auth,$action; //for logs
    public $alert_msg, $err_msg; //Alert Message
    
}//EndClass

class scriptwrapper{
   
    public function __construct(){
    }

    public function JAlert($msg,$set_id){
        $this->msg = $msg;
        $this->set_id = $set_id;
        return  "<script type=text/javascript>alert('$this->msg');window.location.href='jrf_tblview.php?ID=$this->set_id';</script>";
    }

}//EndClass


class user{
    public $start,$fullname,$username,$company,$dept,$loc,$position,$authorization,$role,$emailadd,$costcent,$telephone;
    private $uname,$pword;

    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
     }

    public function getUser($name,$password){
        $this->uname = $name;
        $this->pword = $password;
        $this->action = "Login";
    }

    public function login(){
        $this->sql ="SELECT * FROM login WHERE strusername =? AND strpassword =?";
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$this->uname, PDO::PARAM_STR);
        $this->stmt->bindParam(2,$this->pword, PDO::PARAM_STR);
        $this->stmt->execute();

            if($this->stmt->rowCount()==1){
                while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
                $this->start = TRUE; //session start
                $this->fullname = $this->rows->strfullname; 
                $this->username = $this->rows->strusername; 
                $this->company = $this->rows->strcompany; 
                $this->dept = $this->rows->strdept; 
                $this->loc = $this->rows->strloc; 
                $this->position = $this->rows->strposition; 
                $this->authorization = $this->rows->strauthorization; 
                $this->role = $this->rows->strrole; 
                $this->emailadd = $this->rows->stremailadd; 
                $this->costcent = $this->rows->strcostcent; 
                $this->telephone = $this->rows->strtelephone; 
                }
                
                $this->addlogs = new logs();
                $this->addlogs->addLogs($this->fullname,$this->authorization,$this->action);
                    header('location:welcome.php');
            }else{
                echo  "<script type=text/javascript>alert('Invalid Username or Password!');</script>";
                $this->start = FALSE;//session start
                 $this->start = TRUE; //session start
                $this->fullname ="";
                $this->username =""; 
                $this->company ="";
                $this->dept ="";
                $this->loc = "";
                $this->position = "";
                $this->authorization = "";
                $this->emailadd = ""; 
                $this->costcent = "";
                $this->telephone = "";
            }//EndIf
    }
}//EndClass

Class Record{
    public $ID,$strjrfnum,$strquarter,$strmon,$stryear,$strdate,$strtime,$strusername,$strcompany,$strdepartment,$strloc;
    public $strposition,$strtelephone,$strcostcent,$strsubject,$strnature,$strdescript,$strarea,$strattach,$strpriority,$strduedate,$strstatus;
    public $strlastedit,$strcategory,$strassigned,$strremarks,$strdatecomplete,$strwithpr,$work_days,$sap_num,$strfixed_asset,$strattach2;
    private $remarks,$db_remarks,$date_now;
    
    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
        
    }

    public function addRecord($fields){
        $this->sql = 
        "INSERT INTO jrf_tbl
        (strjrfnum,strquarter,strmon,stryear,strdate,strtime,strusername,strusereadd,strcompany,strdepartment,strloc,strposition,strtelephone,strcostcent,strsubject,strnature,strarea,strdescript,strattach,strpriority,strduedate,strstatus)
        VALUES
        (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$fields['strjrfnum'],PDO::PARAM_STR);
        $this->stmt->bindParam(2,$fields['strquarter'],PDO::PARAM_STR);
        $this->stmt->bindParam(3,$fields['strmon'],PDO::PARAM_STR);
        $this->stmt->bindParam(4,$fields['stryear'],PDO::PARAM_STR);
        $this->stmt->bindParam(5,$fields['strdate'],PDO::PARAM_STR);
        $this->stmt->bindParam(6,$fields['strtime'],PDO::PARAM_STR);
        $this->stmt->bindParam(7,$fields['strusername'],PDO::PARAM_STR);
        $this->stmt->bindParam(8,$fields['strusereadd'],PDO::PARAM_STR);
        $this->stmt->bindParam(9,$fields['strcompany'],PDO::PARAM_STR);
        $this->stmt->bindParam(10,$fields['strdepartment'],PDO::PARAM_STR);
        $this->stmt->bindParam(11,$fields['strloc'],PDO::PARAM_STR);
        $this->stmt->bindParam(12,$fields['strposition'],PDO::PARAM_STR);
        $this->stmt->bindParam(13,$fields['strtelephone'],PDO::PARAM_STR);
        $this->stmt->bindParam(14,$fields['strcostcent'],PDO::PARAM_STR);
        $this->stmt->bindParam(15,$fields['strsubject'],PDO::PARAM_STR);
        $this->stmt->bindParam(16,$fields['strnature'],PDO::PARAM_STR);
        $this->stmt->bindParam(17,$fields['strarea'],PDO::PARAM_STR);
        $this->stmt->bindParam(18,$fields['strdescript'],PDO::PARAM_STR);
        $this->stmt->bindParam(19,$fields['strattach'],PDO::PARAM_STR);
        $this->stmt->bindParam(20,$fields['strpriority'],PDO::PARAM_STR);
        $this->stmt->bindParam(21,$fields['strduedate'],PDO::PARAM_STR);
        $this->stmt->bindParam(22,$fields['strstatus'],PDO::PARAM_STR);
        $this->stmt->execute();
    }


    public function viewRecord($set_id){
        $this->set_id = $set_id;
        $this->sql="SELECT * from jrf_tbl WHERE ID=?";
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1, $this->set_id, PDO::PARAM_INT);
        $this->stmt->execute();

        if($this->stmt->rowCount()){
                while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
                    $this->ID= $this->rows->ID;
                    $this->strjrfnum= $this->rows->strjrfnum;
                    $this->strquarter= $this->rows->strquarter;
                    $this->strmon= $this->rows->strmon;
                    $this->stryear  = $this->rows->stryear;
                    $this->strdate= $this->rows->strdate;
                    $this->strtime= $this->rows->strtime;
                    $this->strusername= $this->rows->strusername;
                    $this->strusereadd= $this->rows->strusereadd;
                    $this->strcompany= $this->rows->strcompany;
                    $this->strdepartment= $this->rows->strdepartment;
                    $this->strloc= $this->rows->strloc;
                    $this->strposition= $this->rows->strposition;
                    $this->strtelephone= $this->rows->strtelephone;
                    $this->strcostcent= $this->rows->strcostcent;
                    $this->strsubject= $this->rows->strsubject;
                    $this->strnature= $this->rows->strnature;
                    $this->strdescript= $this->rows->strdescript;
                    $this->strarea= $this->rows->strarea;
                    $this->strattach= $this->rows->strattach;
                    $this->strpriority= $this->rows->strpriority;
                    $this->strduedate= $this->rows->strduedate;
                    $this->strstatus= $this->rows->strstatus;
                    $this->strlastedit= $this->rows->strlastedit;
                    $this->strcategory= $this->rows->strcategory;
                    $this->strassigned= $this->rows->strassigned;
                    $this->strremarks= $this->rows->strremarks;
                    $this->strdatecomplete= $this->rows->strdatecomplete;
                    $this->strwithpr= $this->rows->strwithpr;
                    $this->sap_num= $this->rows->sap_num;
                    $this->strfixed_asset= $this->rows->strfixed_asset;
                    $this->strattach2= $this->rows->strattach2;
                }//while
        }//EndIf
    }



    public function finish_table($set_id){
        $this->set_id = $set_id;
        $this->sql="SELECT * from archv_finished WHERE ID=?";
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1, $this->set_id, PDO::PARAM_INT);
        $this->stmt->execute();

        if($this->stmt->rowCount()){
                while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
                    $this->ID= $this->rows->ID;
                    $this->strjrfnum= $this->rows->strjrfnum;
                    $this->strquarter= $this->rows->strquarter;
                    $this->strmon= $this->rows->strmon;
                    $this->stryear  = $this->rows->stryear;
                    $this->strdate= $this->rows->strdate;
                    $this->strtime= $this->rows->strtime;
                    $this->strusername= $this->rows->strusername;
                    $this->strusereadd= $this->rows->strusereadd;
                    $this->strcompany= $this->rows->strcompany;
                    $this->strdepartment= $this->rows->strdepartment;
                    $this->strloc= $this->rows->strloc;
                    $this->strposition= $this->rows->strposition;
                    $this->strtelephone= $this->rows->strtelephone;
                    $this->strcostcent= $this->rows->strcostcent;
                    $this->strsubject= $this->rows->strsubject;
                    $this->strnature= $this->rows->strnature;
                    $this->strdescript= $this->rows->strdescript;
                    $this->strarea= $this->rows->strarea;
                    $this->strattach= $this->rows->strattach;
                    $this->strpriority= $this->rows->strpriority;
                    $this->strduedate= $this->rows->strduedate;
                    $this->strstatus= $this->rows->strstatus;
                    $this->strlastedit= $this->rows->strlastedit;
                    $this->strcategory= $this->rows->strcategory;
                    $this->strassigned= $this->rows->strassigned;
                    $this->strremarks= $this->rows->strremarks;
                    $this->strdatecomplete= $this->rows->strdatecomplete;
                    $this->strwithpr= $this->rows->strwithpr;
                    $this->sap_num= $this->rows->sap_num;
                    $this->work_days= $this->rows->work_days;
                }//while
        }//EndIf
    }

    public function view_tech($sql){
    $this->sql=$sql;
    $this->stmt=$this->db->prepare($this->sql);
    $this->stmt->execute();
        
        if($this->stmt->rowCount()){
            while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
                echo "<option>",$this->rows->strtechname,"</option>";
            }
        }//EndIf
    }

    public function view_categories($sql){
    $this->sql=$sql;
    $this->stmt=$this->db->prepare($this->sql);
    $this->stmt->execute();
        
        if($this->stmt->rowCount()){
            while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
                echo "<option>",$this->rows->strcategory,"</option>";
            }
        }//EndIf
    }


    public function addRemarks($rem,$db_remarks){
        $this->date_now = date("Y-m-d H:i:s"); 
        $this->remarks = $rem;
        $this->db_remarks = $db_remarks;

        $this->remarks = trim($this->remarks);
       return $this->remarks =$this->remarks . " " . $this->date_now ."\r\n" ."\r\n" .$this->db_remarks;
    }
}//EndClass



Class UpdateClass{
    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
    }

    public function getUpdateVar($sql, $set_id,$msg){
        $this->msg = $msg;
        $this->sql = $sql;
        $this->set_id=$set_id;
    }

    public function updateView($name,$auth,$action){
        $this->name = $name;
        $this->auth = $auth;
        $this->action = $action;

        $query = "UPDATE jrf_tbl SET $this->sql WHERE ID =?";
        $this->stmt = $this->db->prepare($query);
        $this->stmt->bindParam (1,$this->set_id, PDO::PARAM_INT);
        $this->stmt->execute();

        $this->addlogs = new logs();
        $this->alert_msg = new scriptwrapper();
        
        if($this->stmt->rowCount()==1){
            //add to logs
            $this->addlogs->addLogs($this->name,$this->auth,$this->action);
            // message
            if($this->auth =="approver"){
                    echo  "<script type=text/javascript>alert('$this->msg');window.location.href='jrf_tbledit.php?ID=$this->set_id';</script>";
                }elseif($this->auth =="editor"){
                    echo  "<script type=text/javascript>alert('$this->msg');window.location.href='jrf_tbledit.php?ID=$this->set_id';</script>";
                }else{
            echo $this->alert_msg->JAlert($this->msg,$this->set_id);
            }
          
        }else{
            $this->err_msg= "There is an ERROR!, Please Contact the System Developer";
            echo $this->alert_msg->JAlert($this->err_msg,$this->set_id);
          
        };
    }

    public function UpdateViewOnly($sql){
            $this->sql = $sql;
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->execute();
    }

    public function markFinished($ID,$strjrfnum,$strquarter,$strmon,$stryear,$strdate,$strtime,$strusername,$strusereadd,$strcompany,$strdepartment,$strloc,$strposition,$strtelephone,$strcostcent,$strsubject,$strnature,$strdescript,$strarea,$strattach,$strpriority,$strduedate,$finished,$global_user_fullname,$strcategory,$strassigned,$strdate_now,$strwithpr,$strfinish_remarks,$sap_num,$total_work_num,$strattach2,$name,$auth,$action){
        $this->name = $name;
        $this->auth = $auth;
        $this->action = $action;

         $query =
        "INSERT INTO archv_finished 
        (ID,strjrfnum,strquarter,strmon,stryear,strdate,strtime,strusername,strusereadd,strcompany,strdepartment,strloc,strposition,strtelephone,strcostcent,strsubject,strnature,strdescript,strarea,strattach,strpriority,strduedate,strstatus,strlastedit,strcategory,strassigned,strdatecomplete,strwithpr,strremarks,sap_num,work_days,strattach2)
        VALUES
        (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);
                
        DELETE FROM jrf_tbl WHERE ID='$this->set_id';";
        
        $this->stmt = $this->db->prepare($query);
        $this->stmt->bindParam (1,$ID, PDO::PARAM_STR);
        $this->stmt->bindParam (2,$strjrfnum, PDO::PARAM_STR);
        $this->stmt->bindParam (3,$strquarter, PDO::PARAM_STR);
        $this->stmt->bindParam (4,$strmon, PDO::PARAM_STR);
        $this->stmt->bindParam (5,$stryear, PDO::PARAM_STR);
        $this->stmt->bindParam (6,$strdate, PDO::PARAM_STR);
        $this->stmt->bindParam (7,$strtime, PDO::PARAM_STR);
        $this->stmt->bindParam (8,$strusername, PDO::PARAM_STR);
        $this->stmt->bindParam (9,$strusereadd, PDO::PARAM_STR);
        $this->stmt->bindParam (10,$strcompany, PDO::PARAM_STR);
        $this->stmt->bindParam (11,$strdepartment, PDO::PARAM_STR);
        $this->stmt->bindParam (12,$strloc, PDO::PARAM_STR);
        $this->stmt->bindParam (13,$strposition, PDO::PARAM_STR);
        $this->stmt->bindParam (14,$strtelephone, PDO::PARAM_STR);
        $this->stmt->bindParam (15,$strcostcent, PDO::PARAM_STR);
        $this->stmt->bindParam (16,$strsubject, PDO::PARAM_STR);
        $this->stmt->bindParam (17,$strnature, PDO::PARAM_STR);
        $this->stmt->bindParam (18,$strdescript, PDO::PARAM_STR);
        $this->stmt->bindParam (19,$strarea, PDO::PARAM_STR);
        $this->stmt->bindParam (20,$strattach, PDO::PARAM_STR);
        $this->stmt->bindParam (21,$strpriority, PDO::PARAM_STR);
        $this->stmt->bindParam (22,$strduedate, PDO::PARAM_STR);
        $this->stmt->bindParam (23,$finished, PDO::PARAM_STR);
        $this->stmt->bindParam (24,$global_user_fullname, PDO::PARAM_STR);
        $this->stmt->bindParam (25,$strcategory, PDO::PARAM_STR);
        $this->stmt->bindParam (26,$strassigned, PDO::PARAM_STR);
        $this->stmt->bindParam (27,$strdate_now, PDO::PARAM_STR);
        $this->stmt->bindParam (28,$strwithpr, PDO::PARAM_STR);
        $this->stmt->bindParam (29,$strfinish_remarks, PDO::PARAM_STR);
        $this->stmt->bindParam (30,$sap_num, PDO::PARAM_STR);
        $this->stmt->bindParam (31,$total_work_num, PDO::PARAM_STR);
        $this->stmt->bindParam (32,$strattach2, PDO::PARAM_STR);

        $this->stmt->execute();

        $this->addlogs = new logs();
        $this->alert_msg = new scriptwrapper();
        
        if($this->stmt->rowCount()){
            //add to logs
            $this->addlogs->addLogs($this->name,$this->auth,$this->action);
                echo  "<script type=text/javascript>alert('$this->msg');window.location.href='archv_finishedview.php?ID=$this->set_id';</script>";
       }else{
            $this->err_msg= "There is an ERROR!, Please Contact the System Developer";
            echo $this->alert_msg->JAlert($this->err_msg,$this->set_id);
          
        };
    }


    public function updateOverDue($overdue_id,$val){
        $this->set_id = $overdue_id;
        $query = "UPDATE jrf_tbl SET strifoverdue=? WHERE ID =?";
        $this->stmt = $this->db->prepare($query);
        $this->stmt->bindParam (1,$val, PDO::PARAM_STR);
        $this->stmt->bindParam (2,$this->set_id, PDO::PARAM_INT);
        $this->stmt->execute();

    }


}//EndClass

class viewCostCenter{
    
    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
    }    

    public function chargedTo($jrf){
        $this->sql ="SELECT DISTINCT strcostcent FROM pr_tbl WHERE strjrfnum = '$jrf'";
        $this->stmt= $this->db->prepare($this->sql);
        $this->stmt->execute();

        if($this->stmt->rowCount()){
            while($this->row= $this->stmt->fetch(PDO::FETCH_OBJ)){
                echo $this->row->strcostcent . "<br>";
            }
        }
    }
}//EndClass


class updateOverdue{
    private $db,$sql,$stmt,$row,$date_now;
    
    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();

    }
    public function updatefields($sql){
        $this->sql = $sql;
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->execute();

            if($this->stmt->rowCount()){
                while($this->row = $this->stmt->fetch(PDO::FETCH_OBJ)){
                }
                "<br> Affected rows: ". $this->stmt->rowCount();
                };
        }


}//End Class


class logs {
  
    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
    }

    public function addLogs($name,$auth,$action){
        $this->name=$name;
        $this->auth=$auth;
        $this->action=$action;

    $this->sql =
    "INSERT INTO logs 
        (struname,strdate,strauthorization,straction) 
    VALUES 
        (?,NOW(),?,?)" ;
    $this->stmt = $this->db->prepare($this->sql);
    $this->stmt->bindParam(1,$this->name, PDO::PARAM_STR);
    $this->stmt->bindParam(2,$this->auth, PDO::PARAM_STR);
    $this->stmt->bindParam(3,$this->action, PDO::PARAM_STR);
    $this->stmt->execute();
    }
}//EndClass


class PR{
   private $status,$pr, $num;
   public $div;
    
    public function __construct($set_id){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
        $this->set_id = $set_id;
    }

    public function set1PR($num,$id,$status,$fixed_asset){
       
       
        $this->sql = "UPDATE jrf_tbl SET strwithpr =?,strfixed_asset=? WHERE ID =?";
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$num, PDO::PARAM_STR);
        $this->stmt->bindParam(2,$fixed_asset, PDO::PARAM_STR);
        $this->stmt->bindParam(3,$id, PDO::PARAM_STR);
        $this->stmt->execute();
    }

    public function insertPR($jrfnum,$strquantity,$stritmname,$strunit,$stritmdesc,$remarks,$status,$charged_to){
        $this->status = $status;
        $this->sql = "INSERT INTO pr_tbl (strjrfnum,strquantity,stritmname,strunit,stritmdesc,strcostcent) VALUES (?,?,?,?,?,?)";
        $this->stmt=$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$jrfnum,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$strquantity,PDO::PARAM_STR);
        $this->stmt->bindParam(3,$stritmname,PDO::PARAM_STR);
        $this->stmt->bindParam(4,$strunit,PDO::PARAM_STR);
        $this->stmt->bindParam(5,$stritmdesc,PDO::PARAM_STR);
        $this->stmt->bindParam(6,$charged_to,PDO::PARAM_STR);
        $this->stmt->execute();

            if($this->stmt->rowCount()==1){
                $this->sql = "UPDATE jrf_tbl SET strstatus=?,strremarks=? WHERE ID=?";
                $this->stmt =$this->db->prepare($this->sql);
                $this->stmt->bindParam(1,$this->status,PDO::PARAM_STR);
                $this->stmt->bindParam(2,$remarks,PDO::PARAM_STR);
                $this->stmt->bindParam(3,$this->set_id,PDO::PARAM_STR);
                $this->stmt->execute();

        }
    }    


    public function viewPR($jrfnum){
        $this->sql="SELECT * FROM pr_tbl WHERE strjrfnum=? ORDER BY ID ASC";
        $this->stmt=$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$jrfnum, PDO::PARAM_STR);
        $this->stmt->execute();
        
        $i = 0;
        if($this->stmt->rowCount()){
            while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
            $x = $i +1;

            echo "<tr> <td class=viewtd style='color:black;'> <label>" , $x ,"</label></td>" ,
            "<td><input type=text readonly  class=form-control name=strquantity[] size=5 style='font-size:12px' value=\"",$this->rows->strquantity,"\"></td>
            <td><input type=text readonly class=form-control name=strunit[] size=5 style='font-size:12px' value=\"",$this->rows->strunit,"\"></td>
            <td><input type=text readonly class=form-control name=stritmname[] style='font-size:12px' value=\"",$this->rows->stritmname,"\"></td>
            <td><input type=text readonly class=form-control name=stritmdesc[] style='width:350px;font-size:12px' value=\"",$this->rows->stritmdesc,"\"></td>
            </tr>";
            $i++;
            }//Switch
        }//EndIf
    }


      public function editPR($jrfnum){
        $this->sql="SELECT * FROM pr_tbl WHERE strjrfnum=? ORDER BY ID ASC";
        $this->stmt=$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$jrfnum, PDO::PARAM_STR);
        $this->stmt->execute();
        
        $i = 0;
        if($this->stmt->rowCount()){
            while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
            $x = $i +1;

            echo "<input type=hidden  class=form-control name=id[$i] size=5 value=\"",$this->rows->ID,"\"><tr> <td class=viewtd style='color:black;'> <label>" , $x ,"</label></td>" ,
           "<td><input type=text  class=form-control name=strquantity[$i] size=5 value=\"",$this->rows->strquantity,"\"></td>
            <td><input type=text class=form-control name=strunit[$i] size=5 value=\"",$this->rows->strunit,"\"></td>
            <td><input type=text class=form-control name=stritmname[$i] value=\"",$this->rows->stritmname,"\"></td>
            <td><input type=text class=form-control name=stritmdesc[$i] value=\"",$this->rows->stritmdesc,"\"></td>
            <td align='center'><input type=checkbox name=delete[$i] title='Check if you want to delete'></td>
            </tr>";
            $i++;
            }//Switch
        }//EndIf
    }


    public function forviewPR($jrfnum){
        $this->sql="SELECT * FROM pr_tbl WHERE strjrfnum=? ORDER BY ID ASC";
        $this->stmt=$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$jrfnum, PDO::PARAM_STR);
        $this->stmt->execute();
        
        $i = 0;
        if($this->stmt->rowCount()==0){
            $this->div ="<hr style='margin-top:80px;margin-bottom:10px;border:0px none'>&nbsp;";
        }else{
            $this->div="";
            while($this->rows=$this->stmt->fetch(PDO::FETCH_OBJ)){
            $x = $i +1;

            echo "<tr> <td> <label>" , $x ,"</label></td>" ,
            "<td><span>",$this->rows->strquantity,"</span></td>
            <td><span>",$this->rows->strunit,"</span></td>
            <td><span>",$this->rows->stritmname,"</span></td>
            <td><span>",$this->rows->stritmdesc,"</span></td>
            </tr>";
            $i++;
            }//Switch
        }//EndIf
    }

    public function updatePR($strjrfnum,$ID,$strquantity,$stritmname,$strunit,$stritmdesc,$pr_remarks){
        $this->sql = 
        "UPDATE pr_tbl set 
        strquantity = ?,
        stritmname  =?,
        strunit = ?,
        stritmdesc =?
        WHERE strjrfnum =? AND ID=?";

        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$strquantity,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$stritmname,PDO::PARAM_STR);
        $this->stmt->bindParam(3,$strunit,PDO::PARAM_STR);
        $this->stmt->bindParam(4,$stritmdesc,PDO::PARAM_STR);
        $this->stmt->bindParam(5,$strjrfnum,PDO::PARAM_STR);
        $this->stmt->bindParam(6,$ID,PDO::PARAM_STR);
        $this->stmt->execute();

    }

    public function updatePRCostCenter($costcent,$strjrfnum){

        $this->sql = 
        "UPDATE pr_tbl set strcostcent = ? WHERE strjrfnum =?";

        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$costcent,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$strjrfnum,PDO::PARAM_STR);
        $this->stmt->execute();


    }


    public function deleteRequest($strjrfnum,$ID){ 
        $this->num=0;
        $this->sql=
        "DELETE FROM pr_tbl WHERE strjrfnum =? AND ID=?";
        
        $this->stmt = $this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$strjrfnum,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$ID,PDO::PARAM_STR);
        $this->stmt->execute();

    }
}//EndClass


class changePword{
    
    private $username,$old_pword,$new_pword,$update_pword;

    public function __construct(){
        $this->db = new connection();
        $this->db = $this->db->dbConnect();
    }

    public function get_pword($username,$old,$new,$fullname,$auth,$action){
        $this->username =$username; 
        $this->old_pword = $old;
        $this->new_pword = $new;
        $this->fullname =$fullname;
        $this->authorization =$auth;
        $this->action =$action;

    }

    public function checkPassword(){
        $this->sql = "SELECT * FROM login WHERE strusername=? AND strpassword =?";
        $this->stmt =$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$this->username,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$this->old_pword,PDO::PARAM_STR);
        $this->stmt->execute();

        if($this->stmt->rowCount()==1){
            $this->NewPassword();
            }else{
            //Wrong Password
           echo "<script type=text/javascript>alert('Invalid Password!');window.location.href='welcome.php';</script>";// echo "<script type=text/javascript>alert('Incorrect username or Password');window.location.href='welcome.php';</script>";
        }
    }    

    public function NewPassword(){

        $this->sql = "UPDATE login SET strpassword =? WHERE strusername=?";
        $this->stmt =$this->db->prepare($this->sql);
        $this->stmt->bindParam(1,$this->new_pword,PDO::PARAM_STR);
        $this->stmt->bindParam(2,$this->username,PDO::PARAM_STR);
        $this->stmt->execute();

        if($this->stmt->rowCount()==1){
            $this->addlogs = new logs();
            $this->addlogs->addLogs($this->fullname,$this->authorization,$this->action);
            echo  "<script type=text/javascript>alert('Password Successfully Updated');window.location.href='welcome.php';</script>";
        }
    }
}//End Class
