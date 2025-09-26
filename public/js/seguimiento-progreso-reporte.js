/**
 * Seguimiento de Progreso de Reporte
 * Proporciona seguimiento en tiempo real para la generación de reportes con salida detallada en consola
 */

class SeguimientoProgresoReporte {
    constructor() {
        this.taskId = null;
        this.pollingInterval = null;
        this.isTracking = false;
        this.consoleLog = [];
        this.metricasRendimiento = {
            startTime: null,
            endTime: null,
            duracionTotal: 0,
            usoMemoria: []
        };
        
        // Inicializar registro en consola
        this.initRegistroConsola();
    }

    /**
     * Inicializar registro mejorado en consola
     */
    initRegistroConsola() {
        // Crear un registrador de consola personalizado para capturar todas las actividades
        this.originalLog = console.log;
        this.originalInfo = console.info;
        this.originalWarn = console.warn;
        this.originalError = console.error;
        
        const self = this;
        
        console.log = function(...args) {
            self.registroATracker('log', args);
            self.originalLog.apply(console, args);
        };
        
        console.info = function(...args) {
            self.registroATracker('info', args);
            self.originalInfo.apply(console, args);
        };
        
        console.warn = function(...args) {
            self.registroATracker('warn', args);
            self.originalWarn.apply(console, args);
        };
        
        console.error = function(...args) {
            self.registroATracker('error', args);
            self.originalError.apply(console, args);
        };
    }

    /**
     * Registrar mensajes al tracker interno
     */
    registroATracker(level, args) {
        const timestamp = new Date().toISOString();
        const message = args.map(arg => 
            typeof arg === 'object' ? JSON.stringify(arg) : String(arg)
        ).join(' ');

        this.consoleLog.push({
            timestamp,
            level,
            message,
            tiempoFormateado: new Date(timestamp).toLocaleTimeString()
        });

        // Mantener solo las últimas 1000 entradas de registro para prevenir problemas de memoria
        if (this.consoleLog.length > 1000) {
            this.consoleLog.shift();
        }

        // Registrar en consola con formato mejorado
        if (message.includes('PROGRESO:') || message.includes('PASO:')) {
            console.group(`%c${message}`, 'color: #007bff; font-weight: bold;');
            console.trace();
            console.groupEnd();
        }
    }

    /**
     * Iniciar seguimiento de progreso para una tarea de generación de reporte
     */
    iniciarSeguimiento(taskId, opciones = {}) {
        this.taskId = taskId;
        this.isTracking = true;
        this.metricasRendimiento.startTime = Date.now();
        
        console.group(`%c🔍 Iniciado Seguimiento de Progreso - ID Tarea: ${taskId}`, 'color: #28a745; font-weight: bold;');
        console.info(`%c📈 Seguimiento iniciado a las: ${new Date().toLocaleString()}`, 'color: #17a2b8;');
        console.info(`%c📊 Recolección de métricas de rendimiento iniciada`, 'color: #ffc107;');
        console.groupEnd();

        // Iniciar polling para actualizaciones de progreso
        this.iniciarPolling(opciones);
        
        // Iniciar monitoreo de rendimiento
        this.iniciarMonitoreoRendimiento();
        
        this.logEvento('seguimiento_iniciado', { 
            taskId, 
            timestamp: new Date().toISOString() 
        });
    }

    /**
     * Detener seguimiento de progreso
     */
    detenerSeguimiento() {
        this.isTracking = false;
        
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
        }
        
        this.metricasRendimiento.endTime = Date.now();
        this.metricasRendimiento.duracionTotal = 
            this.metricasRendimiento.endTime - this.metricasRendimiento.startTime;
        
        console.group(`%c⏹️ Seguimiento de Progreso Detenido`, 'color: #dc3545; font-weight: bold;');
        console.info(`%c⏱️ Duración total: ${(this.metricasRendimiento.duracionTotal / 1000).toFixed(2)} segundos`, 'color: #6f42c1;');
        console.info(`%c📝 Total de registros de consola capturados: ${this.consoleLog.length}`, 'color: #28a745;');
        console.info(`%c📊 Uso de memoria pico: ${this.getUsoMemoriaPico()}`, 'color: #fd7e14;');
        console.groupEnd();

        this.logEvento('seguimiento_detenido', { 
            duracion: this.metricasRendimiento.duracionTotal,
            totalLogs: this.consoleLog.length,
            timestamp: new Date().toISOString()
        });
    }

    /**
     * Iniciar polling para actualizaciones de progreso
     */
    iniciarPolling(opciones = {}) {
        const pollInterval = opciones.pollInterval || 2000; // Por defecto 2 segundos
        const maxRetries = opciones.maxRetries || 100; // Prevenir polling infinito
        let retryCount = 0;

        this.pollingInterval = setInterval(() => {
            if (!this.isTracking || !this.taskId) {
                this.detenerSeguimiento();
                return;
            }

            if (retryCount >= maxRetries) {
                console.warn(`%c⚠️ Límite de reintentos (${maxRetries}) alcanzado. Deteniendo polling.`, 'color: #ffc107;');
                this.detenerSeguimiento();
                return;
            }

            this.obtenerEstadoTarea()
                .then(datosTarea => {
                    if (datosTarea) {
                        this.actualizarProgreso(datosTarea);
                        retryCount = 0; // Reiniciar contador de reintentos en respuesta exitosa
                        
                        if (datosTarea.status === 'completed' || datosTarea.status === 'failed') {
                            this.manejarCompletacionTarea(datosTarea);
                        }
                    } else {
                        retryCount++;
                        console.warn(`%c⚠️ Obtención de estado fallida (intento ${retryCount}/${maxRetries})`, 'color: #ffc107;');
                    }
                })
                .catch(error => {
                    retryCount++;
                    console.error(`%c❌ Error obteniendo estado (intento ${retryCount}/${maxRetries}):`, 'color: #dc3545;', error);
                });
        }, pollInterval);
    }

    /**
     * Obtener estado de tarea desde el servidor
     */
    async obtenerEstadoTarea() {
        try {
            const response = await fetch('/admin/reports/get-task-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                body: JSON.stringify({ task_id: this.taskId })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.success && data.task) {
                return data.task;
            } else {
                console.warn(`%c⚠️ Invalid response format:`, 'color: #ffc107;', data);
                return null;
            }
        } catch (error) {
            console.error(`%c❌ Error fetching task status:`, 'color: #dc3545;', error);
            return null;
        }
    }

    /**
     * Actualizar visualización de progreso basado en datos de tarea
     */
    actualizarProgreso(datosTarea) {
        const progreso = datosTarea.progress || 0;
        const message = datosTarea.message || 'Procesando...';
        const estado = datosTarea.status;
        const error = datosTarea.error;

        // Registrar progreso en consola con información detallada
        console.group(`%c🔄 Actualización de Progreso - ${progreso}%`, 'color: #007bff; font-weight: bold;');
        console.info(`%c📋 ID Tarea: ${this.taskId}`, 'color: #6f42c1;');
        console.info(`%c📊 Estado: ${estado}`, 'color: #17a2b8;');
        console.info(`%c💬 Mensaje: ${message}`, 'color: #28a745;');
        
        if (error) {
            console.error(`%c❌ Error: ${error}`, 'color: #dc3545;');
        }
        
        console.info(`%c⏱️ Tiempo transcurrido: ${this.getTiempoTranscurrido()}`, 'color: #fd7e14;');
        console.groupEnd();

        // Registrar al tracker interno
        this.logEvento('actualizacion_progreso', {
            progreso,
            estado,
            message,
            error,
            timestamp: new Date().toISOString()
        });

        // Activar evento personalizado para actualizaciones de UI
        this.despacharEventoProgreso('reporte:progreso', {
            taskId: this.taskId,
            progreso,
            estado,
            message,
            error
        });
    }

    /**
     * Manejar la completación de tarea
     */
    manejarCompletacionTarea(datosTarea) {
        const estado = datosTarea.status;
        const result = datosTarea.result;
        const error = datosTarea.error;

        console.group(`%c${estado === 'completed' ? '✅' : '❌'} Tarea ${estado.toUpperCase()}`, 
            estado === 'completed' ? 'color: #28a745; font-weight: bold;' : 'color: #dc3545; font-weight: bold;');
        
        console.info(`%c📋 ID Tarea: ${this.taskId}`, 'color: #6f42c1;');
        console.info(`%c📊 Estado Final: ${estado}`, 'color: #17a2b8;');
        
        if (result) {
            console.info(`%c💾 Resultado:`, 'color: #28a745;', result);
        }
        
        if (error) {
            console.error(`%c❌ Error: ${error}`, 'color: #dc3545;');
        }
        
        console.info(`%c⏱️ Duración Total: ${this.getTiempoTranscurrido()}`, 'color: #fd7e14;');
        console.groupEnd();

        // Activar evento de completación
        this.despacharEventoProgreso(`reporte:${estado}`, {
            taskId: this.taskId,
            result,
            error,
            rendimiento: this.metricasRendimiento
        });

        // Detener seguimiento después de completación
        this.detenerSeguimiento();
    }

    /**
     * Iniciar monitoreo de rendimiento
     */
    iniciarMonitoreoRendimiento() {
        // Monitorear uso de memoria periódicamente
        setInterval(() => {
            if (performance.memory) {
                this.metricasRendimiento.usoMemoria.push({
                    timestamp: Date.now(),
                    usado: performance.memory.usedJSHeapSize,
                    total: performance.memory.totalJSHeapSize,
                    limite: performance.memory.jsHeapSizeLimit
                });
            }
        }, 5000); // Cada 5 segundos

        // Registrar métricas de rendimiento periódicamente
        setInterval(() => {
            if (this.isTracking) {
                this.logMetricasRendimiento();
            }
        }, 10000); // Cada 10 segundos
    }

    /**
     * Registrar métricas de rendimiento en consola
     */
    logMetricasRendimiento() {
        console.group(`%c⚙️ Actualización de Métricas de Rendimiento`, 'color: #6f42c1; font-weight: bold;');
        console.info(`%c⏱️ Tiempo Transcurrido: ${this.getTiempoTranscurrido()}`, 'color: #fd7e14;');
        
        if (performance.memory) {
            const memory = performance.memory;
            console.info(`%c💾 Heap JS: ${(memory.usedJSHeapSize / 1024 / 1024).toFixed(2)} MB / ${(memory.totalJSHeapSize / 1024 / 1024).toFixed(2)} MB`, 
                'color: #28a745;');
        }
        
        console.info(`%c📊 Registros activos en tracker: ${this.consoleLog.length}`, 'color: #17a2b8;');
        console.groupEnd();
    }

    /**
     * Obtener tiempo transcurrido formateado
     */
    getTiempoTranscurrido() {
        if (!this.metricasRendimiento.startTime) return '0s';
        
        const transcurrido = Date.now() - this.metricasRendimiento.startTime;
        const segundos = Math.floor(transcurrido / 1000);
        const minutos = Math.floor(segundos / 60);
        const segundosRestantes = segundos % 60;
        
        if (minutos > 0) {
            return `${minutos}m ${segundosRestantes}s`;
        }
        return `${segundos}s`;
    }

    /**
     * Obtener uso de memoria pico
     */
    getUsoMemoriaPico() {
        if (this.metricasRendimiento.usoMemoria.length === 0) {
            return 'N/A';
        }
        
        const peak = this.metricasRendimiento.usoMemoria.reduce((max, current) => 
            current.usado > max.usado ? current : max
        );
        
        return `${(peak.usado / 1024 / 1024).toFixed(2)} MB`;
    }

    /**
     * Obtener todos los registros de consola
     */
    getRegistrosConsola() {
        return [...this.consoleLog]; // Retornar una copia
    }

    /**
     * Obtener métricas de rendimiento
     */
    getMetricasRendimiento() {
        return {
            ...this.metricasRendimiento,
            duracionTotalFormateada: this.metricasRendimiento.duracionTotal ? 
                `${(this.metricasRendimiento.duracionTotal / 1000).toFixed(2)}s` : 'N/A'
        };
    }

    /**
     * Despachar evento personalizado
     */
    despacharEventoProgreso(nombreEvento, data) {
        const event = new CustomEvent(nombreEvento, { detail: data });
        document.dispatchEvent(event);
    }

    /**
     * Registrar evento al tracker interno
     */
    logEvento(tipoEvento, data) {
        this.registroATracker('info', [
            `EVENTO_PROGRESO: ${tipoEvento}`,
            JSON.stringify(data, null, 2)
        ]);
    }

    /**
     * Exportar registros para depuración
     */
    exportarRegistros() {
        const exportData = {
            taskId: this.taskId,
            startTime: this.metricasRendimiento.startTime,
            endTime: this.metricasRendimiento.endTime,
            duracionTotal: this.metricasRendimiento.duracionTotal,
            consoleLogs: this.getRegistrosConsola(),
            metricasRendimiento: this.getMetricasRendimiento(),
            userAgent: navigator.userAgent,
            timestamp: new Date().toISOString()
        };

        const blob = new Blob([JSON.stringify(exportData, null, 2)], { 
            type: 'application/json' 
        });
        
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `registro-progreso-reporte-${this.taskId}-${Date.now()}.json`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);

        console.info(`%c📝 Registros de progreso exportados para tarea: ${this.taskId}`, 'color: #28a745; font-weight: bold;');
    }
}

// Inicializar el tracker cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.seguimientoProgresoReporte = new SeguimientoProgresoReporte();
    
    // Agregar al alcance global para depuración
    console.info('%c🚀 Seguimiento de Progreso de Reporte inicializado y listo!', 'color: #28a745; font-weight: bold;');
    console.info('%c💡 Puedes acceder a registros detallados con: window.seguimientoProgresoReporte.getRegistrosConsola()', 'color: #17a2b8;');
    console.info('%c📊 Métricas de rendimiento disponibles: window.seguimientoProgresoReporte.getMetricasRendimiento()', 'color: #fd7e14;');
    console.info('%c💾 Exportar registros con: window.seguimientoProgresoReporte.exportarRegistros()', 'color: #6f42c1;');
});

// Exportar para uso en otros módulos si es necesario
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SeguimientoProgresoReporte;
}