<?php
// Configuración de la página
$page_title = 'Gestor de Finanzas - Administra tus finanzas personales';
$page_description = 'Aplicación web progresiva para administrar tus ingresos y gastos de manera simple y efectiva. Funciona offline y es completamente gratuita.';
$page_type = 'website';
$base_path = '';

// Incluir head
include 'includes/head.php';
?>

<div class="app-container">
    <!-- Header -->
    <header class="app-header">
        <h1><i class="fas fa-wallet"></i> Gestor de Finanzas</h1>
    </header>

    <!-- Contenido Principal -->
    <main class="app-content" id="main-content">
        <!-- Sección de Bienvenida -->
        <div class="card animate-fade-in">
            <div class="card-body text-center">
                <i class="fas fa-chart-line text-primary" style="font-size: 4rem; margin-bottom: 2rem; opacity: 0.9;"></i>
                <h2 class="card-title text-white" style="font-size: 2.5rem; margin-bottom: 1rem;">
                    ¡Bienvenido a tu Gestor de Finanzas!
                </h2>
                <p class="card-text mb-4" style="font-size: 1.1rem; line-height: 1.6;">
                    Administra tus ingresos y gastos de manera simple y efectiva. 
                    Lleva un control completo de tus finanzas personales desde tu móvil.
                </p>
                
                <!-- Botones de Acción -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 300px; margin: 0 auto;">
                    <a href="login.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                    <a href="registro.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-user-plus"></i> Crear Cuenta
                    </a>
                </div>
            </div>
        </div>

        <!-- Características Principales -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-star text-warning"></i> Características Principales
                </h3>
            </div>
            <div class="card-body">
                <div style="display: grid; gap: 2rem;">
                    <div class="feature-item">
                        <div class="transaction-icon income">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="text-white mb-2">Registro de Ingresos y Gastos</h4>
                            <p class="card-text mb-0">
                                Categoriza y organiza todos tus movimientos financieros de manera intuitiva
                            </p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="transaction-icon" style="background: var(--info);">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="text-white mb-2">Reportes y Estadísticas</h4>
                            <p class="card-text mb-0">
                                Visualiza tus finanzas con gráficos mensuales y anuales detallados
                            </p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="transaction-icon" style="background: var(--warning);">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="text-white mb-2">Objetivos de Ahorro</h4>
                            <p class="card-text mb-0">
                                Establece metas financieras y sigue tu progreso hacia ellas
                            </p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="transaction-icon" style="background: var(--secondary);">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="text-white mb-2">Funciona Sin Internet</h4>
                            <p class="card-text mb-0">
                                Accede a tus datos y agrega movimientos incluso cuando estés offline
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información PWA -->
        <div class="card animate-slide-up">
            <div class="card-body text-center">
                <i class="fas fa-download text-primary" style="font-size: 3rem; margin-bottom: 1.5rem; opacity: 0.9;"></i>
                <h4 class="card-title text-white" style="font-size: 1.5rem;">Instala la App</h4>
                <p class="card-text mb-4">
                    Agrega esta aplicación a tu pantalla de inicio para un acceso rápido 
                    y una experiencia como aplicación nativa.
                </p>
                <button id="installBtn" class="btn btn-outline-primary" style="display: none;">
                    <i class="fas fa-plus"></i> Agregar a Inicio
                </button>
                
                <!-- Instrucciones para iOS -->
                <div class="ios-install-instructions" style="margin-top: 2rem; text-align: left; display: none;">
                    <h5 class="text-white mb-3">Para instalar en iPhone/iPad:</h5>
                    <ol style="color: rgba(255,255,255,0.8); line-height: 1.6;">
                        <li>Abre este sitio en Safari</li>
                        <li>Toca el botón de compartir <i class="fas fa-share"></i></li>
                        <li>Selecciona "Agregar a pantalla de inicio"</li>
                        <li>Confirma tocando "Agregar"</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Beneficios y Seguridad -->
        <div class="card animate-slide-up">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="fas fa-shield-alt text-success"></i> Seguridad y Privacidad
                </h3>
            </div>
            <div class="card-body">
                <div style="display: grid; gap: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-lock text-success" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 class="text-white mb-1">Datos Seguros</h5>
                            <p class="card-text mb-0">Tus datos financieros están protegidos y encriptados</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-user-shield text-success" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 class="text-white mb-1">Privacidad Total</h5>
                            <p class="card-text mb-0">No compartimos tu información con terceros</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-cloud-download-alt text-success" style="font-size: 1.5rem;"></i>
                        <div>
                            <h5 class="text-white mb-1">Respaldo Automático</h5>
                            <p class="card-text mb-0">Tus datos se respaldan automáticamente en la nube</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="app-footer">
        <div style="text-align: center; padding: 2rem; color: rgba(255,255,255,0.7);">
            <p class="mb-2">
                <i class="fas fa-heart text-danger"></i> 
                Hecho con amor para ayudarte a manejar mejor tus finanzas
            </p>
            <small>Versión 1.0 - Gestor de Finanzas PWA © <?php echo date('Y'); ?></small>
        </div>
    </footer>
</div>

<style>
/* Estilos específicos para la página de inicio */
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    padding: 1rem;
    border-radius: var(--border-radius-lg);
    background: rgba(255, 255, 255, 0.05);
    transition: all var(--transition-base);
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(8px);
}

.ios-install-instructions {
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    border-left: 4px solid var(--primary-solid);
}

/* Animación de entrada escalonada */
.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .feature-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .feature-item:hover {
        transform: translateY(-4px);
    }
}
</style>

<script>
// Detectar iOS para mostrar instrucciones
if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) {
    document.querySelector('.ios-install-instructions').style.display = 'block';
}

// Animación de contadores (si se agregan métricas)
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    function updateCounter() {
        if (start < target) {
            start += increment;
            element.textContent = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    }
    
    updateCounter();
}
</script>

<?php include 'includes/footer.php'; ?>