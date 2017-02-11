<?php

include "conectSQL.php";

$table = $_POST['table'];


if (isset($_POST['id'])){

    $sql = "SELECT * FROM  ".$table." where id=".$_POST['id'];
    $stmt = $mysqli->stmt_init();
    if(($stmt->prepare($sql) === FALSE)
               // or ($stmt->bind_param('s', $table) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }

    $row = $result->fetch_assoc(); 

    if ($table == "workers"){

        echo 'Фамилия:<input type="text" name="fam" value='.$row['fam'].'><br>
        Имя:<input type="text" name="name" value='.$row['name'].'><br>
        Ник:<input type="text" name="nic" value='.$row['nic'].'><br>
        Телефон:<input type="text" name="tel" value='.$row['tel'].'><br>
        Эл.почта:<input type="text" name="mail" value='.$row['mail'].'><br> ';
    }
    if ($table == "objects"){

        echo 'Название:<input type="text" name="nameobg" value='.$row['name'].'><br>
        Адрес:<input type="text" name="adress" value='.$row['adress'].'><br>
        Начало:<input type="text" name="start" maxlength="10" value='.$row['start'].'><br>
        Конец:<input type="text" name="finish" maxlength="10" value='.$row['finish'].'><br>';

    }

}else{

    $sql = "SELECT * FROM  ".$table;
    $stmt = $mysqli->stmt_init();
    if(($stmt->prepare($sql) === FALSE)
               // or ($stmt->bind_param('s', $table) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }
    $field_cnt = $result->field_count;
    if($table=="workers") $table="Работники";
    echo "<h1>".$table."</h1>"; 
    echo "<button name='add' class='bd'>Добавить</button>";   
    echo "<table>";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        for($i=0; $i<$field_cnt; $i++){
            echo "<td>".$row[$i]."<td>";
        }
        echo "<td><button name='bbb' class='bd'  value='$row[0]'>изменить</button></td>";
        echo "<td><button name='ddd' class='bd'  value='$row[0]'>удалить</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}
$result->close();
$mysqli->close();  
?>