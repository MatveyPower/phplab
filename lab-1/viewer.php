<div id = "viewer">
    <?php 
        function getFriendsList($type, $page)
        {
        $mysqli = mysqli_connect('localhost', 'root', '', 'friends');
        if( mysqli_connect_errno() ) 
        return 'Ошибка подключения к БД: '.mysqli_connect_error();

        $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM friends');

        if( !mysqli_errno($mysqli) && $row=mysqli_fetch_assoc($sql_res) ){
        $TOTAL = $row['COUNT(*)'];

        if($TOTAL == 0)
        return 'В таблице нет данных'; 
        
        $PAGES = ceil($TOTAL/10); 

        if( $page>=$TOTAL ) 
        $page=$TOTAL-1; 
      
        $sql='SELECT * FROM friends LIMIT '.($page * 10).', 10';
        if ($_GET['sort']=='fam'){
            $sql='SELECT * FROM friends ORDER BY lastname LIMIT '.($page * 10).', 10';
        }
        if ($_GET['sort']=='birth'){
            $sql='SELECT * FROM friends ORDER BY birth LIMIT '.($page * 10).', 10';
        }
        $sql_res=mysqli_query($mysqli, $sql);

        $ret='<table>'; 
       $ret.=' <tr><th>Имя</th>
        <th>Фамилия</th>
        <th>Дата рождения</th>
        <th>Телефон</th></tr>';
        while( $row=mysqli_fetch_assoc($sql_res) ) 
        {
        $ret.='<tr><td>'.$row['name'].'</td>
        <td>'.$row['lastname'].'</td>
        <td>'.$row['birth'].'</td>
         <td>'.$row['telephone'].'</td></tr>';
        }

        $ret.='</table>'; 

        if( $PAGES>1 ) 
        {
        $ret.='<div id="pages">'; 

        for($i=0; $i<$PAGES; $i++) 

        if( $i != $page ) 
        $ret.='<a href="?p=viewer&pg='.$i.'">'.($i+1).'</a>';

        else 
        $ret.='<span>'.($i+1).'</span>';
        $ret.='</div>'
        ;
        }
        return $ret; 
        }
        
        return 'Неизвестная ошибка'; 
        }
    ?>
</div>