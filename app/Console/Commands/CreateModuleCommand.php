<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CreateModuleCommand extends Command
{
    // Dejamos {action?} como opcional. Si no se pasa, asumimos archivo único plano.
    protected $signature = 'make:module {name : El nombre del modelo o componente (ej. Product, Home)} 
                            {action? : La acción opcional para módulos complejos (ej. create, edit)}
                            {--C|controller : Crear un controlador con métodos comunes}
                            {--L|livewire : Crear un componente de Livewire (Clase y Vista separadas)}';

    protected $description = 'Crea un Modelo, Migración, Vista Blade y opcionalmente Controlador y Livewire de forma plana o modular.';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $action = $this->argument('action') ? Str::lower($this->argument('action')) : null; 

        $this->info($action 
            ? "⚡ Iniciando creación de submódulo: {$name} ({$action}) ⚡"
            : "⚡ Iniciando creación de componente único: {$name} ⚡"
        );

        // 1. Crear Modelo y Migración (Solo si el archivo no existe)
        if (!File::exists(app_path("Models/{$name}.php"))) {
            $this->call('make:model', [
                'name' => $name,
                '-m' => true,
            ]);
        } else {
            $this->comment("👉 El modelo {$name} ya existe. Saltando creación...");
        }

        // 2. Crear Controlador (Opcional)
        if ($this->option('controller')) {
            if (!File::exists(app_path("Http/Controllers/{$name}Controller.php"))) {
                $this->call('make:controller', [
                    'name' => "{$name}Controller",
                ]);
            } else {
                $this->comment("👉 El controlador {$name}Controller ya existe.");
            }
        }

        // 3. Crear Componente Livewire (Opcional)
        if ($this->option('livewire')) {
            // Si hay acción: "product.create". Si no: "home" (plano)
            $livewireName = $action 
                ? Str::kebab($name) . '.' . Str::kebab($action)
                : Str::kebab($name);
            
            $this->call('make:livewire', [
                'name' => $livewireName,
                '--class' => true, 
            ]);
        }

        // 4. Crear Vista Blade Estándar
        $this->createBladeView($name, $action);

        $this->info("✅ ¡Proceso completado con éxito!");
    }

    /**
     * Helper para crear la vista blade (plana o en subcarpeta)
     */
    protected function createBladeView($name, $action)
    {
        $nameLivewire = Str::kebab($name);

        if ($action) {
            // MÓDULO COMPLEJO (con subcarpetas): ej. resources/views/products/create.blade.php
            $directoryName = Str::snake(Str::pluralStudly($name));
            $directoryPath = resource_path("views/{$directoryName}");
            $viewPath = "{$directoryPath}/{$action}.blade.php";
            $livewireDirective = "@livewire('{$nameLivewire}.{$action}')";
            $title = "{$name} - " . Str::studly($action);
        } else {
            // COMPONENTE ÚNICO (plano): ej. resources/views/home.blade.php
            $directoryPath = resource_path("views");
            $viewPath = "{$directoryPath}/" . Str::snake($name) . ".blade.php";
            $livewireDirective = "@livewire('{$nameLivewire}')";
            $title = $name;
        }

        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        if (!File::exists($viewPath)) {
            $template = "<x-app-layout>\n";
            $template .= "    <x-slot name='title'>{$title}</x-slot>\n\n";
            $template .= "    <x-swal-toast/>\n\n";
            $template .= "    {$livewireDirective}\n";
            $template .= "</x-app-layout>";

            File::put($viewPath, $template);
            $this->info("View created: " . str_replace(resource_path(), 'resources', $viewPath));
        } else {
            $this->warn("La vista en '{$viewPath}' ya existe.");
        }
    }
}