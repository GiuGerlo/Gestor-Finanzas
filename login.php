<?php
// Configuración de la página
$page_title = 'Iniciar Sesión - Gestor de Finanzas';
$page_description = 'Accede a tu cuenta de Gestor de Finanzas para administrar tus ingresos y gastos';
$page_type = 'website';
$base_path = '';

// Breadcrumbs
$breadcrumbs = [
    ['name' => 'Inicio', 'url' => 'index.php'],
    ['name' => 'Iniciar Sesión', 'url' => 'login.php']
];

// Incluir head
include 'includes/head.php';
?>

<div class="app-container">
    <!-- Header -->
    <header class="app-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="index.php" class="btn" style="color: white; padding: 0.5rem; text-decoration: none;" 
               aria-label="Volver al inicio">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h1>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="app-content" id="main-content">
        <!-- Formulario de Login -->
        <div class="form-container animate-fade-in">
            <div class="card">
                <div class="card-body">
                    <!-- Logo/Icono -->
                    <div class="text-center mb-4">
                        <div style="background: var(--primary); width: 80px; height: 80px; border-radius: 50%; 
                                    display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                            <i class="fas fa-user-circle text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="text-white" style="font-size: 1.8rem; margin-bottom: 0.5rem;">Bienvenido de vuelta</h2>
                        <p class="card-text">Ingresa a tu cuenta para continuar administrando tus finanzas</p>
                    </div>

                    <!-- Formulario -->
                    <form id="loginForm" novalidate>
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Correo Electrónico
                            </label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="ejemplo@correo.com" required autocomplete="email"
                                   aria-describedby="email-error">
                            <div id="email-error" class="invalid-feedback" style="display: none;"></div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Contraseña
                            </label>
                            <div style="position: relative;">
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Tu contraseña" required autocomplete="current-password"
                                       aria-describedby="password-error">
                                <button type="button" id="togglePassword" 
                                        style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); 
                                               background: none; border: none; color: rgba(255,255,255,0.7); cursor: pointer;"
                                        aria-label="Mostrar/ocultar contraseña">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="password-error" class="invalid-feedback" style="display: none;"></div>
                        </div>

                        <!-- Recordar sesión -->
                        <div class="form-group">
                            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; 
                                          color: rgba(255,255,255,0.9);">
                                <input type="checkbox" id="rememberMe" name="rememberMe" checked
                                       style="width: 18px; height: 18px; cursor: pointer;">
                                <span>Recordar mi sesión en este dispositivo</span>
                            </label>
                        </div>

                        <!-- Mensaje de error/éxito -->
                        <div id="errorMessage" class="alert" style="display: none; 
                             padding: 1rem; margin-bottom: 1.5rem; border-radius: var(--border-radius);
                             border: 1px solid transparent;" role="alert" aria-live="polite">
                        </div>

                        <!-- Mensaje de carga -->
                        <div id="loadingMessage" class="text-center" style="display: none; color: rgba(255,255,255,0.8);">
                            <i class="fas fa-spinner fa-spin text-primary" style="font-size: 1.2rem;"></i>
                            <span style="margin-left: 0.5rem;">Iniciando sesión...</span>
                        </div>

                        <!-- Botón de Login -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="loginBtn">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </button>
                    </form>

                    <!-- Divider -->
                    <div style="text-align: center; margin: 2rem 0; position: relative;">
                        <hr style="border: none; height: 1px; background: rgba(255,255,255,0.2);">
                        <span style="background: var(--bg-glass); padding: 0 1.5rem; 
                                     color: rgba(255,255,255,0.7); position: absolute; 
                                     top: -12px; left: 50%; transform: translateX(-50%); font-size: 0.9rem;">
                            o
                        </span>
                    </div>

                    <!-- Enlace de Registro -->
                    <div class="text-center">
                        <p style="color: rgba(255,255,255,0.8); margin-bottom: 1rem;">¿No tienes cuenta?</p>
                        <a href="registro.php" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-user-plus"></i> Crear Cuenta Nueva
                        </a>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center" style="margin-top: 1.5rem;">
                        <a href="recuperar-password.php" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.9rem;">
                            <i class="fas fa-key"></i> ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </div>

            <!-- Demo/Test Account -->
            <div class="card animate-slide-up">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle text-info"></i> Cuenta de Prueba
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Para probar la aplicación sin registrarte, puedes usar la siguiente cuenta demo:
                    </p>
                    <div style="background: rgba(255,255,255,0.1); padding: 1.5rem; border-radius: var(--border-radius); 
                                backdrop-filter: blur(10px); margin-bottom: 1rem;">
                        <div style="display: grid; gap: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <strong class="text-white">Email:</strong> 
                                <code style="background: rgba(255,255,255,0.2); padding: 0.25rem 0.5rem; 
                                            border-radius: 4px; color: rgba(255,255,255,0.9);">demo@ejemplo.com</code>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <strong class="text-white">Contraseña:</strong> 
                                <code style="background: rgba(255,255,255,0.2); padding: 0.25rem 0.5rem; 
                                            border-radius: 4px; color: rgba(255,255,255,0.9);">demo123</code>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="useDemoBtn" class="btn btn-info btn-sm">
                        <i class="fas fa-magic"></i> Usar Credenciales Demo
                    </button>
                </div>
            </div>

            <!-- Información de Seguridad -->
            <div class="card animate-slide-up">
                <div class="card-body text-center">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; 
                                color: rgba(255,255,255,0.8);">
                        <i class="fas fa-shield-alt text-success" style="font-size: 1.5rem;"></i>
                        <div style="text-align: left;">
                            <strong class="text-white">Conexión Segura</strong>
                            <p class="mb-0" style="font-size: 0.9rem;">
                                Tus datos están protegidos con encriptación SSL
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
/* Estilos específicos para la página de login */
.alert {
    border-radius: var(--border-radius);
    font-weight: 500;
}

.alert.alert-danger {
    background-color: rgba(248, 215, 218, 0.9);
    color: #721c24;
    border-color: #f5c6cb;
}

.alert.alert-success {
    background-color: rgba(212, 237, 218, 0.9);
    color: #155724;
    border-color: #c3e6cb;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #ff6b6b;
}

.form-control.is-invalid {
    border-color: #ff6b6b;
    box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
}

.form-control.is-valid {
    border-color: #4ade80;
    box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
}

/* Loading state */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* Checkbox styling */
input[type="checkbox"] {
    accent-color: var(--primary-solid);
    background-color: transparent;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 4px;
}

/* Code styling */
code {
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .form-container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .btn-block {
        padding: 1rem;
        font-size: 1rem;
    }
}

/* Focus styles for accessibility */
.form-control:focus,
.btn:focus,
input[type="checkbox"]:focus {
    outline: 2px solid rgba(255,255,255,0.5);
    outline-offset: 2px;
}

/* Animation delays */
.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.3s; }
.card:nth-child(3) { animation-delay: 0.5s; }
</style>

<?php
// Footer específico para login
$additional_footer_content = '
<script>
// Form validation específica para login
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    
    // Real-time validation
    emailInput.addEventListener("blur", validateEmail);
    passwordInput.addEventListener("blur", validatePassword);
    
    function validateEmail() {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const errorDiv = document.getElementById("email-error");
        
        if (!email) {
            showFieldError(emailInput, errorDiv, "El email es requerido");
            return false;
        } else if (!emailRegex.test(email)) {
            showFieldError(emailInput, errorDiv, "Por favor ingresa un email válido");
            return false;
        } else {
            showFieldSuccess(emailInput, errorDiv);
            return true;
        }
    }
    
    function validatePassword() {
        const password = passwordInput.value;
        const errorDiv = document.getElementById("password-error");
        
        if (!password) {
            showFieldError(passwordInput, errorDiv, "La contraseña es requerida");
            return false;
        } else if (password.length < 6) {
            showFieldError(passwordInput, errorDiv, "La contraseña debe tener al menos 6 caracteres");
            return false;
        } else {
            showFieldSuccess(passwordInput, errorDiv);
            return true;
        }
    }
    
    function showFieldError(input, errorDiv, message) {
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
        errorDiv.textContent = message;
        errorDiv.style.display = "block";
    }
    
    function showFieldSuccess(input, errorDiv) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        errorDiv.style.display = "none";
    }
});

// Announce page changes for screen readers
if (typeof announcePageChange === "function") {
    announcePageChange("Página de inicio de sesión cargada");
}
</script>';

include 'includes/footer.php';
?>