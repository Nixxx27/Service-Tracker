<?php
include 'dbc.php';
include 'security.php';

class User{

    private $user;
    private $pword;

    public function __construct($strusername,$strpassword){
        $this->user=$strusername;
        $this->pword=$strpassword;
    }

    public function UserAccess(){
        $sql ="SELECT
        strfullname,
        strusername,
        strpassword,
        strcompany,
        strdept,
        strloc,
        strposition,
        strauthorization,
        stremailadd,
        strcostcent,
        strtelephone
        FROM login
        WHERE strusername =? AND strpassword =?";

    $stmt  = $db->prepare($sql);
    $stmt->bind_param('ss', $this->user,$this->pword);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result(
        $fullname,
        $username,
        $password,
        $company,
        $dept,
        $loc,
        $position,
        $authorization,
        $emailadd,
        $costcent,
        $telephone
    );
    $stmt->fetch();

    if ($stmt->num_rows == 1) {
            return "$fullname $username";

            
     }else
     {
        echo "<script type=text/javascript>alert('Invalid Username or Password, $myusername!');window.location.href='index.php';</script>";
     }

    }




}