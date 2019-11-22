<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конников Матвей Аркадьевич группа 181-322 Лаб работа №А-5</title>
    <link rel="stylesheet" href="styles.css">
    <style>

     header, footer {
    background-color: #8FBC8F;
    color: black;
     }

     </style>
</head>

<body>
   <header>
      <img class="logo" src="img/polytech_logo.png" alt="логотип Московского Политеха">
    
       <?php 
    echo '<a href="?html_type=TABLE'; 
       
    if( isset($_GET['content']) ) 
        echo '&content='.$_GET['content']; 
    echo '"';
       
    if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'TABLE' ) 
        echo ' class="selected"'; 
       
    echo '>Табличная форма</a> <a href="?html_type=DIV';
       
    if( isset($_GET['content']) ) 
        echo '&content='.$_GET['content']; 
    echo '"';
       
    if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'DIV' ) 
        echo ' class="selected"';
    echo '>Блочная форма</a>';
    ?>
   </header>
   
   <main>

     <div id="product_menu">
     <?php 
     error_reporting (0);
         function outNumAsLink($x){
             if( $x<=9 ) 
                 return '<a href="?content='.$x.'&html_type='.$_GET['html_type'].'"> '.$x.'</a>'; 
             else 
                 return $x;
         }
         function outRow ( $n )  {  
             for($i=2; $i<=9; $i++) 
                 echo '<div class="cell">'.outNumAsLink($n).'&nbsp;&ensp;x&nbsp;&ensp;'.outNumAsLink($i).'&nbsp;&ensp;=&nbsp;&ensp;'.outNumAsLink($i*$n).'</div>'; 
         }
         function outRowTable ( $n )  { 
             for($i=2; $i<=9; $i++) 
                 echo '<tr><td >'.outNumAsLink($n).'&nbsp;&ensp;x&nbsp;&ensp;'.outNumAsLink($i).'&nbsp;&ensp;=&nbsp;&ensp;'.outNumAsLink($i*$n).'</td><tr>'; 
         }
         
         function outTableForm() { 
             if( !isset($_GET['content']) )  { 
                 for($i=2; $i<10; $i++) { 
                     echo '<table>';
                     outRowTable( $i );  
                     echo '</table>';
                 }
             } 
             else { 
                 echo '<table class="ttSingleRow">';
                 outRowTable( $_GET['content'] ); 
                 echo '</table>';
             }   
         } 
 
         function outDivForm () { 
             if( !isset($_GET['content']) )  { 
                 for($i=2; $i<10; $i++) { 
                     echo '<div class="ttRow">'; 
                     outRow( $i );       
                     echo '</div>'; 
                 } 
             } 
             else { 
                 echo '<div class="ttSingleRow">'; 
                 outRow( $_GET['content'] ); 
                 echo '</div>';
             }
         }
            
 
         echo '<div class="th"><a href="
         ?html_type='.$_GET['html_type'].'"'; 
         if( !isset($_GET['content']) ) 
             echo 'class="selected"'; 
         echo '>Вся таблица умножения</a>';
            for( $i=2; $i<=9; $i++ ){ 
                echo '<a href="?content='.$i.'&html_type='.$_GET['html_type'].'"'; 
                if( isset($_GET['content']) && $_GET['content']==$i ) 
                    echo ' class="selected"'; 
                echo '>Таблица умножения на '.$i.'</a>'; 
                } 
         echo '</div>';
         
         if (isset($_GET['html_type']) && $_GET['html_type']== 'TABLE' ) 
             outTableForm();  
         else 
             outDivForm();
         
         ?>
        </div>  
   </main>
   
   <footer>
       <?php 
       if( isset($_GET['html_type']) && $_GET['html_type']== 'TABLE' )  
           $s='Табличная верстка. ';  
       else  
           $s='Блочная верстка. ';  
 
       if( !isset($_GET['content']) )  
           $s.='Таблица умножения полностью. ';  
       else  
           $s.='Столбец таблицы умножения на '.$_GET['content']. '.  ';  
 
       echo $s.date('d.Y.M h:i:s');
       
       ?>
   </footer>
   
</body>
</html>