<?php

include "conectSQL.php";

$form = $_POST['form'];

$fam = $_POST["fam"];
$name = $_POST["name"];
$nic = $_POST["nic"];
$tel = $_POST["tel"];            
$mail = $_POST["mail"];  

$nameobg = $_POST["nameobg"];  
$adress = $_POST["adress"];  
$start = $_POST["start"];  
$finish = $_POST["finish"]; 

if (!isset($_POST['id'])){ 

    $stmt = $mysqli->stmt_init(); 

    if ($form == "workers"){
          
        if(($stmt->prepare("INSERT INTO workers (fam,name,nic,tel,mail) VALUES (?,?,?,?,?)") === FALSE) 
            or ($stmt->bind_param('sssss', $fam, $name,$nic,$tel,$mail) === FALSE)
            or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
        else echo "Сохранено.";
    }

    if ($form == "objects"){
          
        if(($stmt->prepare("INSERT INTO objects (name,adress,start,finish) VALUES (?,?,?,?)") === FALSE) 
            or ($stmt->bind_param('ssss',$nameobg,$adress,$start,$finish) === FALSE)
            or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
        else echo "Сохранено.";
    }



}else{

    $id = $_POST['id'];
    $stmt = $mysqli->stmt_init();

    if (isset($_POST['del'])){

        $table = $_POST['table'];

        echo  "table = ".$table;

        $sql = "DELETE FROM ".$table." WHERE id=".$id;

         if(($stmt->prepare($sql) === FALSE) 
            //or ($stmt->bind_param('s',$id) === FALSE)
            or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }
    else echo "Удалено.";    

    }else{
            if ($form == "workers"){

                if(($stmt->prepare("UPDATE  workers set fam=? ,name=? , nic=? , tel=? , mail=? WHERE id=? ") === FALSE) 
                    or ($stmt->bind_param('sssssi', $fam, $name,$nic,$tel,$mail,$id) === FALSE)
                    or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                    or ($stmt->close() === FALSE)) {
                    die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                }
                else echo "Изменено."; 
            }

            if ($form == "objects"){

                if(($stmt->prepare("UPDATE  objects set name=? , adress=? , start=? , finish=? WHERE id=? ") === FALSE) 
                    or ($stmt->bind_param('ssssi', $nameobg,$adress,$start,$finish,$id) === FALSE)
                    or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                    or ($stmt->close() === FALSE)) {
                    die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                }
                else echo "Изменено."; 
            }

    } 


}


?>