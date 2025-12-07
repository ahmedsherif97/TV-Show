<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $composer;

    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $names = $this->argument('name');

            foreach ($names as $module) {
                $module = Str::studly($module);

                $modulesNameSpace = config('modules.namespace');

                $modulePath = base_path($moduleFolder = "$modulesNameSpace/$module");

                // Create directory if it doesn't exist
                if (!File::exists($modulePath)) {
                    File::makeDirectory($modulePath, 0755, true);
                } else {
                    // Should stop then return module is aready exists
                }

                // generate folders
                foreach (json_decode(json_encode(config('modules.paths.generator'))) as $key => $folder) {
                    if (!$folder->generate) continue;
                    if (!File::exists("$moduleFolder/$folder->path")) {
                        File::makeDirectory("$moduleFolder/$folder->path", 0755, true);
                    }
                }


                $tableName = Str::plural(Str::snake($module));
                $routePrefix = Str::kebab($module);

                $replacments = [
                    'MODULE' => $module,
                    'STUDLY_NAME' => $tableName,
                    'ROUTE_PREFIX' => $routePrefix,
                    'NAME' => $module,
                    'MODEL' => "$modulesNameSpace\\$module\\App\\Models\\$module",
                    'LOWER_NAME' => strtolower($module),
                    'CONTROLLER_NAMESPACE' => "$modulesNameSpace\\$module\\App\\Http\\Controllers"
                ];

                //generate files
                if (config('modules.stubs.enabled')) {
                    $stubsPath = config('modules.stubs.path');
                    foreach (json_decode(json_encode(config('modules.stubs.files'))) as $key => $filePath) {
                        if (!File::exists($stubFile = "$stubsPath/$key.stub")) continue;

                        $content = File::get($stubFile);

                        $filePath = str_replace('$NAME$', $module, $filePath);
                        $fileName = pathinfo($filePath, PATHINFO_FILENAME);

                        $replacments['NAMESPACE'] = $this->generateNamespace("$moduleFolder/$filePath");
                        $replacments['CLASS'] = $fileName;

                        //dd($moduleFolder, $folder);
                        //$replacments['CLASS_NAMESPACE'] = str_replace('/', '\\', $moduleFolder . '/' . $folder);

                        // Replace placeholders
                        foreach ($replacments as $key => $value) {
                            $content = str_replace("$$key$", $value, $content);
                        }

                        File::put("$modulePath/$filePath", $content);
                    }
                }

                // Generate migration file
                Artisan::call('make:migration', [
                    'name' => 'create_' . $tableName . '_table',
                    '--create' => $tableName,
                    '--path' => "$modulesNameSpace/$module/database/migrations"
                ], new ConsoleOutput());


                $this->publishModuleProviderToRegister("$moduleFolder/App/Providers/AppServiceProvider");

                $this->info("Module $module Created successfully");
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'The names of modules will be created.'],
        ];
    }

    public function generateNamespace(string $filePath, string $basePath = '')
    {
        // Remove base path from file path
        $relativePath = str_replace($basePath, '', $filePath);

        // Remove file name from the path
        $directoryPath = dirname($relativePath);

        // Convert directory separators to namespace separators
        $namespace = str_replace('/', '\\', $directoryPath);

        // Remove file extension
        $namespace = preg_replace('/\\.[^.\\s]{3,4}$/', '', $namespace);

        // Capitalize each segment of the namespace
        $namespace = implode('\\', array_map('ucfirst', explode('\\', $namespace)));

        // Trim leading and trailing slashes and backslashes
        $namespace = trim($namespace, '\/');

        return $namespace;
    }


    public function publishModuleProviderToRegister(string $moduleAppServiceProvider)
    {
        $moduleAppServiceProvider = str_replace('/', '\\', $moduleAppServiceProvider);

        $path = app_path('Providers/ModuleServiceProvider.php');

        // Check if ModuleServiceProvider file exists
        if (File::exists($path)) {
            // Read the content of the file
            $content = File::get($path);

            //check if module already exists
            if (strpos($content, $moduleAppServiceProvider) === false) {
                $matcher = 'Other Providers goes here';

                // Append the line to the register() method
                $content = str_replace(
                    $matcher,
                    $matcher . PHP_EOL . '        "' . $moduleAppServiceProvider . '",',
                    $content
                );

                // Write the modified content back to the file
                File::put($path, $content);

                // Dump the autoload files
                $this->info('Line added successfully.');
            }
            $this->composer->dumpAutoloads();
        } else {
            $this->error('ModuleServiceProvider file not found.');
        }
    }
}
