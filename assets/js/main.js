/*
 * Gestor de Finanzas - JavaScript Principal
 * Funcionalidades PWA y gestión de finanzas
 */

class FinanceManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupPWA();
        this.setupEventListeners();
        this.checkAuthStatus();
        this.initializeAnimations();
    }

    // ===================================
    // PWA FUNCTIONALITY
    // ===================================
    
    setupPWA() {
        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('sw.js')
                    .then((registration) => {
                        console.log('SW registered: ', registration);
                    })
                    .catch((registrationError) => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }

        // PWA Installation
        this.setupPWAInstall();
    }

    setupPWAInstall() {
        let deferredPrompt;
        const installBtn = document.getElementById('installBtn');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            if (installBtn) {
                installBtn.style.display = 'inline-block';
            }
        });

        if (installBtn) {
            installBtn.addEventListener('click', async () => {
                if (deferredPrompt) {
                    deferredPrompt.prompt();
                    const { outcome } = await deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        console.log('PWA installed');
                    }
                    deferredPrompt = null;
                    installBtn.style.display = 'none';
                }
            });
        }

        // Check if already installed
        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            if (installBtn) {
                installBtn.style.display = 'none';
            }
        });
    }

    // ===================================
    // EVENT LISTENERS
    // ===================================
    
    setupEventListeners() {
        // Login form
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            this.setupLoginForm();
        }

        // User menu
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userModal = document.getElementById('userModal');
        const closeModal = document.getElementById('closeModal');
        
        if (userMenuBtn && userModal) {
            userMenuBtn.addEventListener('click', () => this.showModal('userModal'));
            if (closeModal) {
                closeModal.addEventListener('click', () => this.hideModal('userModal'));
            }
        }

        // Quick add button
        const addBtn = document.getElementById('addBtn');
        const quickAddModal = document.getElementById('quickAddModal');
        const closeQuickAdd = document.getElementById('closeQuickAdd');
        
        if (addBtn && quickAddModal) {
            addBtn.addEventListener('click', () => this.showModal('quickAddModal'));
            if (closeQuickAdd) {
                closeQuickAdd.addEventListener('click', () => this.hideModal('quickAddModal'));
            }
        }

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                this.hideModal(e.target.id);
            }
        });

        // Date filters
        const monthFilter = document.getElementById('monthFilter');
        const yearFilter = document.getElementById('yearFilter');
        
        if (monthFilter) {
            monthFilter.addEventListener('change', () => this.loadDashboardData());
        }
        if (yearFilter) {
            yearFilter.addEventListener('change', () => this.loadDashboardData());
        }

        // Demo button
        const useDemoBtn = document.getElementById('useDemoBtn');
        if (useDemoBtn) {
            useDemoBtn.addEventListener('click', () => this.useDemoCredentials());
        }
    }

    // ===================================
    // AUTHENTICATION
    // ===================================
    
    checkAuthStatus() {
        const token = localStorage.getItem('auth_token');
        const user = localStorage.getItem('user_data');
        
        // If on login page and already authenticated, redirect to panel
        if (window.location.pathname.includes('login') && token && user) {
            window.location.href = 'panel/index.php';
            return;
        }
        
        // If on panel and not authenticated, redirect to login
        if (window.location.pathname.includes('panel') && (!token || !user)) {
            window.location.href = '../login.php';
            return;
        }

        // If on index and authenticated, redirect to panel
        if (window.location.pathname.includes('index') && token && user && !window.location.pathname.includes('panel')) {
            window.location.href = 'panel/index.php';
            return;
        }

        // Initialize user data if on panel
        if (window.location.pathname.includes('panel') && token && user) {
            this.initializeUserData();
        }
    }

    initializeUserData() {
        try {
            const userData = JSON.parse(localStorage.getItem('user_data'));
            if (userData) {
                // Set user greeting
                const userGreeting = document.getElementById('userGreeting');
                if (userGreeting) {
                    userGreeting.textContent = `¡Hola, ${userData.nombre}!`;
                }

                // Set user info in modal
                const userEmail = document.getElementById('userEmail');
                const userName = document.getElementById('userName');
                if (userEmail) userEmail.textContent = userData.email;
                if (userName) userName.textContent = userData.nombre;
            }

            // Set current date
            this.setCurrentDate();
            
            // Set current month/year in filters
            this.setDefaultFilters();
            
            // Load dashboard data
            this.loadDashboardData();
            
        } catch (error) {
            console.error('Error initializing user data:', error);
            this.logout();
        }
    }

    setCurrentDate() {
        const currentDate = document.getElementById('currentDate');
        if (currentDate) {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            currentDate.textContent = now.toLocaleDateString('es-ES', options);
        }
    }

    setDefaultFilters() {
        const now = new Date();
        const monthFilter = document.getElementById('monthFilter');
        const yearFilter = document.getElementById('yearFilter');
        
        if (monthFilter) {
            monthFilter.value = now.getMonth() + 1;
        }
        if (yearFilter) {
            yearFilter.value = now.getFullYear();
        }
    }

    setupLoginForm() {
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const rememberMe = document.getElementById('rememberMe');

        // Toggle password visibility
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = togglePassword.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            });
        }

        // Handle form submission
        if (loginForm) {
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const email = emailInput?.value.trim();
                const password = passwordInput?.value;
                const remember = rememberMe?.checked || false;

                if (!email || !password) {
                    this.showError('Por favor completa todos los campos');
                    return;
                }

                if (!this.isValidEmail(email)) {
                    this.showError('Por favor ingresa un email válido');
                    return;
                }

                await this.handleLogin(email, password, remember);
            });
        }
    }

    async handleLogin(email, password, remember) {
        this.showLoading(true);
        this.hideError();

        try {
            // API Call to login endpoint
            const response = await fetch('api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                    remember: remember
                })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Store authentication data
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('user_data', JSON.stringify(data.user));
                
                if (remember) {
                    localStorage.setItem('remember_login', 'true');
                }

                // Show success message briefly
                this.showSuccess('¡Bienvenido! Redirigiendo...');
                
                // Redirect to panel
                setTimeout(() => {
                    window.location.href = 'panel/index.php';
                }, 1000);

            } else {
                // Handle login errors
                const errorMsg = data.message || 'Error al iniciar sesión. Verifica tus credenciales.';
                this.showError(errorMsg);
            }

        } catch (error) {
            console.error('Login error:', error);
            
            // For demo purposes, simulate successful login with demo credentials
            if (email === 'demo@ejemplo.com' && password === 'demo123') {
                this.simulateDemoLogin(remember);
            } else {
                this.showError('Error de conexión. Por favor intenta nuevamente.');
            }
        } finally {
            this.showLoading(false);
        }
    }

    simulateDemoLogin(remember) {
        const demoUser = {
            id: 1,
            email: 'demo@ejemplo.com',
            nombre: 'Usuario Demo'
        };
        const demoToken = 'demo_token_' + Date.now();

        localStorage.setItem('auth_token', demoToken);
        localStorage.setItem('user_data', JSON.stringify(demoUser));
        
        if (remember) {
            localStorage.setItem('remember_login', 'true');
        }

        this.showSuccess('¡Bienvenido! Redirigiendo...');
        setTimeout(() => {
            window.location.href = 'panel/index.php';
        }, 1000);
    }

    useDemoCredentials() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        if (emailInput && passwordInput) {
            emailInput.value = 'demo@ejemplo.com';
            passwordInput.value = 'demo123';
            emailInput.focus();
        }
    }

    logout() {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_data');
        localStorage.removeItem('remember_login');
        window.location.href = '../login.php';
    }

    // ===================================
    // DASHBOARD DATA LOADING
    // ===================================
    
    async loadDashboardData() {
        const monthFilter = document.getElementById('monthFilter');
        const yearFilter = document.getElementById('yearFilter');
        
        const month = monthFilter?.value || '';
        const year = yearFilter?.value || new Date().getFullYear();

        try {
            // Load balance summary
            await this.loadBalanceSummary(month, year);
            
            // Load category summary
            await this.loadCategorySummary(month, year);
            
            // Load recent movements
            await this.loadRecentMovements();
            
            // Load savings goals
            await this.loadSavingsGoals();

        } catch (error) {
            console.error('Error loading dashboard data:', error);
            // Load demo data for development
            this.loadDemoData(month, year);
        }
    }

    loadDemoData(month, year) {
        // Demo balance data
        const totalIncome = document.getElementById('totalIncome');
        const totalExpense = document.getElementById('totalExpense');
        const totalBalance = document.getElementById('totalBalance');
        
        if (totalIncome) totalIncome.textContent = '$45,000';
        if (totalExpense) totalExpense.textContent = '$32,500';
        if (totalBalance) totalBalance.textContent = '$12,500';

        // Demo category summary
        const categorySummary = document.getElementById('categorySummary');
        if (categorySummary) {
            categorySummary.innerHTML = `
                <div class="transaction-item">
                    <div class="transaction-icon expense">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-category">Comida</div>
                        <div class="transaction-description">8 movimientos</div>
                    </div>
                    <div class="transaction-amount expense">$8,500</div>
                </div>
                <div class="transaction-item">
                    <div class="transaction-icon expense">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-category">Servicios</div>
                        <div class="transaction-description">5 movimientos</div>
                    </div>
                    <div class="transaction-amount expense">$12,000</div>
                </div>
                <div class="transaction-item">
                    <div class="transaction-icon income">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-category">Sueldo</div>
                        <div class="transaction-description">2 movimientos</div>
                    </div>
                    <div class="transaction-amount income">$40,000</div>
                </div>
            `;
        }

        // Demo recent movements
        const recentMovements = document.getElementById('recentMovements');
        if (recentMovements) {
            recentMovements.innerHTML = `
                <div class="transaction-item">
                    <div class="transaction-icon expense">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-category">Supermercado</div>
                        <div class="transaction-description">Compras del mes</div>
                    </div>
                    <div>
                        <div class="transaction-amount expense">$3,500</div>
                        <div class="transaction-date">Hoy</div>
                    </div>
                </div>
                <div class="transaction-item">
                    <div class="transaction-icon income">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-category">Sueldo</div>
                        <div class="transaction-description">Pago mensual</div>
                    </div>
                    <div>
                        <div class="transaction-amount income">$25,000</div>
                        <div class="transaction-date">Ayer</div>
                    </div>
                </div>
            `;
        }

        // Demo savings goal
        const savingsGoals = document.getElementById('savingsGoals');
        if (savingsGoals) {
            savingsGoals.innerHTML = `
                <div class="card" style="margin-bottom: 1rem;">
                    <div class="card-body">
                        <h5 class="text-white">Vacaciones 2025</h5>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <span class="text-white">$12,500 / $50,000</span>
                            <span class="text-primary">25%</span>
                        </div>
                        <div style="width: 100%; background-color: rgba(255,255,255,0.2); border-radius: 10px; height: 8px;">
                            <div style="width: 25%; background: var(--success); height: 100%; border-radius: 10px;"></div>
                        </div>
                    </div>
                </div>
            `;
        }
    }

    // ===================================
    // UI HELPERS
    // ===================================
    
    showModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('show');
            modal.style.display = 'flex';
        }
    }

    hideModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
    }

    showError(message) {
        const errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            errorMessage.style.backgroundColor = 'rgba(248, 215, 218, 0.9)';
            errorMessage.style.color = '#721c24';
            errorMessage.style.borderColor = '#f5c6cb';
            errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    hideError() {
        const errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }

    showSuccess(message) {
        const errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            errorMessage.style.backgroundColor = 'rgba(212, 237, 218, 0.9)';
            errorMessage.style.color = '#155724';
            errorMessage.style.borderColor = '#c3e6cb';
        }
    }

    showLoading(show) {
        const loadingMessage = document.getElementById('loadingMessage');
        const loginBtn = document.getElementById('loginBtn');
        
        if (show) {
            if (loadingMessage) loadingMessage.style.display = 'block';
            if (loginBtn) {
                loginBtn.disabled = true;
                loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Iniciando...';
            }
        } else {
            if (loadingMessage) loadingMessage.style.display = 'none';
            if (loginBtn) {
                loginBtn.disabled = false;
                loginBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Iniciar Sesión';
            }
        }
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // ===================================
    // ANIMATIONS
    // ===================================
    
    initializeAnimations() {
        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                    entry.target.classList.add('animate-slide-up');
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });
    }

    // ===================================
    // USER ACTIONS
    // ===================================
    
    exportData() {
        alert('Funcionalidad de exportación en desarrollo');
    }

    toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('dark_mode', isDark);
    }

    // Apply saved dark mode
    applyDarkMode() {
        if (localStorage.getItem('dark_mode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    }
}

// Global functions for inline event handlers
window.logout = function() {
    financeManager.logout();
};

window.exportData = function() {
    financeManager.exportData();
};

window.toggleDarkMode = function() {
    financeManager.toggleDarkMode();
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.financeManager = new FinanceManager();
    
    // Apply dark mode if saved
    financeManager.applyDarkMode();
});

// ===================================
// OFFLINE FUNCTIONALITY
// ===================================

// Check online status
window.addEventListener('online', () => {
    console.log('Back online');
    // Sync any offline data
});

window.addEventListener('offline', () => {
    console.log('Gone offline');
    // Show offline indicator
});

// ===================================
// UTILITY FUNCTIONS
// ===================================

// Format currency for Argentina
function formatCurrency(amount) {
    return new Intl.NumberFormat('es-AR', {
        style: 'currency',
        currency: 'ARS'
    }).format(amount);
}

// Format date for Argentina
function formatDate(date) {
    return new Date(date).toLocaleDateString('es-AR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Generate unique ID
function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2);
}