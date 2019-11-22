<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styled3.css">
</head>
<body>
<header>
    <?php require 'menu.php'; 
    ?>
</header>
<main>
    <div class="centr">
        <?php
        if( $_GET['p'] == 'viewer' ) 
        {
        include 'viewer.php'; 
        if( !isset($_GET['pg']) || $_GET['pg']<0 ) $_GET['pg']=0;
        
        if(!isset($_GET['sort']) || ($_GET['sort']!='byid' && $_GET['sort']!='fam' &&
         $_GET['sort']!='birth'))
        $_GET['sort']='byid'; 
        
        
        echo getFriendsList($_GET['sort'], $_GET['pg']);
        }
        else 
        if( file_exists($_GET['p'].'.php') ) { include $_GET['p'].'.php'; }  
        ?>
</div>
</main>  
</body>
</html>