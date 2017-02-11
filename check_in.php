<?php  

if (isset($_COOKIE['log'])){
    
      header("Location: cabinet.php");
      exit;
    
}

    include "conectSQL.php";

    if(isset($_POST['ajax'])){
        
        $log = $_POST['log'];
        
         $stmt = $mysqli->stmt_init();
            if(($stmt->prepare("SELECT * FROM users WHERE log=?") === FALSE)
                or ($stmt->bind_param('s', $log) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                                                }
            if($result->num_rows==0) echo "0";
            else echo "1";
            $result->close();
            $mysqli->close();  
        exit;
        
    }

    if (isset($_POST["log"])){
        
            $log = $_POST["log"];
            $pass = $_POST["pass"];
            $nic = $_POST["nic"];
            $mail = $_POST["mail"];            
            $stmt = $mysqli->stmt_init();       
            if(($stmt->prepare("INSERT INTO users (log,pass,nic,mail) VALUES (?,?,?,?)") === FALSE) 
                or ($stmt->bind_param('ssss', $log, $pass,$nic,$mail) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
            else{
                setcookie("log", $log);
                    header("Location: cabinet.php");
                    exit;
            }
            $mysqli->close();
    }
           
        ?>    

<!DOCTYPE html>
<html>
    <head>
        <title>регистрация</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">    
        <style> 
            body{
                background: #b7b2b2;
                
            }
            .view {
                    padding: px;
                    width: 250px;
                    height: 300px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin: -150px 0 0 -125px;                    
                    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.25), 7px 7px 5px rgba(0, 0, 0, 0.22);
                    background: #453e3e;
                text-align: center;
            }
            fieldset{
                align-content: space-around;
            }
            legend {
                text-align: left;
                padding: 0px 3px;
                font-weight: bold;
                font-variant: small-caps;
            }            
            .invisible {
                visibility: hidden;
            }
            label {
                width: 110px;
                display: inline-block;
                vertical-align: top;
                margin: 6px;
            }
            input:focus {
            background: #98ed8d;
            }
            input:required:invalid {
	           border:1px solid red;
            }
        </style>
    </head>
    <body>
        <div class="view">
            <form method="post">
                <fieldset>
                    <legend>регистрация</legend>
                    <label>nic:</label><input type="text" name="nic" placeholder="dodik" autofocus><br>
                    <label>логин:</label><input type="text" name="log" id="log" value="" placeholder="akusha@mail.ru" required><br>
                    <label>пароль:</label><input type="password" name="pass" required><br>
                    <label>Почта:</label><input type="email" name="mail" placeholder="akusha@mail.ru"><br>
                </fieldset>
                    <input type="submit" value="войти" id="submit" class="invisible">
            </form>
        </div>
        
<script>
    
    function getXmlHttp(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
    }
    
	var ajax = getXmlHttp();
    
    var submit = document.getElementById("submit");
    
	
	document.getElementById("log").oninput = change;
        
        function change(event){
        
        var value = this.value;
            
        var body = "ajax=ajax&log=" + value;
        
        sendData(body);        
        
    };
    
    
    function sendData(body){    	
		ajax.open('POST', "check_in.php", true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if(ajax.status == 200) {
					                    
					var result = ajax.responseText;
                    
                    if (result==0)                         
                        submit.classList.remove("invisible");
                    else
                        submit.classList.add("invisible");
					
				}
			}
		}
		ajax.send(body);
	}

    
        
</script>
        
        
        
    </body>
</html>
