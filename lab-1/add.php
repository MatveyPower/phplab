<form name="form_add" method="post" action="?p=add">
<label for="name">Имя:</label><input type="text" name="name" id="name" placeholder="Имя" required><br>
<label for="lastname">Фамилия:</label><input type="text" name="lastname" id="lastname" placeholder="Фамилия" required><br>
<label for="gender">Пол:</label><input type="text" name="gender" id="gender" placeholder="Пол"><br>
<label for="birth">Дата рождения:</label><input type="date" name="birth" id="birth" required><br>
<label for="address">Адрес:</label><input type="text" name="address" id="adress" placeholder="Адрес"><br>

<label for="comment">комментарий</label><textarea name="comment" id="comment" placeholder="Комментарий"></textarea><br>
<label for="mail">E-mail:</label><input type="text" name="mail" id="mail" placeholder="E-mail"><br>
<label for="telephone">Телефон:</label><input type="text" name="telephone" id="telephone" placeholder="Телефон" pattern= "^[ 0-9]+$" required><br>
<input type="submit" class = "button" name="button" value="Добавить запись">
</form><?php
// если были переданы данные для добавления в БД
if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')
{
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
if( mysqli_connect_errno() ) // проверяем корректность подключения
echo 'Ошибка подключения к БД: '.mysqli_connect_error();
// формируем и выполняем SQL-запрос для добавления записи
$sql_res=mysqli_query($mysqli, 'INSERT INTO friends(`name`,
`lastname`,
`gender`,
`birth`,
`address`,
`comment`,
`mail`,
`telephone`) VALUES ("'.
htmlspecialchars($_POST['name']).'", "'.
htmlspecialchars($_POST['lastname']).'", "'.
htmlspecialchars($_POST['gender']).'", "'.
htmlspecialchars($_POST['birth']).'", "'.
htmlspecialchars($_POST['address']).'", "'.
htmlspecialchars($_POST['comment']).'", "'.
$_POST['mail'].'", "'.
$_POST['telephone'].'")');
// если при выполнении запроса произошла ошибка – выводим сообщение
if( mysqli_errno($mysqli) )
echo '<div class="error">Запись не добавлена</div>';
else // если все прошло нормально – выводим сообщение
echo '<div class="ch">Запись добавлена</div>';
}
?>
