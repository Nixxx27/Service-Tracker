<?php
$myusername=trim($_POST['strusername']); 
    $mypassword=trim($_POST['strpassword']);
    $myusername =escape($myusername);
    $mypassword=escape($mypassword);

    
require 'dbc.php';
$sql = "SELECT * FROM login WHERE strusername=? AND strpassword=?";
if ($stmt = $db->prepare($sql)) { 
    
    $stmt->bind_param('ss',$myusername,$mypassword);
    $stmt->execute(); 

    $meta = $stmt->result_metadata(); 
    while ($field = $meta->fetch_field()) 
    { 
        $params[] = &$row[$field->strusername]; 
    } 

    call_user_func_array(array($stmt, 'bind_result'), $params); 

    while ($stmt->fetch()) { 
        foreach($row as $key => $val) 
        { 
            $c[$key] = $val; 
        } 
        $result[] = $c; 
    } 
    
    $stmt->close(); 
} 
$mysqli->close(); 
print_r($result); 