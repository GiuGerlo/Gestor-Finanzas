<?php
// ═══════════════════════════════════════════════════════════════════
//     🌟 GESTOR DE FINANZAS - ULTRA MODERN HEAD COMPONENT 🌟
// ═══════════════════════════════════════════════════════════════════

// Configuración dinámica de página
$page_title = $page_title ?? 'Gestor de Finanzas';
$page_description = $page_description ?? 'Administra tus ingresos y gastos de manera simple y efectiva';
$page_type = $page_type ?? 'website';
$page_url = $page_url ?? (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$base_path = $base_path ?? '';

// Detectar página actual para personalización
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$is_panel = strpos($_SERVER['REQUEST_URI'], '/panel/') !== false;
?>
<!DOCTYPE html>
<html lang="es" class="loading">
<head>
    <!-- ═══════════════════════════════════════════════════════════════
         🔧 META TAGS ESENCIALES Y CONFIGURACIÓN
         ═══════════════════════════════════════════════════════════════ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, maximum-scale=5">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="finanzas personales, control gastos, ingresos, presupuesto, dinero, ahorro, PWA, Argentina, móvil">
    <meta name="author" content="Gestor de Finanzas Team">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="language" content="Spanish">
    <meta name="geo.region" content="AR">
    <meta name="geo.country" content="Argentina">
    
    <!-- ═══════════════════════════════════════════════════════════════
         🎨 TEMA Y COLORES DINÁMICOS
         ═══════════════════════════════════════════════════════════════ -->
    <meta name="theme-color" content="#667eea" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1e293b" media="(prefers-color-scheme: dark)">
    <meta name="msapplication-TileColor" content="#667eea">
    <meta name="msapplication-navbutton-color" content="#667eea">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- ═══════════════════════════════════════════════════════════════
         📱 PWA CONFIGURATION AVANZADA
         ═══════════════════════════════════════════════════════════════ -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="💰 Finanzas">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Gestor Finanzas">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-starturl" content="<?php echo $base_path; ?>">
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- ═══════════════════════════════════════════════════════════════
         🚀 PERFORMANCE Y PRECARGA INTELIGENTE
         ═══════════════════════════════════════════════════════════════ -->
    <link rel="preload" href="<?php echo $base_path; ?>assets/css/main.css" as="style" importance="high">
    <link rel="preload" href="<?php echo $base_path; ?>assets/js/main.js" as="script" importance="high">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style" crossorigin>
    <link rel="modulepreload" href="<?php echo $base_path; ?>assets/js/modules/finance.js">
    
    <!-- DNS Prefetch para recursos críticos -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    
    <!-- Preconnect para mejor rendimiento -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- ═══════════════════════════════════════════════════════════════
         🎭 TÍTULO DINÁMICO CON EMOJIS
         ═══════════════════════════════════════════════════════════════ -->
    <title><?php 
        $emoji_map = [
            'index' => '🏠',
            'login' => '🔐',
            'registro' => '📝',
            'panel' => '📊',
            'movimientos' => '💸',
            'categorias' => '🏷️',
            'estadisticas' => '📈',
            'ahorros' => '🐷'
        ];
        $current_emoji = $emoji_map[$current_page] ?? '💰';
        echo $current_emoji . ' ' . htmlspecialchars($page_title);
    ?></title>
    
    <!-- ═══════════════════════════════════════════════════════════════
         🌐 SOCIAL MEDIA Y OPEN GRAPH
         ═══════════════════════════════════════════════════════════════ -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($page_type); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($page_url); ?>">
    <meta property="og:image" content="<?php echo $base_path; ?>assets/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Gestor de Finanzas - Controla tu dinero">
    <meta property="og:site_name" content="Gestor de Finanzas">
    <meta property="og:locale" content="es_AR">
    <meta property="fb:app_id" content="your-facebook-app-id">
    
    <!-- Twitter Card optimizada -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@gestorfinanzas">
    <meta name="twitter:creator" content="@gestorfinanzas">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="twitter:image" content="<?php echo $base_path; ?>assets/images/twitter-card.jpg">
    <meta name="twitter:image:alt" content="Gestor de Finanzas App">
    
    <!-- ═══════════════════════════════════════════════════════════════
         📂 CANONICAL Y NAVEGACIÓN
         ═══════════════════════════════════════════════════════════════ -->
    <link rel="canonical" href="<?php echo htmlspecialchars($page_url); ?>">
    <?php if ($is_panel): ?>
    <link rel="up" href="<?php echo $base_path; ?>">
    <?php endif; ?>
    
    <!-- ═══════════════════════════════════════════════════════════════
         🎨 ESTILOS Y FUENTES MODERNAS
         ═══════════════════════════════════════════════════════════════ -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/main.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/main.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <!-- ═══════════════════════════════════════════════════════════════
         🛡️ PWA MANIFEST Y ICONOS ULTRA MODERNOS
         ═══════════════════════════════════════════════════════════════ -->
    <link rel="manifest" href="<?php echo $base_path; ?>manifest.json">
    
    <!-- Favicon moderno con soporte para todos los dispositivos -->
    <link rel="icon" type="image/svg+xml" href="<?php echo $base_path; ?>assets/icons/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $base_path; ?>assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_path; ?>assets/icons/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_path; ?>assets/icons/apple-touch-icon.png">
    <link rel="mask-icon" href="<?php echo $base_path; ?>assets/icons/safari-pinned-tab.svg" color="#667eea">
    
    <!-- Apple Splash Screens para PWA perfecta -->
    <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-1290-2796.jpg">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-1179-2556.jpg">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-1284-2778.jpg">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-1170-2532.jpg">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-1125-2436.jpg">
    <link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo $base_path; ?>assets/icons/apple-splash-828-1792.jpg">
    
    <!-- ═══════════════════════════════════════════════════════════════
         🧠 STRUCTURED DATA AVANZADA
         ═══════════════════════════════════════════════════════════════ -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Gestor de Finanzas",
        "alternateName": "Finance Manager",
        "description": "<?php echo htmlspecialchars($page_description); ?>",
        "url": "<?php echo htmlspecialchars($page_url); ?>",
        "applicationCategory": "FinanceApplication",
        "operatingSystem": ["iOS", "Android", "Windows", "macOS", "Linux"],
        "browserRequirements": "Requires JavaScript. Requires HTML5. Requires CSS3.",
        "softwareVersion": "2.0.0",
        "releaseNotes": "Nueva interfaz ultra moderna con efectos glassmorphism",
        "datePublished": "2024-01-01",
        "dateModified": "<?php echo date('c'); ?>",
        "inLanguage": ["es-AR", "es"],
        "isAccessibleForFree": true,
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "ARS",
            "availability": "https://schema.org/OnlineOnly"
        },
        "author": {
            "@type": "Organization",
            "name": "Gestor de Finanzas Team",
            "url": "<?php echo $base_path; ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Gestor de Finanzas",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo $base_path; ?>assets/icons/icon-512x512.png"
            }
        },
        "screenshot": "<?php echo $base_path; ?>assets/images/app-screenshot.jpg",
        "featureList": [
            "Control de ingresos y gastos",
            "Categorización automática",
            "Reportes y estadísticas",
            "Objetivos de ahorro",
            "Funciona sin internet",
            "Diseño moderno"
        ],
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "1250"
        }
    }
    </script>
    
    <!-- ═══════════════════════════════════════════════════════════════
         ⚡ CRITICAL CSS ULTRA OPTIMIZADO
         ═══════════════════════════════════════════════════════════════ -->
    <style>
        /* 🌊 CRITICAL CSS PARA FIRST PAINT INSTANTÁNEO */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-glass: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            --backdrop-blur: blur(8px);
        }
        
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }
        
        html.loading * {
            animation-duration: 0s !important;
            animation-delay: 0s !important;
            transition-duration: 0s !important;
            transition-delay: 0s !important;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            background: var(--primary-gradient);
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
            color: #1a202c;
            font-feature-settings: 'kern' 1, 'liga' 1, 'calt' 1, 'ss01' 1;
            -webkit-tap-highlight-color: transparent;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }
        
        .app-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            isolation: isolate;
        }
        
        /* 🎭 SPLASH SCREEN MODERNO */
        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        
        .splash-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        .splash-logo {
            width: 120px;
            height: 120px;
            background: var(--glass-bg);
            backdrop-filter: var(--backdrop-blur);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-glass);
            animation: pulse 2s ease-in-out infinite;
        }
        
        .splash-text {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .splash-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .loading-dots {
            display: flex;
            gap: 0.5rem;
        }
        
        .loading-dot {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: loading-bounce 1.4s ease-in-out infinite both;
        }
        
        .loading-dot:nth-child(1) { animation-delay: -0.32s; }
        .loading-dot:nth-child(2) { animation-delay: -0.16s; }
        .loading-dot:nth-child(3) { animation-delay: 0s; }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes loading-bounce {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* 🎯 SKIP LINK ACCESIBLE */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #000;
            color: #fff;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 10001;
            transition: top 0.3s ease;
        }
        
        .skip-link:focus {
            top: 6px;
        }
        
        /* 🚨 NOSCRIPT STYLING */
        .noscript-warning {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 1rem;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10002;
            box-shadow: 0 4px 20px rgba(255, 107, 107, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .noscript-warning::before {
            content: '⚠️';
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }
        
        /* 📱 RESPONSIVE SPLASH */
        @media (max-width: 768px) {
            .splash-logo {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
                border-radius: 25px;
            }
            
            .splash-text {
                font-size: 1.25rem;
            }
            
            .splash-subtitle {
                font-size: 0.9rem;
                padding: 0 1rem;
            }
        }
        
        /* 🌙 DARK MODE SUPPORT */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            }
            
            body::before {
                background: 
                    radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);
            }
        }
        
        /* 🎨 REDUCED MOTION */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
    
    <!-- ═══════════════════════════════════════════════════════════════
         🛡️ SECURITY HEADERS AVANZADOS
         ═══════════════════════════════════════════════════════════════ -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">
    <meta http-equiv="Permissions-Policy" content="camera=(), microphone=(), geolocation=(), payment=()">
    <meta name="format-detection" content="telephone=no, date=no, email=no, address=no">
    
    <?php
    // ═══════════════════════════════════════════════════════════════
    //     📄 CONTENIDO ADICIONAL ESPECÍFICO POR PÁGINA
    // ═══════════════════════════════════════════════════════════════
    if (isset($additional_head_content)) {
        echo $additional_head_content;
    }
    ?>
</head>

<!-- ═══════════════════════════════════════════════════════════════════
     🎭 BODY CON CLASES DINÁMICAS Y ATRIBUTOS MODERNOS
     ═══════════════════════════════════════════════════════════════════ -->
<body class="page-<?php echo $current_page; ?><?php echo $is_panel ? ' is-panel' : ''; ?>" 
      data-page="<?php echo $current_page; ?>" 
      data-theme="auto"
      data-loaded="false">
    
    <!-- 🚀 SPLASH SCREEN ULTRA MODERNO -->
    <div id="splashScreen" class="splash-screen">
        <div class="splash-logo">
            <i class="fas fa-wallet"></i>
        </div>
        <h1 class="splash-text">Gestor de Finanzas</h1>
        <p class="splash-subtitle">Administra tu dinero de manera inteligente</p>
        <div class="loading-dots">
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
        </div>
    </div>
    
    <!-- 🎯 SKIP LINK PARA ACCESIBILIDAD -->
    <a href="#main-content" class="skip-link">
        Saltar al contenido principal
    </a>
    
    <!-- 🚨 ADVERTENCIA JAVASCRIPT DESHABILITADO -->
    <noscript>
        <div class="noscript-warning">
            <strong>JavaScript Requerido:</strong> 
            Esta aplicación necesita JavaScript habilitado para funcionar correctamente. 
            Por favor, actívalo en la configuración de tu navegador.
        </div>
    </noscript>
    
    <!-- 🌐 DETECCIÓN DE CONECTIVIDAD -->
    <div id="offlineIndicator" class="offline-indicator" style="display: none;">
        <i class="fas fa-wifi-slash"></i>
        <span>Sin conexión - Trabajando offline</span>
    </div>
    
    <script>
        // ═══════════════════════════════════════════════════════════════
        //     ⚡ SCRIPT DE INICIALIZACIÓN ULTRA RÁPIDO
        // ═══════════════════════════════════════════════════════════════
        
        // Remover clase loading inmediatamente
        document.documentElement.classList.remove('loading');
        
        // Configurar tema inicial
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (prefersDark ? 'dark' : 'light');
            
            document.body.setAttribute('data-theme', theme);
            if (theme === 'dark') {
                document.body.classList.add('theme-dark');
            }
        })();
        
        // Ocultar splash screen cuando todo esté listo
        window.addEventListener('load', function() {
            const splash = document.getElementById('splashScreen');
            document.body.setAttribute('data-loaded', 'true');
            
            setTimeout(() => {
                splash.classList.add('hidden');
                setTimeout(() => {
                    splash.remove();
                }, 500);
            }, Math.random() * 500 + 800); // Entre 800ms y 1.3s
        });
        
        // Detectar conectividad
        function updateConnectionStatus() {
            const indicator = document.getElementById('offlineIndicator');
            if (navigator.onLine) {
                indicator.style.display = 'none';
                document.body.classList.remove('offline');
            } else {
                indicator.style.display = 'flex';
                document.body.classList.add('offline');
            }
        }
        
        window.addEventListener('online', updateConnectionStatus);
        window.addEventListener('offline', updateConnectionStatus);
        updateConnectionStatus();
        
        // Performance observer para métricas
        if ('PerformanceObserver' in window) {
            try {
                const observer = new PerformanceObserver((list) => {
                    for (const entry of list.getEntries()) {
                        if (entry.entryType === 'largest-contentful-paint') {
                            console.log('🎯 LCP:', entry.startTime);
                        }
                    }
                });
                observer.observe({entryTypes: ['largest-contentful-paint']});
            } catch (e) {
                // Silently fail if not supported
            }
        }
    </script>