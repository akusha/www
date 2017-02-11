<!DOCTYPE html>
<html>
    <head>
        <title>Личный кабинет</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">
        <link rel="stylesheet" href="index.css">        
    </head>
    <body>

        <div class="forms invisible" id="form_workers">

        

            <form method="post">
                    Данные работника<br>
                <div id="datadiv">
                    Фамилия:<input type="text" name="fam"><br>
                    Имя:<input type="text" name="name"><br>
                    Ник:<input type="text" name="nic"><br>
                    Телефон:<input type="text" name="tel"><br>
                    Эл.почта:<input type="text" name="mail"><br>
                </div>
                    <input type="hidden" name="id">
                    <input type="button" value="сохранить" id="submit">
                    <input type="button" value="изменить" id="update" class="invisible">
                    <input type="button" value="закрыть" id="close_wokers"><br>
                    <p id="res"></p>
                    
            </form>
        </div>
        <div class="forms invisible" id="form_obgects">
            <form method="post">
                    Данные объекта<br>
                <div id="datadiv_obgects">

                    Название: <input type="text" name="nameobg"><br>                             

                    Адрес: <input type="text" name="adress"><br>
                    Начало:<input type="text" name="start" maxlength="10"><br>
                    Конец: <input type="text" name="finish" maxlength="10"><br> 

                </div>
                    <input type="hidden" name="id_obg">
                    <input type="button" value="сохранить" id="submit_obg">
                    <input type="button" value="изменить" id="update_obg" class="invisible">
                    <input type="button" value="закрыть" id="close_obgeсts"><br>
                    <p id="res_obg"></p>                    
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

                        <li id="jobs">другое</li>

       

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