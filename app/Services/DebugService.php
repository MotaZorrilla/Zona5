<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class DebugService
{
    private $enabled;
    private $startTime;
    private $taskName;
    private $taskId;
    private $logPath;

    public function __construct($enabled = true, $taskId = null)
    {
        $this->enabled = $enabled;
        $this->startTime = microtime(true);
        $this->taskId = $taskId;

        if ($this->taskId) {
            $this->logPath = storage_path('logs/tasks');
            if (!is_dir($this->logPath)) {
                mkdir($this->logPath, 0755, true);
            }
        }
    }

    /**
     * Iniciar un proceso de depuración
     */
    public function startTask($taskName, $initialMessage = null)
    {
        $this->taskName = $taskName;
        
        if ($this->enabled) {
            $this->log("=========================================");
            $this->log("INICIO DE TAREA: {$taskName}");
            $this->log("=========================================");
            
            if ($initialMessage) {
                // Handle both string and array messages
                $messageStr = is_array($initialMessage) ? json_encode($initialMessage) : $initialMessage;
                $this->log("INFO: {$messageStr}");
            }
            
            $this->log("Tiempo de inicio: " . now()->format('Y-m-d H:i:s.u'));
            $this->log("Memoria usada: " . $this->formatBytes(memory_get_usage(true)));
            $this->log("=========================================");
        }
    }

    /**
     * Registrar un paso en el proceso
     */
    public function step($stepName, $progress = 0, $additionalInfo = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $memory = $this->formatBytes(memory_get_usage(true));
            
            $progressStr = $progress > 0 ? " [{$progress}%]" : "";
            $infoStr = $additionalInfo ? " | {$additionalInfo}" : "";
            
            $this->log("PASO: {$stepName}{$progressStr}{$infoStr}");
            $this->log("       Tiempo transcurrido: {$elapsed} | Memoria: {$memory}");
        }
    }

    /**
     * Registrar información adicional
     */
    public function info($message, $additionalInfo = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $infoStr = $additionalInfo ? " | {$additionalInfo}" : "";
            
            $this->log("INFO: {$message}{$infoStr}");
            $this->log("       Tiempo transcurrido: {$elapsed}");
        }
    }

    /**
     * Registrar una advertencia
     */
    public function warning($message, $additionalInfo = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $infoStr = $additionalInfo ? " | {$additionalInfo}" : "";
            
            $this->log("WARNING: {$message}{$infoStr}");
            $this->log("         Tiempo transcurrido: {$elapsed}");
        }
    }

    /**
     * Registrar un error
     */
    public function error($message, $additionalInfo = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $infoStr = $additionalInfo ? " | {$additionalInfo}" : "";
            
            $this->log("ERROR: {$message}{$infoStr}");
            $this->log("       Tiempo transcurrido: {$elapsed}");
        }
    }

    /**
     * Registrar una consulta SQL o base de datos
     */
    public function query($query, $bindings = [], $time = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $timeStr = $time ? " | Tiempo: {$time}ms" : "";
            
            $this->log("QUERY: {$query}");
            if (!empty($bindings)) {
                $this->log("       Bindings: " . json_encode($bindings));
            }
            $this->log("       Tiempo transcurrido: {$elapsed}{$timeStr}");
        }
    }

    /**
     * Finalizar el proceso de depuración
     */
    public function endTask($success = true, $result = null)
    {
        if ($this->enabled) {
            $elapsed = $this->getElapsedTime();
            $memory = $this->formatBytes(memory_get_usage(true));
            $peakMemory = $this->formatBytes(memory_get_peak_usage(true));
            
            $status = $success ? "ÉXITO" : "FALLIDO";
            
            $this->log("=========================================");
            $this->log("FIN DE TAREA: {$this->taskName} [{$status}]");
            $this->log("Tiempo total: {$elapsed}");
            $this->log("Memoria final: {$memory}");
            $this->log("Memoria pico: {$peakMemory}");
            
            if ($result) {
                $this->log("Resultado: " . (is_string($result) ? $result : json_encode($result)));
            }
            
            $this->log("=========================================");
        }
    }

    /**
     * Registrar un mensaje de depuración
     */
    private function log($message)
    {
        $logMessage = now()->format('Y-m-d H:i:s.u') . " | {$message}";

        // Registrar en un archivo de log específico de la tarea si hay un taskId
        if ($this->taskId) {
            $logFile = $this->logPath . '/' . $this->taskId . '.log';
            file_put_contents($logFile, $logMessage . "\n", FILE_APPEND);
        }

        // Registrar en el log general de Laravel
        Log::info("DEBUG[{$this->taskName}][{$this->taskId}]: {$message}");
        
        // Imprimir en consola si estamos en CLI
        if (php_sapi_name() === 'cli') {
            echo "[DEBUG][{$this->taskName}][{$this->taskId}] {$message}\n";
        }
    }

    /**
     * Obtener tiempo transcurrido desde el inicio
     */
    private function getElapsedTime()
    {
        $elapsed = microtime(true) - $this->startTime;
        return number_format($elapsed, 4) . "s";
    }

    /**
     * Formatear bytes a una unidad legible
     */
    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, $precision) . ' ' . $units[$i];
    }

    /**
     * Habilitar o deshabilitar la depuración
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Verificar si la depuración está habilitada
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}