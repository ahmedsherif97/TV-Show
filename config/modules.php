<?php

return [
    'namespace' => 'Modules',
    'stubs' => [
        'enabled' => true,
        'path' => base_path('stubs/modules'),
        'files' => [
            'routes/dashboard' => 'routes/dashboard.php',
            'routes/web' => 'routes/web.php',
            'routes/api' => 'routes/api.php',

            'lang/ar/api' => 'lang/ar/api.php',
            'lang/ar/main' => 'lang/ar/main.php',
            'lang/ar/dashboard' => 'lang/ar/dashboard.php',
            'lang/ar/validation' => 'lang/ar/validation.php',
            'lang/ar/notification' => 'lang/ar/notification.php',

            'lang/en/api' => 'lang/en/api.php',
            'lang/en/main' => 'lang/en/main.php',
            'lang/en/dashboard' => 'lang/en/dashboard.php',
            'lang/en/validation' => 'lang/en/validation.php',
            'lang/en/notification' => 'lang/en/notification.php',

            'resources/views/index.blade' => 'resources/views/index.blade.php',
            'resources/views/dashboard/datatable.blade' => 'resources/views/dashboard/datatable.blade.php',
            'resources/views/dashboard/index.blade' => 'resources/views/dashboard/index.blade.php',
            'resources/views/dashboard/edit.blade' => 'resources/views/dashboard/edit.blade.php',
            'resources/views/dashboard/create.blade' => 'resources/views/dashboard/create.blade.php',
            'resources/views/dashboard/form.blade' => 'resources/views/dashboard/form.blade.php',
            'resources/views/dashboard/layouts/aside.blade' => 'resources/views/dashboard/layouts/aside.blade.php',
            //'resources/views/master' => 'resources/views/layouts/master.blade.php',
            'config/config' => 'config/config.php',

            'app/Providers/AppServiceProvider' => 'app/Providers/AppServiceProvider.php',
            'app/Providers/RouteServiceProvider' => 'app/Providers/RouteServiceProvider.php',

            'app/Http/Controllers/Dashboard/$NAME$Controller' => 'app/Http/Controllers/Dashboard/$NAME$Controller.php',
            'app/Http/Controllers/Api/$NAME$Controller' => 'app/Http/Controllers/Api/$NAME$Controller.php',
            'app/Http/Controllers/$NAME$Controller' => 'app/Http/Controllers/$NAME$Controller.php',

            'app/Notifications/$NAME$Created' => 'app/Notifications/$NAME$Created.php',
            'app/Notifications/$NAME$Updated' => 'app/Notifications/$NAME$Updated.php',
            'app/Notifications/$NAME$Deleted' => 'app/Notifications/$NAME$Deleted.php',

            'database/seeders/DatabaseSeeder' => 'database/seeders/DatabaseSeeder.php',

            'app/Models/$NAME$' => 'app/Models/$NAME$.php',

            'composer' => 'composer.json',
        ]
    ],
    'paths' => [
        'generator' => [
            'controller' => ['path' => 'app/Http/Controllers', 'generate' => true],
            'controller-api' => ['path' => 'app/Http/Controllers/Api', 'generate' => true],
            'controller-dashboard' => ['path' => 'app/Http/Controllers/Dashboard', 'generate' => true],

            'filter' => ['path' => 'app/Http/Middleware', 'generate' => true],
            'request' => ['path' => 'app/Http/Requests', 'generate' => true],

            'provider' => ['path' => 'app/Providers', 'generate' => true],
            'model' => ['path' => 'app/Models', 'generate' => true],

            'config' => ['path' => 'config', 'generate' => true],
            'command' => ['path' => 'app/Console', 'generate' => false],

            'migration' => ['path' => 'database/migrations', 'generate' => true],
            'seeder' => ['path' => 'database/seeders', 'generate' => true],
            'factory' => ['path' => 'database/factories', 'generate' => true],
            'routes' => ['path' => 'routes', 'generate' => true],

            'lang' => ['path' => 'lang', 'generate' => true],
            'lang-ar' => ['path' => 'lang/ar', 'generate' => true],
            'lang-en' => ['path' => 'lang/en', 'generate' => true],

            'assets' => ['path' => 'resources/assets', 'generate' => false],

            'views' => ['path' => 'resources/views', 'generate' => true],
            'views-dashboard' => ['path' => 'resources/views/dashboard', 'generate' => true],
            'views-frontend' => ['path' => 'resources/views/frontend', 'generate' => true],

            'views-dashboard-layouts' => ['path' => 'resources/views/dashboard/layouts', 'generate' => true],
            'views-frontend' => ['path' => 'resources/views/frontend', 'generate' => true],

            'test-feature' => ['path' => 'Tests/Feature', 'generate' => false],
            'repository' => ['path' => 'Repositories', 'generate' => false],
            'event' => ['path' => 'app/Events', 'generate' => false],
            'listener' => ['path' => 'Listeners', 'generate' => false],
            'policies' => ['path' => 'app/Policies', 'generate' => false],
            'rules' => ['path' => 'app/Rules', 'generate' => false],
            'jobs' => ['path' => 'app/Jobs', 'generate' => false],
            'emails' => ['path' => 'app/Emails', 'generate' => false],
            'notifications' => ['path' => 'app/Notifications', 'generate' => true],

            'test' => ['path' => 'tests/Unit', 'generate' => false],
            'resource' => ['path' => 'Transformers', 'generate' => false],
        ],
    ],
];
