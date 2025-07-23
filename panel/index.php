<?php
// Configuración de la página
$page_title = 'Panel Principal - Gestor de Finanzas';
$page_description = 'Dashboard principal para administrar tus finanzas personales';
$page_type = 'website';
$base_path = '../';

// Breadcrumbs
$breadcrumbs = [
    ['name' => 'Inicio', 'url' => '../index.php'],
    ['name' => 'Panel', 'url' => 'index.php']
];

// Content específico para el panel
$additional_head_content = '
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js" integrity="sha384-H2JwB8HyNdAyp5JqddDm3xvYBZzJOmCU2JYtOpF9DRebB5ADTP7J+UcnyWJJFZqP" crossorigin="anonymous"></script>
    
    <!-- Date picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
';

// Incluir head
include '../includes/head.php';
?>

<div class="app-container">
    <!-- Header -->
    <header class="app-header">
        <h1><i class="fas fa-tachometer-alt"></i> Mi Panel</h1>
        <div>
            <button id="userMenuBtn" class="btn" style="color: white; padding: 0.5rem; background: rgba(255,255,255,0.1); 
                                                        border-radius: 50%; width: 48px; height: 48px;" 
                    aria-label="Menú de usuario">
                <i class="fas fa-user-circle" style="font-size: 1.5rem;"></i>
            </button>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="app-content" id="main-content">
        <!-- Saludo al Usuario -->
        <div class="card animate-fade-in">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h2 id="userGreeting" class="text-white" style="margin-bottom: 0.5rem;">¡Hola, Usuario!</h2>
                        <p class="card-text mb-0" id="currentDate" style="font-size: 0.95rem;"></p>
                    </div>
                    <div class="weather-widget" style="text-align: right; opacity: 0.8;">
                        <i class="fas fa-calendar-alt text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Balance -->
        <div class="balance-summary animate-slide-up">
            <div class="balance-card">
                <i class="fas fa-wallet" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.7;"></i>
                <div class="balance-amount" id="totalBalance">$0</div>
                <div class="balance-label">Balance Total</div>
                <div style="margin-top: 0.5rem; font-size: 0.8rem; opacity: 0.8;">
                    <i class="fas fa-trending-up"></i> Este mes
                </div>
            </div>
            <div class="balance-card income">
                <i class="fas fa-arrow-up" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.7;"></i>
                <div class="balance-amount" id="totalIncome">$0</div>
                <div class="balance-label">Ingresos</div>
                <div style="margin-top: 0.5rem; font-size: 0.8rem; opacity: 0.8;">
                    <i class="fas fa-plus-circle"></i> Total
                </div>
            </div>
            <div class="balance-card expense">
                <i class="fas fa-arrow-down" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.7;"></i>
                <div class="balance-amount" id="totalExpense">$0</div>
                <div class="balance-label">Gastos</div>
                <div style="margin-top: 0.5rem; font-size: 0.8rem; opacity: 0.8;">
                    <i class="fas fa-minus-circle"></i> Total
                </div>
            </div>
        </div>

        <!-- Filtros de Fecha -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-filter text-info"></i> Filtros de Período
                </h3>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; align-items: end;">
                    <div>
                        <label for="monthFilter" class="form-label">Mes</label>
                        <select id="monthFilter" class="form-control form-select">
                            <option value="">Todos los meses</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>
                    <div>
                        <label for="yearFilter" class="form-label">Año</label>
                        <select id="yearFilter" class="form-control form-select">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div>
                        <button id="applyFilters" class="btn btn-primary">
                            <i class="fas fa-search"></i> Aplicar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Resumen -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-chart-line text-success"></i> Tendencia Mensual
                </h3>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 300px;">
                    <canvas id="summaryChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Resumen por Categorías -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-chart-pie text-info"></i> Gastos por Categoría
                    </h3>
                    <button class="btn btn-outline-primary btn-sm" onclick="toggleCategoryView()">
                        <i class="fas fa-exchange-alt"></i> Cambiar Vista
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="categorySummary">
                    <div class="text-center" style="padding: 2rem; color: rgba(255,255,255,0.6);">
                        <i class="fas fa-chart-bar" style="font-size: 3rem; opacity: 0.5; margin-bottom: 1rem;"></i>
                        <p>Cargando datos de categorías...</p>
                    </div>
                </div>
                
                <!-- Gráfico de dona -->
                <div id="categoryChart" style="display: none; position: relative; height: 300px;">
                    <canvas id="categoryPieChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Movimientos Recientes -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-history text-primary"></i> Movimientos Recientes
                    </h3>
                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-outline-primary btn-sm" onclick="refreshMovements()">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="recentMovements">
                    <div class="text-center" style="padding: 2rem; color: rgba(255,255,255,0.6);">
                        <i class="fas fa-receipt" style="font-size: 3rem; opacity: 0.5; margin-bottom: 1rem;"></i>
                        <p>Cargando movimientos recientes...</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="movimientos/index.php" class="btn btn-outline-primary">
                        <i class="fas fa-eye"></i> Ver Todos los Movimientos
                    </a>
                </div>
            </div>
        </div>

        <!-- Objetivos de Ahorro -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-piggy-bank text-warning"></i> Objetivos de Ahorro
                    </h3>
                    <button class="btn btn-warning btn-sm" onclick="window.location.href='ahorros/agregar.php'">
                        <i class="fas fa-plus"></i> Nuevo
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="savingsGoals">
                    <div class="text-center" style="padding: 2rem; color: rgba(255,255,255,0.6);">
                        <i class="fas fa-target" style="font-size: 3rem; opacity: 0.5; margin-bottom: 1rem;"></i>
                        <p>Cargando objetivos de ahorro...</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="ahorros/index.php" class="btn btn-outline-warning">
                        <i class="fas fa-piggy-bank"></i> Gestionar Ahorros
                    </a>
                </div>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-bolt text-warning"></i> Accesos Rápidos
                </h3>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem;">
                    <a href="movimientos/agregar.php?tipo=ingreso" class="quick-action-btn btn-success">
                        <i class="fas fa-plus-circle"></i>
                        <span>Ingreso</span>
                    </a>
                    <a href="movimientos/agregar.php?tipo=egreso" class="quick-action-btn btn-danger">
                        <i class="fas fa-minus-circle"></i>
                        <span>Gasto</span>
                    </a>
                    <a href="categorias/index.php" class="quick-action-btn btn-info">
                        <i class="fas fa-tags"></i>
                        <span>Categorías</span>
                    </a>
                    <a href="estadisticas/index.php" class="quick-action-btn btn-primary">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reportes</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Botón Flotante para Agregar -->
    <button class="btn btn-primary btn-floating" id="addBtn" aria-label="Agregar movimiento">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Navegación Inferior -->
    <nav class="app-footer" role="navigation" aria-label="Navegación principal">
        <div class="bottom-nav">
            <a href="index.php" class="nav-item active" aria-current="page">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="movimientos/index.php" class="nav-item">
                <i class="fas fa-exchange-alt"></i>
                <span>Movimientos</span>
            </a>
            <a href="categorias/index.php" class="nav-item">
                <i class="fas fa-tags"></i>
                <span>Categorías</span>
            </a>
            <a href="estadisticas/index.php" class="nav-item">
                <i class="fas fa-chart-bar"></i>
                <span>Estadísticas</span>
            </a>
            <a href="ahorros/index.php" class="nav-item">
                <i class="fas fa-piggy-bank"></i>
                <span>Ahorros</span>
            </a>
        </div>
    </nav>
</div>

<!-- Modal Menu Usuario -->
<div id="userModal" class="modal" role="dialog" aria-labelledby="userModalTitle" aria-hidden="true">
    <div class="modal-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 id="userModalTitle" class="text-white"><i class="fas fa-user"></i> Mi Cuenta</h3>
            <button id="closeModal" style="background: none; border: none; font-size: 1.5rem; color: rgba(255,255,255,0.7);" 
                    aria-label="Cerrar modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="userInfo" style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">
            <p><strong>Email:</strong> <span id="userEmail">-</span></p>
            <p><strong>Nombre:</strong> <span id="userName">-</span></p>
            <p><strong>Miembro desde:</strong> <span id="memberSince">-</span></p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <button class="btn btn-outline-primary" onclick="exportData()">
                <i class="fas fa-download"></i> Exportar Datos
            </button>
            <button class="btn btn-outline-primary" onclick="toggleDarkMode()">
                <i class="fas fa-moon"></i> Modo Oscuro
            </button>
            <button class="btn btn-outline-primary" onclick="window.location.href='configuracion.php'">
                <i class="fas fa-cog"></i> Configuración
            </button>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <button class="btn btn-danger" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </div>
    </div>
</div>

<!-- Modal Agregar Movimiento Rápido -->
<div id="quickAddModal" class="modal" role="dialog" aria-labelledby="quickAddTitle" aria-hidden="true">
    <div class="modal-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 id="quickAddTitle" class="text-white"><i class="fas fa-plus"></i> Agregar Rápido</h3>
            <button id="closeQuickAdd" style="background: none; border: none; font-size: 1.5rem; color: rgba(255,255,255,0.7);" 
                    aria-label="Cerrar modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <a href="movimientos/agregar.php?tipo=ingreso" class="btn btn-success btn-lg">
                <i class="fas fa-plus-circle"></i> Agregar Ingreso
            </a>
            <a href="movimientos/agregar.php?tipo=egreso" class="btn btn-danger btn-lg">
                <i class="fas fa-minus-circle"></i> Agregar Gasto
            </a>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para el panel */
.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.5rem 1rem;
    text-decoration: none;
    border-radius: var(--border-radius-lg);
    transition: all var(--transition-base);
    background: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.9);
    border: 1px solid rgba(255,255,255,0.2);
}

.quick-action-btn:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    text-decoration: none;
    color: white;
}

.quick-action-btn.btn-success:hover {
    background: var(--success);
}

.quick-action-btn.btn-danger:hover {
    background: var(--danger);
}

.quick-action-btn.btn-info:hover {
    background: var(--info);
}

.quick-action-btn.btn-primary:hover {
    background: var(--primary);
}

.quick-action-btn i {
    font-size: 1.5rem;
}

.quick-action-btn span {
    font-size: 0.9rem;
    font-weight: 500;
}

/* Modal improvements */
.modal {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.modal-content {
    animation: slideInUp 0.3s ease-out;
}

@keyframes slideInUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Chart container */
#summaryChart {
    max-height: 300px;
}

/* Loading states */
.loading {
    position: relative;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: rgba(255,255,255,0.8);
    animation: spin 1s linear infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .balance-summary {
        grid-template-columns: 1fr;
    }
    
    .quick-action-btn {
        padding: 1rem;
    }
    
    .quick-action-btn i {
        font-size: 1.25rem;
    }
}
</style>

<?php
// Footer específico para panel
$additional_footer_content = '
<script>
// Variables globales para gráficos
let summaryChart = null;
let categoryPieChart = null;
let currentCategoryView = "list"; // "list" o "chart"

// Funciones específicas del panel
function toggleCategoryView() {
    const listView = document.getElementById("categorySummary");
    const chartView = document.getElementById("categoryChart");
    const button = document.querySelector("[onclick=\"toggleCategoryView()\"]");
    
    if (currentCategoryView === "list") {
        listView.style.display = "none";
        chartView.style.display = "block";
        button.innerHTML = \'<i class="fas fa-list"></i> Ver Lista\';
        currentCategoryView = "chart";
        loadCategoryChart();
    } else {
        listView.style.display = "block";
        chartView.style.display = "none";
        button.innerHTML = \'<i class="fas fa-chart-pie"></i> Ver Gráfico\';
        currentCategoryView = "list";
    }
}

function refreshMovements() {
    const button = document.querySelector("[onclick=\"refreshMovements()\"]");
    const icon = button.querySelector("i");
    
    icon.classList.add("fa-spin");
    
    // Simular carga
    setTimeout(() => {
        icon.classList.remove("fa-spin");
        financeManager.loadDashboardData();
    }, 1000);
}

function loadCategoryChart() {
    const ctx = document.getElementById("categoryPieChart");
    if (!ctx) return;
    
    if (categoryPieChart) {
        categoryPieChart.destroy();
    }
    
    // Datos demo para el gráfico
    const data = {
        labels: ["Comida", "Servicios", "Transporte", "Entretenimiento", "Otros"],
        datasets: [{
            data: [8500, 12000, 3500, 2000, 1500],
            backgroundColor: [
                "rgba(255, 99, 132, 0.8)",
                "rgba(54, 162, 235, 0.8)",
                "rgba(255, 205, 86, 0.8)",
                "rgba(75, 192, 192, 0.8)",
                "rgba(153, 102, 255, 0.8)"
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 205, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)"
            ],
            borderWidth: 2
        }]
    };
    
    categoryPieChart = new Chart(ctx, {
        type: "doughnut",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                    labels: {
                        color: "rgba(255,255,255,0.8)",
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
}

function loadSummaryChart() {
    const ctx = document.getElementById("summaryChart");
    if (!ctx) return;
    
    if (summaryChart) {
        summaryChart.destroy();
    }
    
    // Datos demo para el gráfico
    const data = {
        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun"],
        datasets: [
            {
                label: "Ingresos",
                data: [45000, 42000, 48000, 45000, 47000, 50000],
                borderColor: "rgba(75, 192, 192, 1)",
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                tension: 0.4
            },
            {
                label: "Gastos",
                data: [32500, 35000, 31000, 33000, 34500, 32000],
                borderColor: "rgba(255, 99, 132, 1)",
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                tension: 0.4
            }
        ]
    };
    
    summaryChart = new Chart(ctx, {
        type: "line",
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: "rgba(255,255,255,0.8)"
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "rgba(255,255,255,0.8)",
                        callback: function(value) {
                            return "$" + value.toLocaleString("es-AR");
                        }
                    },
                    grid: {
                        color: "rgba(255,255,255,0.1)"
                    }
                },
                x: {
                    ticks: {
                        color: "rgba(255,255,255,0.8)"
                    },
                    grid: {
                        color: "rgba(255,255,255,0.1)"
                    }
                }
            }
        }
    });
}

// Cargar gráficos cuando se carga la página
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        loadSummaryChart();
    }, 1000);
});

// Funciones globales
window.toggleCategoryView = toggleCategoryView;
window.refreshMovements = refreshMovements;

// Announce page changes for screen readers
if (typeof announcePageChange === "function") {
    announcePageChange("Panel principal cargado");
}
</script>';

include '../includes/footer.php';
?>