<div class="flex">
<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
if( mysqli_connect_errno() ) // если при подключении к серверу произошла ошибка
{
// выводим сообщение и принудительно останавливаем РНР-программу
echo 'Ошибка подключения к БД: '.mysqli_connect_error();
exit();
}
// если были переданы данные для изменения записи в таблице
if( isset($_POST['button']) && $_POST['button']== 'Изменить запись')
{
// формируем и выполняем SQL-запрос на изменение записи с указанным id
$sql_res=mysqli_query($mysqli, 'UPDATE friends SET name="'.
 htmlspecialchars($_POST['name']).'"
 WHERE id='.$_POST['id']);
echo '<div class = "ch">Данные изменены </div>'; // и выводим сообщение об изменении данных
$_GET['id']=$_POST['id']; // эмулируем переход по ссылке на изменяемую запись
}
// формируем и выполняем запрос для получения требуемых полей всех записей таблицы
$sql_res=mysqli_query($mysqli, 'SELECT * FROM friends');
if( !mysqli_errno($mysqli) ) // если запрос успешно выполнен
{
$currentROW=array(); // создаем массив для хранения текущей записи
echo '<div id="edit_links">';
while( $row=mysqli_fetch_assoc($sql_res) ) // перебираем все записи выборки
{
// если текущая запись пока не найдена и ее id не передан
// или передан и совпадает с проверяемой записью
if( !$currentROW &&
 (!isset($_GET['id']) || $_GET['id']==$row['id']) )
{
// значит в цикле сейчас текущая запись
$currentROW=$row;// сохраняем информацию о ней в массиве
echo '<div class="this" >'.$row['name'].'</div>'; // и выводим ее в списке
}
else // если проверяемая в цикле запись не текущая
// формируем ссылку на нее
echo '<a class="this" href="?p=edit&id='.$row['id'].'">'.$row['name'].'</a>';
}
echo '</div>';
// формируем HTML-код формы
if($currentROW)
echo '<form name="form_edit" method="post" action="?p=edit">
<input type="text" name="name" id="name" placeholder="Имя" value = "'.$currentROW['name'].'" required><br>
<input type="text" name="lastname" id="lastname" placeholder="Фамилия" value = "'.$currentROW['lastname'].'"required><br>
<input type="text" name="gender" id="gender" placeholder="Пол" value = "'.$currentROW['gender'].'"><br>
<input type="date" name="birth" id="birth" value = "'.$currentROW['birth'].'" required><br>
<input type="text" name="address" id="adress" placeholder="Адрес" value = "'.$currentROW['address'].'"><br>
<textarea name="comment" id="comment" placeholder="Комментарий" value = "'.$currentROW['comment'].'"></textarea><br>
<input type="text" name="mail" id="mail" placeholder="E-mail" value = "'.$currentROW['mail'].'"><br>
<input type="text" name="telephone" id="telephone" placeholder="Телефон" pattern= "^[ 0-9]+$" value = "'.$currentROW['telephone'].'" required><br>';


echo '<input type="submit" class = "button1" name="button" value="Изменить запись">
 <input type="hidden" name="id" value="';
if( $currentROW ) // если текущая запись определена
echo $currentROW['id']; // передаем ее id как POST параметр формы
echo '"></form>';
}
else // если запрос не может быть выполнен
echo 'Ошибка базы данных'; // выводим сообщение об ошиб

?>
</div>