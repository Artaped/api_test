<h1>Реализация простейшего API для каталога товаров.</h1>
Приложение содержит:
<ul>
<li>Категории товаров</li>
<li>Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)</li>
<li>Пользователей, которые могут авторизоваться</li>
</ul>
Возможные действия:
<ul>
<li>Получение списка всех категорий</li>
<li>Получение списка товаров в конкретной категории</li>
<li>Авторизация пользователей</li>
<li>Добавление/Редактирование/Удаление категории (для авторизованных пользователей)</li>
<li>Добавление/Редактирование/Удаление товара (для авторизованных пользователей)</li>
</ul> 
Приложение написано на PHP.

Схема роутинга :<br>
User
<table>
 <tr>
<th>Route</th> <th>Method</th><th>Type</th><th>Posted JSON</th><th>Description</th>
 </tr>
<tr>
<td>/api/registration</td> <td>POST</td> <td>JSON</td> <td>{"login":"string","password":"string","email":"email"}</td> <td>registration user and get api_key on user email</td>
<tr>
 </table>
 Category
 <table>
 <tr>
<th>Route</th> <th>Method</th><th>Type</th><th>Posted JSON</th><th>Description</th>
 </tr>
<td>/api/category</td> <td>GET</td> <td>JSON</td> <td>-</td> <td>get category list</td>
<tr>
<tr>
<td>/api/category?api_key=....</td> <td>POST</td> <td>JSON</td> <td>{"title":"string"}              </td> <td>add new category</td>
<tr>
<tr>
<td>/api/category?api_key=...</td> <td>PUT</td> <td>JSON</td> <td>{"title":"string","id":"int"}</td> <td>change category by id</td>
<tr>
<tr>
<td>/api/category?api_key=...</td> <td>DELETE</td> <td>JSON</td> <td>{"id":"int"}</td> <td>delete category by id</td>
<tr>  
</table>
Product
<table>
 <tr>
<th>Route</th> <th>Method</th><th>Type</th><th>Posted JSON</th><th>Description</th>
 </tr>
<tr>
<td>/api/product</td> <td>GET</td> <td>JSON</td> <td>-</td> <td>get product list</td>
</tr>
<tr>
<td>/api/product/{id}</td> <td>GET</td> <td>JSON</td> <td>-</td> <td>get product by id</td>
</tr>
<tr>
<td>/api/product/{id}/category</td> <td>GET</td> <td>JSON</td> <td>-</td> <td>get all product in category by category id</td>
</tr>  
<tr>
<td>/api/product?api_key=....</td> <td>POST</td> <td>JSON</td> <td>{"name":"string"}</td> <td>add new product</td>
</tr> 
 <tr>
<td>/api/product?api_key=....</td> <td>PUT</td> <td>JSON</td> <td>{"name":"string",	"id":"int",	"category_id":["array"]}</td> <td>change product</td>
</tr>
<tr>
<td>/api/product?api_key=....</td> <td>DELETE</td> <td>JSON</td> <td>{"id":"int"}</td> <td>delete product</td>
</tr>  
</table> 
Зависимости:<br>
PHP 7.2 ; MySQL 5.7<br><br>
<ol>
<li>Клонируем или скачиваем поект используя composer.</li>
<li>В папке src/components/QueryBuilder.php прописываем свои данные для подключения к Базе Данных .</li>
<li>Запускаем локальный сервер и экспортируем Базу Данных из папки DB в корне проекта.</li>
<li>Все.</li>
</ol> 
Подключение к базе данных выбрал оптимальное =)<br>
Для недовольных - я знаю что такое https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
