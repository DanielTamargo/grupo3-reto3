# Set up

Partiendo de que ya tenemos Laravel (homestead) funcionando, realizamos una serie de pasos para configurar el proyecto y poder trabajar todos juntos sobre el mismo.  

## 1- Clonar el repositorio  
Lo primero será clonar el repositorio, clonarlo donde tengas los demás proyectos de Laravel, así podrás localizarlo más rápido.  

## 2- Fichero .env
El fichero .env **nunca** debería publicarse, por lo que se incluye en el .gitignore. Como es un proyecto de clase y lo que buscamos es trabajar en conjunto y aprender, sí que subiremos un fichero llamado ejemplo.env el cual renombraremos a .env y así tendremos disponibles las variables de entorno que configuran nuestro proyecto.  
Accedemos a la carpeta del proyecto y ejecutamos:  
```bash
# Nos situamos en la ruta del proyecto
copy ejemplo.env .env
```

## 2- Modificar el fichero Homestead.yaml
Tendremos que añadir el mapeo  
```yaml
folders:
    - map: ./www # <- aquí dentro es donde he dejado los proyectos
      to: /home/vagrant/projects # <- y esta la ruta donde apunto

sites:
    # ...
    - map: igobide.test # <- esta es la configurada en el .env
      to: /home/vagrant/projects/reto3/public # <- y por eso pongo esa ruta!
```
> **Nota:**   
> En mi caso dejo los proyectos dentro de una carpeta llamada **www** y hago el mapeo a /home/vagrant/**projects**, en vuestro caso fijaros en la directiva **folders** para saber dónde tenéis que dejar el repositorio y cómo lo está vinculando con la máquina virtual.

## 3- Añadir el dominio al fichero hosts
Modificamos el fichero hosts ubicado en C:\Windows\System32\drivers\etc y añadimos: 
```yaml
192.168.10.10      igobide.test
```
> **Nota:**   
> 192.168.10.10 es la ip que he indicado en la primera línea del Homestead.yaml, si tenéis otra, poned la vuestra. Lo mismo para el dominio, si habéis configurado otro dominio, poned el que hayáis indicado.  

## 4- Instalar dependencias node.js
Hemos clonado el repositorio pero no tenemos las dependencias instaladas, estas se incluyen en el .gitignore para ahorrar mucho espacio en la nube y aprovechándonos de los ficheros de configuración de dependencias como **package.json** nos permitirán instalarlas con un solo comando.  
Desde Windows (para evitar problemas de bin links) accedemos dentro del proyecto y ejecutamos el comando:  
```bash
npm install
```  

## 5- Reload --provision
Con estos cambios ya hechos, vamos a recargar y volver a lanzar las provisiones para que se aplique bien la configuración y poder probar.  
Para ello, en el directorio de Homestead (donde tenemos el Homestead.yaml) ejecutamos el comando: 
```bash
vagrant reload --provision
```

## 6- Instalar dependencias composer
Ya tenemos casi todo configurado, ahora tenemos que instalar las dependencias del lado del servidor utilizando composer. Para ello ejecutamos `vagrant ssh`, accedemos a la carpeta del proyecto y ejecutamos el comando `composer install`

## 7- BBDD
Accedemos a la máquina virtual con `vagrant ssh` y a la consola mysql con `mysql -u root`
```bash
# Creamos la base de datos para tenerla disponible
CREATE DATABASE igobide;

# Creamos el usuario dev y le asignamos permisos
CREATE USER 'dev'@'localhost' IDENTIFIED BY '12345Abcde';
GRANT ALL PRIVILEGES ON igobide.* TO 'dev'@'localhost';
FLUSH PRIVILEGES;
```

## 8- Migraciones
Ejecutamos las migraciones existentes para generar las tablas y así poder probar la aplicación:  
```bash
php artisan migrate
```
