<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://statics.kreditiweb.com/img/logos/iahorro-logo.png" width="400"></a></p>

# Code Challenge iAhorro
Encuentra el codigo resultado de la prueba

## Instalación :wrench:

Por favor verifica los requerimientos del servidor antes de empezar. [Docuementación oficial](https://laravel.com/docs/8.x/installation)

Clona el repositorio
	
    git clone git@github.com:alvin376/IAhorro.git

Cambiar a la carpeta del repositorio

    cd IAhorro

Instala todas las dependencias usando composer

    composer install

Copia el archivo `.env.example` y realiza los cambios de configuración encesarios enel archivo `.env`

    cp .env.example .env

Genera una nueva clave de aplicación

    php artisan key:generate

Ejecuta las migraciones de la base de datos (**Establezca la conexión de la base de datos en `.env` antes de migrar**)

    php artisan migrate

Si deseas añadir algunos datos de prueba en la BD

    php artisan db:seed

***Note*** : Se recomienda tener una base de datos limpia antes de sembrar. Puede actualizar sus migraciones en cualquier momento para limpiar la base de datos ejecutando el siguiente comando
	
	php artisan migrate:refresh

Inicie el servidor de desarrollo local

    php artisan serve

Ahora puede acceder al servidor en http://localhost:8000

## Uso de apis creadas :pushpin:

**Guardar información de cliente**
----
  _Guardar los datos de un cliente que solicite una hipoteca en iAhorro y asignarselo a un exporto hipotecario de forma aleatoria._

* **URL**

  _http://localhost:8000/api/records_

* **Method:**
  
  _`POST`_
 

* **Parametros Data**

  **Required:**
 
   `full_name=[string]`
   `email=[string]`
   `phone_number=[string]`
   `income=[integer]`
   `requested_amount=[integer]`
   `time_slot_start=[string]`
   `time_slot_end=[string]`

   ***Note*** : Los campos `time_slot_start` y `time_slot_end` deben tener un formato `H:i`

   ***Ejemplo*** : `time_slot_start = "12:45"` y `time_slot_end = "16:45"`

* **Response Exitoso:**

  * **Code:** 200 <br />
    **Content:** `{ "result" : true, "status" : "success" }`
 
* **Error Response:**

  * **Code:** 200 <br />
    **Content:** `{ "result" : false, "status" : "error_validate", "description" : { "<campo_erroneo>" : [ "<motivo_error>"] } }`

**Obtener información de clientes**
----
  _Obtener la información de los clientes asociado un experto inmobiliario en específico dado la franja horaria de los clientes._

* **URL**

  _http://localhost:8000/api/employees/`employee_id`/records

* **Method:**
  
  _`GET`_
 
*  **URL Params**

   **Required:**
 
   `employee_id=[integer]`

* **Response Exitoso:**

  * **Code:** 200 <br />
    **Content:** `{ "records" : [<att_records>] }`
 
* **Error Response:**

  * **Code:** 404 Not Found<br />


## Modelo de datos:
<iframe width="560" height="315" src='https://dbdiagram.io/embed/5e8b0b084495b02c3b894fd8'> </iframe>

## Gratitud / Motivación :sunny:

* Gracias por la oportunidad.