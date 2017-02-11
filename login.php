<?php    
if (isset($_COOKIE['log'])){
    
      header("Location: cabinet.php");
      exit;
    
}
  

    if (isset($_POST['log'])){
            $log = $_POST["log"];


            $pass = $_POST["pass"];
        
            include "conectSQL.php";
        
      

            $stmt = $mysqli->stmt_init();
            if(($stmt->prepare("SELECT * FROM users WHERE log=? AND pass=?") === FALSE)
                or ($stmt->bind_param('ss', $log, $pass) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                                                }
            if($result->num_rows==0) echo "Пароль неверный.";
            else {
                    $row = $result->fetch_assoc();                   
                    setcookie("log", $row["log"]);
                    header("Location: cabinet.php");
                    exit;
            }            
            $result->close();
            $mysqli->close();
    }
        
           
        ?>    
<!DOCTYPE html>
<html>
    <head>
        <title>вход</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">    
        <script src="jquery-3.1.1.js"></script>
        <style> 
            body{
                background: #b7b2b2;
                
            }
            .view {
                    padding: 5px;
                    width: 250px;                    
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin: -50px 0 0 -125px;                    
                    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.25), 7px 7px 5px rgba(0, 0, 0, 0.22);
                    background: #453e3e;
                text-align: center;
            }
            fieldset{
                align-content: space-around;
            }
            legend {
                text-align: left;
            }
            input[type="text"] {
                
            }
            input {
                background: #a1c7a1;
                border: 1px solid #616184;
            }
            label {
                width: 110px;
                display: inline-block;
                vertical-align: top;
                margin: 6px;
            }
            input:focus {
                background: #98ed8d;
                border: 1px solid #18671b;
            }
            input:required:invalid {
	           border:1px solid red;
            }
            ::-webkit-input-placeholder {color:#ac6c65;}
            ::-moz-placeholder          {color:#ac6c65;}/* Firefox 19+ */
            :-moz-placeholder           {color:#ac6c65;}/* Firefox 18- */
            :-ms-input-placeholder      {color:#ac6c65;}
        </style>
    </head>
    <body>
        <div class="view">
            <form method="post">
                <fieldset>
                    <legend>вход</legend>
                    <label for="log">логин:</label><input type="text" name="log" placeholder="akusha@mail.ru" required autofocus>
                    <label for="pass">пароль:</label><input type="password" name="pass" required>
                </fieldset>    
                    <input type="submit" value="войти">
            </form>
        </div>
    </body>
</html>
