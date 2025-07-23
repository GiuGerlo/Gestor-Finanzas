-- Base de datos para Gestor de Finanzas PWA
-- Creación de base de datos
CREATE DATABASE IF NOT EXISTS gestor_finanzas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestor_finanzas;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
);

-- Tabla de categorías
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('ingreso', 'egreso') NOT NULL,
    color VARCHAR(7) DEFAULT '#007bff', -- Código hex para colores
    icono VARCHAR(50) DEFAULT 'fas fa-circle', -- Clase CSS del icono (FontAwesome, Bootstrap Icons, etc)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY unique_categoria_usuario (usuario_id, nombre, tipo),
    INDEX idx_usuario_tipo (usuario_id, tipo)
);

-- Tabla de movimientos (ingresos y egresos)
CREATE TABLE movimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    tipo ENUM('ingreso', 'egreso') NOT NULL,
    monto DECIMAL(12,2) NOT NULL,
    descripcion TEXT,
    fecha DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
    INDEX idx_usuario_fecha (usuario_id, fecha),
    INDEX idx_usuario_tipo (usuario_id, tipo),
    INDEX idx_fecha (fecha)
);

-- Tabla de objetivos de ahorro
CREATE TABLE ahorros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    objetivo_nombre VARCHAR(255) NOT NULL,
    monto_objetivo DECIMAL(12,2) NOT NULL,
    monto_actual DECIMAL(12,2) DEFAULT 0.00,
    fecha_inicio DATE NOT NULL,
    fecha_objetivo DATE,
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    INDEX idx_usuario_activo (usuario_id, activo)
);

-- Insertar categorías por defecto (ejemplo para usuario ID 1)
-- INSERT INTO categorias (usuario_id, nombre, tipo, color, icono) VALUES 
-- Categorías de ingreso
-- (1, 'Sueldo', 'ingreso', '#28a745', 'fas fa-briefcase'),
-- (1, 'Freelance', 'ingreso', '#17a2b8', 'fas fa-laptop-code'),
-- (1, 'Inversiones', 'ingreso', '#6f42c1', 'fas fa-chart-line'),
-- (1, 'Bonos', 'ingreso', '#ffc107', 'fas fa-gift'),

-- Categorías de egreso
-- (1, 'Comida', 'egreso', '#dc3545', 'fas fa-utensils'),
-- (1, 'Transporte', 'egreso', '#fd7e14', 'fas fa-bus'),
-- (1, 'Servicios', 'egreso', '#20c997', 'fas fa-home'),
-- (1, 'Entretenimiento', 'egreso', '#e83e8c', 'fas fa-gamepad'),
-- (1, 'Salud', 'egreso', '#6c757d', 'fas fa-heart'),
-- (1, 'Educación', 'egreso', '#007bff', 'fas fa-graduation-cap'),
-- (1, 'Ropa', 'egreso', '#795548', 'fas fa-tshirt'),
-- (1, 'Otros', 'egreso', '#9e9e9e', 'fas fa-ellipsis-h');

-- Vista para resumen mensual
CREATE VIEW resumen_mensual AS
SELECT 
    m.usuario_id,
    YEAR(m.fecha) as año,
    MONTH(m.fecha) as mes,
    c.nombre as categoria,
    m.tipo,
    SUM(m.monto) as total_monto,
    COUNT(*) as cantidad_movimientos
FROM movimientos m
JOIN categorias c ON m.categoria_id = c.id
GROUP BY m.usuario_id, YEAR(m.fecha), MONTH(m.fecha), c.nombre, m.tipo;

-- Vista para estadísticas anuales
CREATE VIEW resumen_anual AS
SELECT 
    m.usuario_id,
    YEAR(m.fecha) as año,
    m.tipo,
    SUM(m.monto) as total_monto,
    COUNT(*) as cantidad_movimientos
FROM movimientos m
GROUP BY m.usuario_id, YEAR(m.fecha), m.tipo;