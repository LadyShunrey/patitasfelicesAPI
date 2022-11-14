API REST para el recurso de productos de Patitas Felices
Una API REST sencilla para manejar el CRUD de los productos

Pueba con postman
El endpoint de la API es: http://localhost/tucarpetalocal/patitasfelicesapi/api

VERBOS:
- GET
- POST
- PUT
- DELETE

ENDPOINTS:
/patitasfelicesapi/api/products         ((GET PARA TRAER TODOS LOS PRODUCTOS))
/patitasfelicesapi/api/products/:ID     ((GET PARA TRAER UN SOLO PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products         ((POST))
/patitasfelicesapi/api/products/:ID     ((PUT PARA EDITAR UN PRODUCTO SEGUN SU ID))
/patitasfelicesapi/api/products/:ID     ((DELETE PARA BORRAR UN PRODUCTO POR ID))
/patitasfelicesapi/api/products?        ((PARA AGREGAR PARAMETROS))

PARAMETROS:
/patitasfelicesapi/api/products?......
Después del signo de pregunta se pueden agregar varios parámetros para realizar distintas búsquedas u ordenamientos, por ejemplo:

- Agregar el parámetro 'sort=' para elegir el campo que se desea ordenar.
  Nombres de campos aceptables:
  'name', 'description', 'color', 'size', 'price', 'stock', 'category_name' o 'type_name'.

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
  "Accesorios", "Libreria" o "Bazar".

- Agregar el parámetro "type_name=" seguido del tipo de producto por el cual desea filtrar.
  Nombres de tipos aceptados:
  "Bandanas", "Llaveros" o "Tazas".


EJEMPLOS:

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((GET PARA TODOS LOS PRODUCTOS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/7   ((GET PARA UN SOLO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=price&order=asc   ((GET DE UN PRODUCTO ORDENADO SEGUN UN CAMPO Y UN CRITERIO DE ORDENAMIENTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?limit=3&offset=3  ((GET CON PAGINACIÓN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?category_name=Accesorios   ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESA CATEGORIA))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?type_name=Llaveros ((GET FILTRANDO TODOS LOS PRODUCTOS QUE SEAN DE ESE TIPO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((POST PARA CREAR UN NUEVO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/3   ((PUT PArA EDITAR UN PRODUCTO YA EXISTENTE))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/5   ((DELETE PARA ELIMINAR UN PRODUCTO))