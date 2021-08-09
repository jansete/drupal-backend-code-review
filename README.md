# Reto: Importación y visualización de una sección de noticias patrocinadas

Este repositorio contiene el código de un módulo de Drupal que se encarga de la importación y visualización de una sección de noticias patrocinadas. Tu objetivo será realizar un code review sobre el código contenido en el repositorio. Para ello, te proporcionamos la descripción de la tarea que habría recibido el equipo de desarrollo.

Los supuestos están basados en un hipotético *sistema de noticias patrocinadas*, que permite la importación de noticias a partir de diferentes proveedores y un listado donde se renderizan estos contenidos.

## Historias de usuario

* Yo, como encargado de la sección de noticias patrocinadas quiero tener un formulario en el que poder elegir un proveedor de noticias, adjuntar un fichero XML con el formato específico del proveedor y que me permita generar una noticia al enviarlo. Otras consideraciones:
  * Poder acceder a la administración a través de enlaces de menú.
  * Los ficheros XML de las noticias no deben ser accesibles por usuarios anónimos.
  * Tener un sistema escalable que permita nuevos proveedores.

* Yo, como usuario anónimo quiero poder acceder al listado de noticias patrocinadas a partir del path /sponsored-news. Otras consideraciones:
  * Las noticias deben estar ordenadas de más a menos recientes.
  * El listado debe mostrar siempre contenido actualizado sin dejar de lado el rendimiento de la página.

* Yo, como encargado de la sección de noticias patrocinadas quiero tener un enlace en listado que me permita volver de forma más rápida a la página de importación de noticias patrocinadas.

## Consideraciones importantes

Para simplificar este code review:
* Las noticias patrocinadas trabajarán con el tipo de contenido "article" que genera Drupal en su perfil de instalación standard.
* No hará falta que nos centremos en:
  * La maquetación y configuración de los nodos 'article' con view mode 'teaser'.
  * El procesado de los ficheros XML, para ello hemos añadido un trait que generará nodos a modo de mock.

Para nosotros, lo importante de este code review es entender como piensas. Queremos saber que consideras importante y que no, que crees que podría mejorarse y que crees que está bien como está.

Si tienes dudas entre comentar algo porque es algo que en un proyecto real no comentarías, hazlo. Sabemos que en este code review falta un montón de contexto sobre consensos que tendrías con tu equipo en una situación real, por lo que cualquier comentario nos va a servir mejor para entenderte.

No queremos que dediques tiempo a refactorizar el código, pero si hay algún comentario que quieres hacer y no sabes como explicarnos, nos puedes adjuntar código o pseudocódigo.

Para facilitar las cosas, cuando quieras referirte a alguna línea en concreto del código utiliza como nomenclatura algo parecido a NombreDelFichero#lineaDeCódigo o NombreDeClase#NombreDeMétodo.

## Criterios de aceptación

Debes entregarnos un fichero de texto con todos los comentarios que harías sobre el código del repositorio.
