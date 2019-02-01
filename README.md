<h1>Реализация простейшего API для каталога товаров.</h1>
Приложение содержит:

Категории товаров
Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)
Пользователей, которые могут авторизоваться

Возможные действия:

Получение списка всех категорий
Получение списка товаров в конкретной категории
Авторизация пользователей
Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
Добавление/Редактирование/Удаление товара (для авторизованных пользователей)

Приложение написано на PHP.

Схема роутинга :
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
<td>/api/category?api_key=...</td> <td>Delete</td> <td>JSON</td> <td>{"id":"int"}</td> <td>delete category by id</td>
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
