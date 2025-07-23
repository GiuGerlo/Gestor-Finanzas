    <!-- JavaScript Principal -->
    <script src="<?php echo $base_path; ?>assets/js/main.js" defer></script>
    
    <!-- Service Worker Registration -->
    <script>
        // Register service worker for PWA functionality
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('<?php echo $base_path; ?>sw.js')
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function(err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }
    </script>
    
    <!-- Google Analytics (opcional) -->
    <?php if (defined('GA_TRACKING_ID') && GA_TRACKING_ID): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_TRACKING_ID; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo GA_TRACKING_ID; ?>', {
            'anonymize_ip': true,
            'cookie_flags': 'secure;samesite=lax'
        });
    </script>
    <?php endif; ?>
    
    <!-- Error Tracking (desarrollo) -->
    <script>
        // Global error handler para debugging
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
            // En producción, enviar errores a servicio de logging
        });
        
        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
            // En producción, enviar errores a servicio de logging
        });
    </script>
    
    <!-- Performance Monitoring -->
    <script>
        // Web Vitals monitoring
        if ('PerformanceObserver' in window) {
            // Largest Contentful Paint
            new PerformanceObserver((entryList) => {
                for (const entry of entryList.getEntries()) {
                    console.log('LCP:', entry.startTime);
                    // En producción, enviar métricas a servicio de analytics
                }
            }).observe({entryTypes: ['largest-contentful-paint']});
            
            // First Input Delay
            new PerformanceObserver((entryList) => {
                for (const entry of entryList.getEntries()) {
                    console.log('FID:', entry.processingStart - entry.startTime);
                    // En producción, enviar métricas a servicio de analytics
                }
            }).observe({entryTypes: ['first-input']});
            
            // Cumulative Layout Shift
            new PerformanceObserver((entryList) => {
                let clsValue = 0;
                for (const entry of entryList.getEntries()) {
                    if (!entry.hadRecentInput) {
                        clsValue += entry.value;
                    }
                }
                console.log('CLS:', clsValue);
                // En producción, enviar métricas a servicio de analytics
            }).observe({entryTypes: ['layout-shift']});
        }
    </script>
    
    <!-- Connectivity Status -->
    <script>
        // Monitor network status for offline functionality
        function updateOnlineStatus() {
            const status = navigator.onLine ? 'online' : 'offline';
            document.body.setAttribute('data-network-status', status);
            
            if (status === 'offline') {
                console.log('App is offline');
                // Mostrar indicator de offline
            } else {
                console.log('App is online');
                // Sincronizar datos pendientes
            }
        }
        
        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
        updateOnlineStatus(); // Check initial status
    </script>
    
    <!-- PWA Install Prompt -->
    <script>
        let deferredPrompt;
        const installButton = document.getElementById('installBtn');
        
        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('beforeinstallprompt fired');
            e.preventDefault();
            deferredPrompt = e;
            
            if (installButton) {
                installButton.style.display = 'block';
                installButton.addEventListener('click', async () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const { outcome } = await deferredPrompt.userChoice;
                        console.log(`User response to the install prompt: ${outcome}`);
                        deferredPrompt = null;
                        installButton.style.display = 'none';
                    }
                });
            }
        });
        
        window.addEventListener('appinstalled', (evt) => {
            console.log('App was installed');
            if (installButton) {
                installButton.style.display = 'none';
            }
        });
    </script>
    
    <!-- Theme Detection -->
    <script>
        // Detect and apply theme preference
        function applyTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.body.classList.add('dark-theme');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                document.body.classList.remove('dark-theme');
            }
        }
        
        // Apply theme immediately to prevent flash
        applyTheme();
        
        // Listen for theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyTheme);
    </script>
    
    <!-- Loading Screen Control -->
    <script>
        // Hide loading screen when page is fully loaded
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }
        });
        
        // Show loading screen for navigation
        function showLoading() {
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                loadingScreen.style.display = 'block';
            }
        }
        
        // Add loading screen to internal navigation
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href]');
            if (link && link.hostname === window.location.hostname && !link.hasAttribute('target')) {
                showLoading();
            }
        });
    </script>
    
    <!-- Security Enhancements -->
    <script>
        // Disable right-click context menu in production
        <?php if (defined('ENVIRONMENT') && ENVIRONMENT === 'production'): ?>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
        
        // Disable F12 and other developer shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12' || 
                (e.ctrlKey && e.shiftKey && e.key === 'I') ||
                (e.ctrlKey && e.shiftKey && e.key === 'J') ||
                (e.ctrlKey && e.key === 'U')) {
                e.preventDefault();
            }
        });
        <?php endif; ?>
        
        // Prevent console access in production
        <?php if (defined('ENVIRONMENT') && ENVIRONMENT === 'production'): ?>
        (function() {
            try {
                var $_console$$ = console.log;
                Object.defineProperty(window, "console", {
                    get: function() {
                        if ($_console$$._commandLineAPI)
                            throw "Sorry, the console is disabled.";
                        return $_console$$;
                    },
                    set: function(val) {
                        $_console$$ = val;
                    }
                });
            } catch(e) {}
        })();
        <?php endif; ?>
    </script>
    
    <!-- Cache Busting -->
    <script>
        // Check for app updates
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.ready.then(registration => {
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            // New version available
                            if (confirm('Hay una nueva versión disponible. ¿Desea actualizar?')) {
                                window.location.reload();
                            }
                        }
                    });
                });
            });
        }
    </script>
    
    <!-- Accessibility Enhancements -->
    <script>
        // Skip links for keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });
        
        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
        
        // Announce page changes for screen readers
        function announcePageChange(message) {
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.className = 'sr-only';
            announcement.textContent = message;
            document.body.appendChild(announcement);
            
            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);
        }
    </script>
    
    <!-- Lazy Loading Images -->
    <script>
        // Intersection Observer for lazy loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    </script>
    
    <!-- Memory Management -->
    <script>
        // Clean up event listeners and intervals on page unload
        window.addEventListener('beforeunload', function() {
            // Clear any intervals or timeouts
            for (let i = 1; i < 99999; i++) {
                window.clearInterval(i);
                window.clearTimeout(i);
            }
        });
    </script>
    
    <!-- Debug Information (solo en desarrollo) -->
    <?php if (defined('ENVIRONMENT') && ENVIRONMENT === 'development'): ?>
    <script>
        console.log('🚀 Gestor de Finanzas - Desarrollo');
        console.log('📱 PWA Status:', 'serviceWorker' in navigator ? 'Supported' : 'Not Supported');
        console.log('🔄 Version:', '1.0.0');
        console.log('⚡ Build:', '<?php echo date('Y-m-d H:i:s'); ?>');
        
        // Performance timing
        window.addEventListener('load', function() {
            setTimeout(function() {
                const perfData = performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                console.log('⏱️ Page Load Time:', pageLoadTime + 'ms');
            }, 0);
        });
    </script>
    <?php endif; ?>
    
    <?php
    // Footer específico para diferentes páginas
    if (isset($additional_footer_content)) {
        echo $additional_footer_content;
    }
    ?>
    
    <!-- Structured Data para breadcrumbs -->
    <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            <?php foreach ($breadcrumbs as $index => $crumb): ?>
            {
                "@type": "ListItem",
                "position": <?php echo $index + 1; ?>,
                "name": "<?php echo htmlspecialchars($crumb['name']); ?>",
                "item": "<?php echo htmlspecialchars($crumb['url']); ?>"
            }<?php if ($index < count($breadcrumbs) - 1) echo ','; ?>
            <?php endforeach; ?>
        ]
    }
    </script>
    <?php endif; ?>
    
</body>
</html>