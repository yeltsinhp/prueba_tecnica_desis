# Instrucciones de Instalación del Proyecto "Prueba Técnica Desis"

## Requisitos Previos
1. **XAMPP**: Debes tener instalado XAMPP en tu sistema.
   - Descargar desde: https://www.apachefriends.org/index.html
   - Asegúrate de instalar la versión que incluye PHP 8.1.

2. **PHP 8.1**: La versión de PHP instalada en XAMPP debe ser la 8.1.
   - Puedes verificar la versión de PHP ejecutando `php -v` desde la línea de comandos.

3. **PostgreSQL 16**: Debes tener instalado PostgreSQL 16 en tu sistema.
   - Descargar desde: https://www.postgresql.org/download/
   - Asegúrate de configurar PostgreSQL correctamente, incluyendo la creación de una base de datos para este proyecto.

## Pasos de Instalación
1. **Descargar y Configurar el Proyecto**:
   - Descarga el proyecto desde el repositorio.

2. **Colocar el Proyecto en el Servidor XAMPP**:
   - Copia la carpeta del proyecto y pégala en la carpeta `htdocs` de XAMPP. 
   - La ruta típica sería `C:\xampp\htdocs\prueba_tecnica_desis` en Windows.

3. **Configuración de la Base de Datos**:
   - Crea una base de datos en PostgreSQL con el nombre `producto_desis`.
   - Importa el archivo SQL proporcionado en el proyecto y ejecuta los scripts SQL incluidos para crear las tablas necesarias.
   - Configura la conexión a la base de datos en el archivo de configuración del proyecto, asegurándote de que los detalles coincidan con tu entorno (usuario, contraseña, host).

4. **Iniciar Apache en XAMPP**:
   - Abre el Panel de Control de XAMPP.
   - Enciende el servicio de Apache haciendo clic en "Start" junto a Apache.

5. **Acceder a la Aplicación**:
   - Abre tu navegador web.
   - Ingresa la siguiente URL: `http://localhost/prueba_tecnica_desis`.
   - Deberías ver la interfaz de la aplicación cargada correctamente.
