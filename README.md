

## Laravel and Vue config with Vite

create laravel project

```
composer create-project --prefer-dist laravel/laravel my_project
```

install Laravel UI

```
composer require laravel/ui
```

Vue telepítése a Laravel UI csomaggal:

```
php artisan ui vue
```

Először telepítsd a Vite-t a npm vagy yarn segítségével. Például:

```
npm install vite
```

Vite konfigurálása a Laravel projektben

Hozz létre egy vite.config.js fájlt a projekt gyökérkönyvtárában, és konfiguráld a Vite-ot, hogy szolgálja a Vue fájlokat és a Laravel public mappát. Példa egy egyszerű vite.config.js fájlra:

```
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});

```
------------------------------------------------------------------------------------
## Inertia telepítése

Függősegek telpítése
```
composer require inertiajs/inertia-laravel
```

A gyökér sablona feltételezi, hogy a file neve **app.blade.php**
```
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>
```

Regisztrálni kell az inertiát

```
php artisan inertia:middleware
```

**App\Http\Kernelweb**
```
'web' => [
    // ...
    \App\Http\Middleware\HandleInertiaRequests::class,
],
```

Létre kell hozni egy contorllert
```

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        /*Átalakítjuk Kollekcióvá, hogy ne adjon át mindent*/
        $posts = PostResource::collection(Post::all());

        return inertia ('Post/Index', compact('posts'));
    }
}
```

Majd regisztálni kell a web rout-ban
```
Route::get('/', [\App\Http\Controllers\PostController::class, 'index']);
```

### Frontend

Inertia npm telepítése
```
npm install @inertiajs/vue3
```

Az app.js átírása
```
import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

```

Mappaszerkezet kialakítása

- resources/
  - js/
    - Pages/
        - Post/
            - Index.vue
    - component

### Adatok resource-á alakítása

```
php artisan make:resource PostResource
```

Az **AppServiceProvider** filet-t át kell írni 

```
<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}

```

### Laravel utvonalak használata vue komponenseben

https://github.com/tighten/ziggy

```
composer require tightenco/ziggy
```

```
```

