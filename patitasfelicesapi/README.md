# **API REST para el recurso de productos de** ***Patitas Felices***

Una API REST sencilla para manejar el CRUD de los productos

Pueba con postman
El endpoint de la API es: http://localhost/tucarpetalocal/patitasfelicesapi/api


## **VERBOS**:
- GET
- POST
- PUT
- DELETE


## **ENDPOINTS**:

```
/patitasfelicesapi/api/products         ((GET - PARA TRAER TODOS LOS PRODUCTOS))
/patitasfelicesapi/api/products/:ID     ((GET - PARA TRAER UN SOLO PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products         ((POST - PARA AÑADIR UN NUEVO PRODUCTO))
/patitasfelicesapi/api/products/:ID     ((PUT - PARA EDITAR UN PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products/:ID     ((DELETE - PARA BORRAR UN PRODUCTO POR ID))
/patitasfelicesapi/api/products?        ((GET - PARA AGREGAR PARAMETROS))

/patitasfelicesapi/api/users/token      ((GET - PARA GENERAR EL TOKEN))
/patitasfelicesapi/api/users/:ID        ((GET - PARA MOSTRAR UN USUARIO))
```


## **ACLARACIONES SOBRE EL TOKEN**:

- Para realizar determinadas acciones como POST, PUT y DELETE es necesario contar con un token válido.
- El único id de usuario válido es el 1.

***SE AGREGAN DOS NUEVAS FUNCIONALIDADES RESPECTO AL SITIO ANTERIOR!!!!***

Nuevos campos en el producto:
- badge: *cucarda que indica cuando un producto tiene, por ejemplo, envio gratis*.
- on_sale: *distintivo que indica si un producto está en oferta*.


## **SOBRE LOS PARAMETROS**:

/patitasfelicesapi/api/products?......

Después del signo de pregunta se pueden agregar varios parámetros para realizar distintas búsquedas u ordenamientos, se pueden agregar de a uno o de a varios, por ejemplo:

- Agregar el parámetro 'sort=' para elegir el campo que se desea ordenar.
  Nombres de campos aceptables:
  'name', 'description', 'color', 'size', 'price', 'stock', 'category_name' o 'type_name'.
  
  *ahora también se pueden agregar 'badge' y 'on_sale' !!!*

- El parámetro 'order=' para elegir si se quiere mostrar el resultado de forma ascendente o descendente.
  Ortografía aceptada para escribir el criterio de ordenamiento:
  'ASC', 'DESC', 'asc' o 'desc'.

- El parámetro 'limit=' para elegir la cantidad de respuestas a mostrar. Acepta cualquier número entero mayor a cero.

- El parámetro 'offset' para elegir la cantidad de resultados a dejar afuera. Acepta cualquier número entero mayor a cero.

También se pueden agregar parámetros con el nombre de una categoria o de un tipo de productos para poder filtrar los resultados, por ejemplo:

- Agregar el parámetro "category_name=" seguido de la categoria por la cual desea filtrar.
  Nombres de categorías aceptadas:
  "Accesorios", "Libreria", "Bazar" o "Indumentaria".

- Agregar el parámetro "type_name=" seguido del tipo de producto por el cual desea filtrar.
  Nombres de tipos aceptados:
  "Bandanas", "Cartucheras", "Llaveros", "Anotadores", "Calendarios", "Cuadernos", "Lapices", "Lapiceras", "Bolsos", "Tazas", "Remeras", "Billeteras" o "Buzos".

- Agregar el parámetro "badge=" seguido del estado por el cual desea filtrar.
  Tipos de estados aceptados:
  "true" o "false".

- Agregar el parámetro "on_sale=" seguido del estado por el cual desea filtrar.
  Tipos de estados aceptados:
  "true" o "false".


## **SOBRE EL POST Y EL PUT**
Para poder agregar o editar un producto se usa un JSON como el siguiente:
```
{
    "name": "Nombre del Producto",
    "description": "Descripción del producto",
    "color": "Color del producto",
    "size": "Tamaño del producto",
    "price": "Precio con coma",
    "stock": "Cantidad en stock",
    "badge": "Si cuenta o no con una cucarda",
    "on_sale": "Si está o no en oferta",
    "category_fk": "Número de categoría",
    "type_fk": "Número de tipo de producto"
}
```
- En el caso de los campos "badge" y "on_sale" las opciones son: 0 (false), o 1 (true).
- En el caso del precio debe ser un número con coma (1200,0) porque es un double y sin el signo pesos ($).
- En el caso del número de categoría las opciones son:
    1 - Accesorios
    2 - Libreria
    3 - Bazar
    4 - Indumentaria
- En el caso del número de tipo de producto las opciones son:
    1 - Bandanas
    2 - Cartucheras
    3 - Llaveros
    4 - Anotadores
    5 - Calendarios
    6 - Cuadernos
    7 - Lapices
    8 - Lapiceras
    9 - Bolsos
    10 - Tazas
    11 - Remeras
    12 - Billeteras
    13 - Buzos
    14 - Mates
- En el caso de los campos "stock", "category_fk" y "type_fk" los mismos deben ser completados con números enteros, a diferencia de los campos "badge" y "on_sale" que solamente pueden adoptar los valores 0 o 1, y del campo "price" que es un double.

*Algunos campos se permite que puedan permanecer vacíos y otros no*
- En el caso del **PUT** los campos obligatorios son: "name", "stock", "category_fk" y "type_fk". El resto puede permanecer vacío.
- En el caso del **POST** los campos obligatorios son: "name", "description", "color", "size", "price", "stock", "on_sale", "category_fk" y "type_fk". El resto puede permanecer vacío.


## **EJEMPLO DEL JSON PARA PUT/POST**
```
{
    "name": "Gorra P4P",
    "description": "Gorra tipo trucker. Tené tu gorra de Proyecto 4 Patas!",
    "color": "Rojo, Azul, Verde",
    "size": "Talle M",
    "price": "1500.0",
    "stock": "200",
    "badge": "0",
    "on_sale": "1",
    "category_fk": "1",
    "type_fk": "1"
}
```


## **EJEMPLOS DE ENDPOINTS PARA LOS PRODUCTOS**:

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((GET PARA TODOS LOS PRODUCTOS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/7   ((GET PARA UN SOLO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=price&order=asc   ((GET DE UN PRODUCTO ORDENADO SEGUN UN CAMPO Y UN CRITERIO DE ORDENAMIENTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?limit=3&offset=3  ((GET CON PAGINACIÓN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?category_name=Accesorios   ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESA CATEGORIA))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?type_name=Llaveros ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESE TIPO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?badge=true ((GET FILTRANDO TODOS LOS PRODUCTOS QUE TENGAN BADGE DE ENVIO GRATIS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?on_sale=true ((GET FILTRANDO TODOS LOS PRODUCTOS QUE ESTEN DE OFERTA))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=price&order=asc&on_sale=true&limit=5&offset=5 ((GET FILTRANDO CON TODOS LOS PARÁMETROS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((POST PARA CREAR UN NUEVO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/3   ((PUT PARA EDITAR UN PRODUCTO YA EXISTENTE))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/5   ((DELETE PARA ELIMINAR UN PRODUCTO))



## **EJEMPLOS DE ENDPOINTS PARA LOS USERS**:

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/users/token   ((GET PARA PEDIR UN TOKEN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/users/1   ((GET PARA MOSTRAR UN USER VÁLIDO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/users/2   ((GET PARA UN USER NO VÁLIDO))
