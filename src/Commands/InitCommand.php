<?php

namespace Dagim\LaraCraft\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class InitCommand extends LaraCraftCommand
{
    protected $signature = 'lara-craft:init
                            {--model= : Model name to generate}
                            {--force : Overwrite existing files}';
    
    protected $description = 'Initialize a new CRUD module configuration';

    public function handle()
    {
        $modelName = $this->option('model') ?: $this->ask('Enter model name (e.g., Product)');
        $tableName = $this->ask('Enter table name (plural, e.g., products)', Str::snake(Str::plural($modelName)));
        
        $fields = $this->ask('Enter fields (format: "name:string, email:string:unique, age:integer")');
        
        $config = [
            'model' => $modelName,
            'table' => $tableName,
            'fields' => $this->parseFields($fields),
            'timestamp' => now()->toDateTimeString(),
            'author' => $this->getConfig('signature.author'),
        ];
        
        $this->saveConfig($config);
        $this->displaySuccess("Configuration saved for {$modelName}");
        $this->info('Run: php artisan lara-craft:generate to create files');
    }
    
    protected function saveConfig(array $config)
    {
        $path = config_path('lara-craft');
        
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }
        
        $filename = Str::snake($config['model']).'.json';
        File::put("{$path}/{$filename}", json_encode($config, JSON_PRETTY_PRINT));
    }
}
?>