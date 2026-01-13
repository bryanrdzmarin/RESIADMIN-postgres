<x-layouts.app >
    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 mb-4">
        <!-- Tarjeta: Residencias -->
        <div class="rounded-xl p-4 shadow-md text-white bg-blue-600 flex items-center gap-4 transition duration-200 hover:brightness-110">
            <div class="bg-white text-blue-600 p-3 rounded-full flex items-center justify-center w-14 h-14">
                <i class="fa-solid fa-building fa-xl"></i>
            </div>
            <div class="flex flex-col items-center justify-center h-full text-center flex-1">
                <p class="text-sm font-medium">Residencias</p>
                <p class="text-3xl font-bold leading-tight">{{ $totalResidencias }}</p>
            </div>
        </div>

        <!-- Tarjeta: Aptos -->
        <div class="rounded-xl p-4 shadow-md text-white bg-purple-600 flex items-center gap-4 transition duration-200 hover:brightness-110">
            <div class="bg-white text-purple-600 p-3 rounded-full flex items-center justify-center w-14 h-14">
                <i class="fa-solid fa-door-open fa-xl"></i>
            </div>
            <div class="flex flex-col items-center justify-center h-full text-center flex-1">
                <p class="text-sm font-medium">Aptos</p>
                <p class="text-3xl font-bold leading-tight">{{ $totalAptos }}</p>
            </div>
        </div>

        <!-- Tarjeta: Becados -->
        <div class="rounded-xl p-4 shadow-md text-white bg-emerald-600 flex items-center gap-4 transition duration-200 hover:brightness-110">
            <div class="bg-white text-emerald-600 p-3 rounded-full flex items-center justify-center w-14 h-14">
                <i class="fa-solid fa-users fa-xl"></i>
            </div>
            <div class="flex flex-col items-center justify-center h-full text-center flex-1">
                <p class="text-sm font-medium">Becados</p>
                <p class="text-3xl font-bold leading-tight">{{ $totalBecados }}</p>
            </div>
        </div>

        <!-- Tarjeta: Nacionales -->
        <div class="rounded-xl p-4 shadow-md text-white bg-cyan-700 flex items-center gap-4 transition duration-200 hover:brightness-110">
            <div class="bg-white text-cyan-700 p-3 rounded-full flex items-center justify-center w-14 h-14">
                <i class="fa-solid fa-flag fa-xl"></i>
            </div>
            <div class="flex flex-col items-center justify-center h-full text-center flex-1">
                <p class="text-sm font-medium">Nacionales</p>
                <p class="text-3xl font-bold leading-tight">{{ $totalNacionales }}</p>
            </div>
        </div>

        <!-- Tarjeta: Extranjeros -->
        <div class="rounded-xl p-4 shadow-md text-white bg-orange-600 flex items-center gap-4 transition duration-200 hover:brightness-110">
            <div class="bg-white text-orange-600 p-3 rounded-full flex items-center justify-center w-14 h-14">
                <i class="fa-solid fa-globe fa-xl"></i>
            </div>
            <div class="flex flex-col items-center justify-center h-full text-center flex-1">
                <p class="text-sm font-medium">Extranjeros</p>
                <p class="text-3xl font-bold leading-tight">{{ $totalExtranjeros }}</p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

        <!-- Gráfico 1: Estado de Residencias -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Estado de Residencias</h2>
            <canvas id="graficoResidencias" class="w-full h-30"></canvas> 
        </div>

        <!-- Gráfico 2: Estado de Aptos -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Estado de Aptos</h2>
        <canvas id="graficoAptos" class="w-full h-30"></canvas>
        </div>

    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Becados</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <!-- Gráfico 1: Becados Nacionales vs Extranjeros -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 overflow-visible" style="height: 350px; display: flex; flex-direction: column; justify-content: center;">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Nacionales vs Extranjeros</h3>
                <canvas id="graficoBecadosOrigen"></canvas>
            </div>
            <!-- Gráfico 2: Becados por Año Académico -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4" style="height: 350px; display: flex; flex-direction: column; align-items: center;">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Becados por Año Académico</h3>
                <canvas id="graficoBecadosAnio"></canvas>
            </div>

        </div>

        <!-- Segunda fila: Gráfico completo -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 mb-4 md:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Cantidad de Becados por Carrera</h3>
            <canvas id="graficoBecadosCarrera" class="w-full h-48"></canvas>
        </div>

        <!-- Tercera fila: Dos gráficos mitad y mitad -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Gráfico 4: Becados Nacionales por Carrera -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Nacionales por Carrera</h3>
                <canvas id="graficoBecadosNacionales" class="w-full h-40"></canvas>
            </div>

            <!-- Gráfico 5: Becados Extranjeros por Carrera -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Extranjeros por Carrera</h3>
                <canvas id="graficoBecadosExtranjeros" class="w-full h-40"></canvas>
            </div>

        </div>

    </div>

    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-6 mb-8">
        <!-- Título principal -->
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Evaluaciones</h1>
      
        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 mb-2">
            <!-- Subtítulo: Residencias -->
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-2">Residencias</h2>

            <div class="flex flex-wrap gap-4">

                <!-- Gráfico 7: Residencias evaluadas y no evaluadas -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3"> Evaluadas vs No Evaluadas</h3>
                    <canvas id="graficoResidenciasGlobal" class="h-[220px]"></canvas>
                </div>

                <!-- Gráfico 8: Evaluaciones Registradas de las residencias -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluaciones Registradas</h3>
                    <canvas id="graficoResidenciasDetalle" class="h-[220px]"></canvas>
                </div>
            </div>
        </div>
        
       <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 mb-2">

            <!-- Subtítulo: Aptos -->
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-2">Aptos</h2>

            <div class="flex flex-wrap gap-4">
                <!-- Gráfico 9: Aptos evaluadas y no evaluadas -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3"> Evaluados vs No Evaluados</h3>
                    <canvas id="graficoAptosGlobal" class="h-[220px]"></canvas>
                </div>

                <!-- Gráfico 10: Evaluaciones Registradas de los aptos -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluaciones Registradas</h3>
                    <canvas id="graficoAptosDetalle" class="h-[220px]"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 mb-2">

            <!-- Subtítulo: Becados -->
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-2">Becados</h2>

            <div class="flex flex-wrap gap-4">
                <!-- Gráfico 11: Becados evaluados y no evaluados -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3"> Evaluados vs No Evaluados</h3>
                    <canvas id="graficoBecadosGlobal" class="h-[220px]"></canvas>
                </div>

                <!-- Gráfico 12: Evaluaciones Registradas de los becados -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluaciones Registradas</h3>
                    <canvas id="graficoBecadosDetalle" class="h-[220px]"></canvas>
                </div>

                <div class="w-full max-w-7xl mx-auto">
                    <h3 class="text-lg font-medium text-gray-600 dark:text-white mb-2">Becados Nacionales</h3>

                    <div class="flex flex-wrap gap-4">
                         <!-- Gráfico 13: Becados nacionales evaluados y no evaluados -->
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluados vs No Evaluados</h3>
                            <canvas id="graficoBecadosNacionalesGlobal" class="h-[220px]"></canvas>
                        </div>

                        <!-- Gráfico 14: Evaluaciones Registradas de los becados nacionales-->
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluaciones Registradas</h3>
                            <canvas id="graficoBecadosNacionalesDetalle" class="h-[220px]"></canvas>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-7xl mx-auto">
                    <h3 class="text-lg font-medium text-gray-600 dark:text-white mb-2">Becados Extranjeros</h3>

                    <div class="flex flex-wrap gap-4">
                         <!-- Gráfico 15: Becados extranjeros evaluados y no evaluados -->
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluados vs No Evaluados</h3>
                            <canvas id="graficoBecadosExtranjerosGlobal" class="h-[220px]"></canvas>
                        </div>

                        <!-- Gráfico 16: Evaluaciones Registradas de los becados extranjeros-->
                        <div class="bg-white dark:bg-neutral-800 rounded-xl shadow p-4 flex-1 min-w-[300px] h-[320px]">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Evaluaciones Registradas</h3>
                            <canvas id="graficoBecadosExtranjerosDetalle" class="h-[220px]"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('js')
        <script type="module">

            // Gráfico 1: Estado de Residencias
            const ctx = document.getElementById('graficoResidencias').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Vacías', 'Ocupadas', 'Disponibles'],
                    datasets: [{
                        data: [{{ $residenciasVacias }}, {{ $residenciasOcupadas }}, {{ $residenciasDisponibles }}],
                        backgroundColor: ['#f87171', '#10b981', '#60a5fa'], // red-400, emerald-500, blue-400
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 2: Estado de Aptos
            const ctxApto = document.getElementById('graficoAptos').getContext('2d');
            new Chart(ctxApto, {
                type: 'pie',
                data: {
                    labels: ['Vacíos', 'Ocupados', 'Disponibles'],
                    datasets: [{
                        data: [{{ $aptosVacios }}, {{ $aptosOcupados }}, {{ $aptosDisponibles }}],
                        backgroundColor: ['#f87171', '#10b981', '#60a5fa'], // same colors
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 2: Becados Nacionales vs Extranjeros
            const ctxBecadosOrigen = document.getElementById('graficoBecadosOrigen').getContext('2d');
            new Chart(ctxBecadosOrigen, {
                        type: 'pie',
                        data: {
                            labels: ['Nacionales', 'Extranjeros'],
                            datasets: [{
                                data: [{{ $totalNacionales }}, {{ $totalExtranjeros }}],
                                backgroundColor: ['#10b981', '#60a5fa'], // verde y azul
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Permite modificar tamaño
                            layout: { padding: 5 },
                            animation: { duration: 800 },
                            plugins: {
                                legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 11 }, // Reduce el tamaño del texto
                            boxWidth: 12, // Reduce el tamaño del cuadro de color
                            padding: 2 // Menos espacio interno
                        }
                    },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $totalBecados }};
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 3: Becados por Año Académico
            const ctxBecadosAnio = document.getElementById('graficoBecadosAnio').getContext('2d');
            new Chart(ctxBecadosAnio, {
                type: 'bar',
                data: {
                    labels: ['Primero', 'Segundo', 'Tercero', 'Cuarto'],
                    datasets: [{
                        label: 'Cantidad de Becados',
                        data: [
                            {{ $becadosPorAnio->primero }},
                            {{ $becadosPorAnio->segundo }},
                            {{ $becadosPorAnio->tercero }},
                            {{ $becadosPorAnio->cuarto }}
                        ],
                        backgroundColor: ['#f87171', '#facc15', '#10b981', '#60a5fa'], // rojo, amarillo, verde, azul
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $totalBecados }};
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#4b5563', font: { size: 14 } }
                        },
                        x: {
                            ticks: { color: '#4b5563', font: { size: 14 } }
                        }
                    }
                }
            });

            // Generar colores aleatorios para cada barra
            function generarColores(cantidad) {
                const colores = ['#f87171', '#facc15', '#10b981', '#60a5fa', '#a855f7', '#ef4444', '#6366f1', '#14b8a6', '#ec4899'];
                return colores.slice(0, cantidad);
            }

            // Gráfico 4: Becados por Carrera (todas las carreras)
            const ctxBecadosCarrera = document.getElementById('graficoBecadosCarrera').getContext('2d');
            new Chart(ctxBecadosCarrera, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosPorCarrera as $carrera) "{{ $carrera->carrera }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Becados',
                        data: [
                            @foreach ($becadosPorCarrera as $carrera) {{ $carrera->total }}, @endforeach
                        ],
                        backgroundColor: generarColores({{ $becadosPorCarrera->count() }}),
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    return `${context.label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: { ticks: { color: '#4b5563' } }
                    }
                }
            });

            // Gráfico 5: Becados Nacionales por Carrera
            const ctxBecadosNacionales = document.getElementById('graficoBecadosNacionales').getContext('2d');
            new Chart(ctxBecadosNacionales, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosNacionalesPorCarrera as $carrera) "{{ $carrera->carrera }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Becados Nacionales',
                        data: [
                            @foreach ($becadosNacionalesPorCarrera as $carrera) {{ $carrera->total }}, @endforeach
                        ],
                        backgroundColor: generarColores({{ $becadosNacionalesPorCarrera->count() }}),
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    return `${context.label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: { ticks: { color: '#4b5563' } }
                    }
                }
            });

            // Gráfico 6: Becados Extranjeros por Carrera
            const ctxBecadosExtranjeros = document.getElementById('graficoBecadosExtranjeros').getContext('2d');
            new Chart(ctxBecadosExtranjeros, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosExtranjerosPorCarrera as $carrera) "{{ $carrera->carrera }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Becados Extranjeros',
                        data: [
                            @foreach ($becadosExtranjerosPorCarrera as $carrera) {{ $carrera->total }}, @endforeach
                        ],
                        backgroundColor: generarColores({{ $becadosExtranjerosPorCarrera->count() }}),
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    return `${context.label}: ${value}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: { ticks: { color: '#4b5563' } }
                    }
                }
            });

            // Gráfico 7: Residencias evaluadas y no evaluadas
            const ctxResidenciasGlobal = document.getElementById('graficoResidenciasGlobal').getContext('2d');
            new Chart(ctxResidenciasGlobal, {
                type: 'pie',
                data: {
                    labels: ['Evaluadas', 'No Evaluadas'],
                    datasets: [{
                        data: [{{ $residenciasEvaluadas }}, {{ $residenciasNoEvaluadas }}],
                        backgroundColor: ['#10b981', '#ef4444'], // verde, rojo
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2, // Cuanto más grande el número, más ancho y bajo queda


                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 8: Distribucion de las evaluaciones de las residencias
            const ctxResidenciasDetalle = document.getElementById('graficoResidenciasDetalle').getContext('2d');
            new Chart(ctxResidenciasDetalle, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($residenciasEvaluacionDetalle as $eval) "{{ $eval->evaluacion }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Evaluaciones',
                        data: [
                            @foreach ($residenciasEvaluacionDetalle as $eval) {{ $eval->total }}, @endforeach
                        ],
                        backgroundColor: ['#ef4444', '#facc15', '#10b981', '#60a5fa'], // Rojo, amarillo, verde, azul
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        bottom: 25
                    }
                },



                    plugins: {
                        legend: { display: false }, // Oculta la leyenda
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $residenciasEvaluadas }};
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },


                    scales: {
                        y: { beginAtZero: true },
                        x: { ticks: { color: '#4b5563', font: { size: 12 } } }
                    }
                }
            });

            // Gráfico 9: Aptos evaluadas y no evaluadas 
            const ctxAptosGlobal = document.getElementById('graficoAptosGlobal').getContext('2d');
            new Chart(ctxAptosGlobal, {
                type: 'pie',
                data: {
                    labels: ['Evaluados', 'No Evaluados'],
                    datasets: [{
                        data: [{{ $aptosEvaluados }}, {{ $aptosNoEvaluados }}],
                        backgroundColor: ['#10b981', '#ef4444'], // verde, rojo
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2, // Cuanto más grande, más bajo y ancho queda

                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 10: Evaluaciones Registradas de los aptos 
            const ctxAptosDetalle = document.getElementById('graficoAptosDetalle').getContext('2d');
            new Chart(ctxAptosDetalle, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($aptosEvaluacionDetalle as $eval) "{{ $eval->evaluacion }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Evaluaciones',
                        data: [
                            @foreach ($aptosEvaluacionDetalle as $eval) {{ $eval->total }}, @endforeach
                        ],
                        backgroundColor: ['#ef4444', '#facc15', '#10b981', '#60a5fa'], // Rojo, amarillo, verde, azul
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            bottom: 25
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $aptosEvaluados }};
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: {
                            ticks: {
                                color: '#4b5563',
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });

            // Gráfico 11: Becados evaluados y no evaluados 
            const ctxBecadosGlobal = document.getElementById('graficoBecadosGlobal').getContext('2d');
            new Chart(ctxBecadosGlobal, {
                type: 'pie',
                data: {
                    labels: ['Evaluados', 'No Evaluados'],
                    datasets: [{
                        data: [{{ $becadosEvaluados }}, {{ $becadosNoEvaluados }}],
                        backgroundColor: ['#10b981', '#ef4444'], // verde, rojo
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,

                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 12: Evaluaciones Registradas de los becados 
            const ctxBecadosDetalle = document.getElementById('graficoBecadosDetalle').getContext('2d');
            new Chart(ctxBecadosDetalle, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosEvaluacionDetalle as $eval) "{{ $eval->evaluacion_final }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Evaluaciones',
                        data: [
                            @foreach ($becadosEvaluacionDetalle as $eval) {{ $eval->total }}, @endforeach
                        ],
                        backgroundColor: ['#ef4444', '#facc15', '#10b981', '#60a5fa'], // Colores configurables
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            bottom: 25
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $becadosEvaluados }};
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: {
                            ticks: {
                                color: '#4b5563',
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });

            // Gráfico 13: Becados nacionales evaluados y no evaluados -->
            const ctxBecadosNacionalesGlobal = document.getElementById('graficoBecadosNacionalesGlobal').getContext('2d');
            new Chart(ctxBecadosNacionalesGlobal, {
                type: 'pie',
                data: {
                    labels: ['Evaluados', 'No Evaluados'],
                    datasets: [{
                        data: [{{ $becadoNacionalEvaluados }}, {{ $becadoNacionalNoEvaluados }}],
                        backgroundColor: ['#10b981', '#ef4444'], // verde, rojo
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,

                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 14: Evaluaciones Registradas de los becados nacionales
            const ctxBecadosNacionalesDetalle = document.getElementById('graficoBecadosNacionalesDetalle').getContext('2d');
            new Chart(ctxBecadosNacionalesDetalle, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosNacionalesEvaluacionDetalle as $eval) "{{ $eval->evaluacion_final }}", @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Evaluaciones',
                        data: [
                            @foreach ($becadosNacionalesEvaluacionDetalle as $eval) {{ $eval->total }}, @endforeach
                        ],
                        backgroundColor: ['#ef4444', '#facc15', '#10b981', '#60a5fa'], // Colores personalizados
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            bottom: 25
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $becadoNacionalEvaluados }};
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: {
                            ticks: {
                                color: '#4b5563',
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });

            // Gráfico 15: Becados extranjeros evaluados y no evaluados
            const ctxBecadosExtranjerosGlobal = document.getElementById('graficoBecadosExtranjerosGlobal').getContext('2d');
            new Chart(ctxBecadosExtranjerosGlobal, {
                type: 'pie',
                data: {
                    labels: ['Evaluados', 'No Evaluados'],
                    datasets: [{
                        data: [{{ $becadoExtranjeroEvaluados }}, {{ $becadoExtranjeroNoEvaluados }}],
                        backgroundColor: ['#10b981', '#ef4444'], // verde, rojo
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4b5563',
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1) + '%';
                                    return `${label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico 16: Evaluaciones Registradas de los becados extranjeros
            const ctxBecadosExtranjerosDetalle = document.getElementById('graficoBecadosExtranjerosDetalle').getContext('2d');
            new Chart(ctxBecadosExtranjerosDetalle, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($becadosExtranjerosEvaluacionDetalle as $eval)
                            "{{ $eval->evaluacion_final }}",
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Cantidad de Evaluaciones',
                        data: [
                            @foreach ($becadosExtranjerosEvaluacionDetalle as $eval)
                                {{ $eval->total }},
                            @endforeach
                        ],
                        backgroundColor: ['#ef4444', '#facc15', '#10b981', '#60a5fa'], // Colores personalizados
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            bottom: 25
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = {{ $becadoExtranjeroEvaluados }};
                                    const percentage = ((value / total) * 100).toFixed(2) + '%';
                                    return `${context.label}: ${value} (${percentage})`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true },
                        x: {
                            ticks: {
                                color: '#4b5563',
                                font: { size: 12 }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.app>
