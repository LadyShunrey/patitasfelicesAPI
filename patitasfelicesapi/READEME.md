El parámetro 'sort' para elegir el campo.
Nombres de campos aceptables:
'name', 'description', 'price'

El parámetro 'order' para elegir si se quiere el resultado ascendente o descendente
Ortografía aceptada para escribir el orden:
'ASC', 'DESC', 'asc', 'desc'.

El parámetro 'limit' para elegir la cantidad de respuestas a mostrar.
Límites aceptados:
'1', '2', '3', '4', '5', '10'.

El parámetro 'offset' para elegir la cantidad de resultados a dejar afuera.
Números de offset aceptados:



EJEMPLOS:

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((GET PARA TODOS LOS PRODUCTOS))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/7   ((GET PARA UN SOLO PRODUCTO))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=price&order=asc   ((GET CON UN CAMPO Y UN ORDEN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products?sort=name&order=desc&limit=5  ((GET CON PAGINACIÓN))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products   ((POST))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/3   ((PUT))

http://localhost/PatitasFelicesAPI/patitasfelicesapi/api/products/5   ((DELETE))