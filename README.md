# vercontacto – Guía de instalación de la base de datos y configuración de Docker

## 1. Instalación de la base de datos MySQL

### Requisitos previos

- Tener instalado MySQL Server (local o remoto).
- Usuario con permisos para crear bases de datos y tablas.

### Pasos para importar la base de datos

1. **Crea la base de datos (si no existe):**

   ```sql
   CREATE DATABASE vercontacto CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
   ```

2. **Importa el archivo SQL:**

   - Ubica el archivo `db/vercontacto.sql` en tu máquina.
   - Ejecuta el siguiente comando en la terminal (reemplaza `<usuario>` por tu usuario de MySQL):
     ```sh
     mysql -u <usuario> -p db/vercontacto < /ruta/al/archivo/vercontacto.sql
     ```
   - Ingresa la contraseña cuando se solicite.

   **Ejemplo:**

   ```sh
   mysql -u root -p vercontacto < ./db/vercontacto.sql
   ```

---

## 2. Configuración de Docker Compose para la app

### Variables de entorno necesarias

En el archivo `docker-compose.yml` debes definir las variables de entorno para que la app pueda conectarse a la base de datos.  
Ejemplo de sección `environment`:

```yaml
environment:
  - DB_TYPE=MySQLi_Object
  - DB_SERVER=miservidordb.com
  - DB_NAME=vercontacto
  - DB_USER=vercontacto
  - DB_PASS=tu_contraseña
  - DB_PORT=3306
```

### Ejemplo completo de `docker-compose.yml`

```yaml
version: "3.8"

services:
  web:
    build: .
    container_name: vercontacto_web
    environment:
      - DB_TYPE=MySQLi_Object
      - DB_SERVER=miservidordb.com
      - DB_NAME=vercontacto
      - DB_USER=vercontacto
      - DB_PASS=tu_contraseña
      - DB_PORT=3306
    volumes:
      - ./imagenes:/var/www/api/images
    ports:
      - "5566:80"
```

- Cambia `DB_SERVER` por el host de tu base de datos si es diferente.
- Cambia `DB_PASS` por la contraseña real del usuario MySQL.
- El volumen `./imagenes:/var/www/api/images` permite que las imágenes sean persistentes fuera del contenedor.
- El puerto `5566` es el puerto externo; puedes cambiarlo si lo necesitas.

---

## 3. Levantar la aplicación

Desde la raíz del proyecto, ejecuta:

```sh
docker-compose up --build
```

Esto construirá la imagen y levantará el contenedor con la configuración adecuada.

---

## 4. Acceso

- La aplicación principal estará disponible en:  
  [http://localhost:5566](http://localhost:5566)
- La API estará disponible en:  
  [http://localhost:5566/api](http://localhost:5566/api)

---

\*\*¡Listo! Ahora tu app y tu base de datos están conectadas
