# Bibliografía

## Librerías / Paquetes utilizados
- FakerPHP
  - [Enlace packagist](https://packagist.org/packages/fakerphp/faker)
  - [Documentación oficial](https://fakerphp.github.io/)
- Laravel UI Bootstrap + Auth
  - [Documentación oficial BootStrap](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
  - [Instalación](#Bootstrap-y-Auth)

## Documentación que resultó muy útil
- [Laravel 8 Docs](https://laravel.com/docs/8.x/)
  - [Primary Keys personalizadas (tipo string y que no se llamen id)](https://laravel.com/docs/8.x/eloquent#primary-keys)
  - [Eloquent: Relaciones](https://laravel.com/docs/8.x/eloquent-relationships)
- Seguridad
  - [Laravel 8 HTTPS en Producción (al cargar una ruta devuelve enlace HTTPS)](https://stackoverflow.com/questions/35827062/how-to-force-laravel-project-to-use-https-for-all-routes#:~:text=Here%20are%20several%20ways.%20Choose%20most%20convenient.)
  - [Laravel 8 redirigir HTTP a HTTPS en Producción (siempre que entra en HTTP redirige a HTTPS)](https://programmingfields.com/redirect-http-to-https-using-middleware-in-laravel/#Create_Middleware_in_Laravel_8)

## Metodologías y decisiones
- [¿Por qué no hemos usado enums en las migraciones de Laravel?](http://komlenic.com/244/8-reasons-why-mysqls-enum-data-type-is-evil/)

-------

# Instalaciones

## Bootstrap y Auth

**Instalación y compilación**
```bash
# Instalar paquete Laravel/UI
composer require laravel/ui

# Añadir bootstrap
php artisan ui bootstrap --auth

# Instalar dependencias
npm install # <- desde Windows ó añadir --no-bin-links

# Compilar el código JS y CSS mediante Webpack
npm run dev # <- compilar siempre que hagamos cambios!
```

Nota, si sale el siguiente mensaje (o parecido):
> *Additional dependencies must be installed. This will only take a moment.  
> Running: npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps.  
> Finished. Please run Mix again.*  
Hay que volver a ejecutar `npm run dev`.  

Si al ejecutar `npm run dev` da error probamos los siguientes comandos:  
```bash
rm -rf node_modules
rm package-lock.json
npm cache clear --force
npm install
```

**Utilizar Bootstrap en las vistas**
```html
<!-- Link CSS Bootstrap -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

<!-- Script JS Bootstrap -->
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
```

