<!DOCTYPE html>
<html>
    <head>
        <title>Личный кабинет</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">
        <link rel="stylesheet" href="index.css">        
    </head>
    <body>
        <div class="forms invisible" id="formdiv">
            <form method="post">
                    Данные работника<br>
                <div id="datadiv">
                    Фамилия:<input type="text" name="fam" value="бармалей"><br>
                    Имя:<input type="text" name="name"><br>
                    Ник:<input type="text" name="nic"><br>
                    Телефон:<input type="text" name="tel"><br>
                    Эл.почта:<input type="text" name="mail"><br>
                </div>
                    <input type="hidden" name="id">
                    <input type="button" value="сохранить" id="submit">
                    <input type="button" value="изменить" id="update" class="invisible">
                    <input type="button" value="закрыть" id="closewokers"><br>
                    <p id="res"></p>
                    
            </form>
        </div>
        <header class="header">
            <a href="http://localhost"><img src="image/logo_100_100.png" class="logo"/></a>            
		<nav>
            <ul class = "topmenu">
                <li>показать 
                    <ul id="tables" class = "submenu">
                        <li id="workers">работники</li>
                        <li id="objects">объекты</li>
                        <li id="rab">другое</li>
                    </ul>
                </li>
                <li><a href="https://ok.ru">odnok</a></li>
            </ul>
        </nav>
        </header>
        <div class='login'><a href='cabinet.php'><?php echo $_COOKIE['log'];  ?></a>/
                <a href="index.php" id="a"> выход </a>
        </div>; 
        <div class="container">
            <div class="leftcol">
                
            </div>
            <div class="rightcol" id="table"> 
                
            </div>
        </div>
        <footer>
        <div>
            <a href="mailto:akusha260@gmail.com?subject=вопрос к администратору">&#9993 вопрос к админ.</a>
            Магомедов Магомед Кадиевич.
        </div>
        </footer>
       <script src="cabinet.js"/></script>
    </body>
</html>