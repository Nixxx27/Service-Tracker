<?php
class connection{
    public function dbConnect(){
        //return new PDO("mysql:host=localhost; dbname=oop", "root", "nikkoz06");
        try {
            return $handler = new PDO ('mysql:host=127.0.0.1;dbname=sts','root','nikkoz06');
            $handler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();//die('Sorry Database Problem.');
            }
    }
}//EndClass
