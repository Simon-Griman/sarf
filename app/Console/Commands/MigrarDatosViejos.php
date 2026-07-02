<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrarDatosViejos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrar-datos-viejos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $this->info('Iniciando la migración entre bases de datos del mismo servidor...');

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Limpiar las tablas de destino para empezar desde cero y limpios
    $this->info('Limpiando tablas de destino...');
    DB::table('sarf.ruta_terminal_destino')->truncate();
    DB::table('sarf.cargamentos')->truncate();
    DB::table('sarf.rutas')->truncate();

    // 1. Quitamos ->toBase() de aquí
    $cargamentosViejos = DB::table('sarf_respaldo.cargamentos')->distinct()->get();

    if ($cargamentosViejos->isEmpty()) {
        $this->error('No se encontraron datos en la base de datos de respaldo.');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return Command::FAILURE;
    }

    $bar = $this->output->createProgressBar(count($cargamentosViejos));
    $bar->start();

    foreach ($cargamentosViejos as $viejo) {
        
        
        $ruta = DB::table('sarf.rutas')
            ->where('nro_ruta', $viejo->nro_ruta)
            ->where('buque', $viejo->buque)
            ->first();

        if (!$ruta) {
            $rutaId = DB::table('sarf.rutas')->insertGetId([
                'nro_ruta'           => $viejo->nro_ruta,
                'buque'              => $viejo->buque,
                'terminal_origen_id' => $viejo->terminal_origen_id,
                'created_at'         => $viejo->created_at ?? now(),
                'updated_at'         => $viejo->updated_at ?? now(),
            ]);
        } else {
            $rutaId = $ruta->id;
        }

        // 3. Insertar el cargamento en la BD actual (Se queda igual)
        DB::table('sarf.cargamentos')->insertOrIgnore([
            'id'             => $viejo->id,
            'nro_embarque'   => $viejo->nro_embarque,
            'fecha_operacion' => $viejo->fecha_operacion,
            'ruta_id'        => $rutaId, 
            'operacion_id'   => $viejo->operacion_id,
            'inspector_id'   => $viejo->inspector_id,
            'nominacion'     => $viejo->nominacion,
            'embarque'       => $viejo->embarque,
            'cantidad'       => $viejo->cantidad,
            'calidad'        => $viejo->calidad,
            'hoja_tiempo'    => $viejo->hoja_tiempo,
            'acta'           => $viejo->acta,
            'ullage_inicial' => $viejo->ullage_inicial,
            'ullage_final'   => $viejo->ullage_final,
            'created_at'     => $viejo->created_at ?? now(),
            'updated_at'     => $viejo->updated_at ?? now(),
        ]);

        $destinosViejos = DB::table('sarf_respaldo.parcela_terminal_destino')
            ->where('parcela_id', $viejo->id)
            ->get();

        foreach ($destinosViejos as $destino) {
            DB::table('sarf.ruta_terminal_destino')->insertOrIgnore([
                'ruta_id'             => $rutaId,
                'terminal_destino_id' => $destino->terminal_destino_id,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }

        $bar->advance();
    }

    $bar->finish();
    $this->newLine();

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $this->info('¡Migración completada exitosamente entre ambas bases de datos!');

    return Command::SUCCESS;
}
}
