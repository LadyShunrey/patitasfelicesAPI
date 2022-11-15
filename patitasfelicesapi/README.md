**API REST para el recurso de productos de** ***Patitas Felices***
Una API REST sencilla para manejar el CRUD de los productos

Pueba con postman
El endpoint de la API es: http://localhost/tucarpetalocal/patitasfelicesapi/api

**VERBOS**:
- GET
- POST
- PUT
- DELETE

**ENDPOINTS**:
/patitasfelicesapi/api/products         ((GET - PARA TRAER TODOS LOS PRODUCTOS))
/patitasfelicesapi/api/products/:ID     ((GET - PARA TRAER UN SOLO PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products         ((POST - PARA AÑADIR UN NUEVO PRODUCTO))
/patitasfelicesapi/api/products/:ID     ((PUT - PARA EDITAR UN PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products/:ID     ((DELETE - PARA BORRAR UN PRODUCTO POR ID))
/patitasfelicesapi/api/products?        ((GET - PARA AGREGAR PARAMETROS))

/patitasfelicesapi/api/users/token      ((GET - PARA GENERAR EL TOKEN))
/patitasfelicesapi/api/users/:ID        ((GET - PARA MOSTRAR UN USUARIO))

**ACLARACIONES SOBRE EL TOKEN**:
- Para realizar determinadas acciones como POST, PUT y DELETE es necesario contar con un token válido.
- El único id de usuario válido es el 1.

***SE AGREGAN DOS NUEVAS FUNCIONALIDADES RESPECTO AL SITIO ANTERIOR!!!!***
Nuevos campos en el producto:
- badge: *cucarda que indica cuando un producto tiene, por ejemplo, envio gratis*.
- on_sale: *distintivo que indica si un producto está en oferta*.

**PARAMETROS**:
/patitasfelicesapi/api/products?......
Después del signo de pregunta se pueden agregar varios parámetros para realizar distintas búsquedas u ordenamientos, se pueden agregar de a uno o de a varios, por ejemplo:

- Agregar el parámetro 'sort=' para elegir el campo que se desea ordenar.
  Nombres de campos aceptables:
  'name', 'description', 'color', 'size', 'price', 'stock', 'category_name' o 'type_name'.
  *ahora también se pueden agregar 'badge' y 'on_sale' !!!*

- El parámetro 'order=' para elegir si se quiere mostrar el resultado de forma ascendente o descendente.
  Ortografía aceptada para escribir el criterio de ordenamiento:
  'ASC', 'DESC', 'asc' o 'desc'.

- El parámetro 'limit=' para elegir la cantidad de respuestas a mostrar.
  Límites aceptados:
  '1', '2', '3', '4', '5', '10'.

- El parámetro 'offset' para elegir la cantidad de resultados a dejar afuera.
  Números de offset aceptados:
  '1', '2', '3', '4', '5', '10', '15' o '20'.

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

**EJEMPLOS**:

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((GET PARA TODOS LOS PRODUCTOS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/7   ((GET PARA UN SOLO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=price&order=asc   ((GET DE UN PRODUCTO ORDENADO SEGUN UN CAMPO Y UN CRITERIO DE ORDENAMIENTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?limit=3&offset=3  ((GET CON PAGINACIÓN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?category_name=Accesorios   ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESA CATEGORIA))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?type_name=Llaveros ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESE TIPO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?badge=true ((GET FILTRANDO TODOS LOS PRODUCTOS QUE TENGAN BADGE DE ENVIO GRATIS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?on_sale=true ((GET FILTRANDO TODOS LOS PRODUCTOS QUE ESTEN DE OFERTA))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((POST PARA CREAR UN NUEVO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/3   ((PUT PArA EDITAR UN PRODUCTO YA EXISTENTE))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/5   ((DELETE PARA ELIMINAR UN PRODUCTO))