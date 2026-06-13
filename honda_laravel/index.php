<?php
/**
 * Redirecionador de raiz para public/
 * 
 * Este arquivo existe para permitir acessar o Laravel pelo XAMPP
 * quando o DocumentRoot aponta para a raiz do projeto ao invés de public/.
 * 
 * A solução correta é apontar o VirtualHost do Apache para /public,
 * mas este fallback funciona para desenvolvimento rápido.
 */

// Redireciona permanentemente para a pasta public/
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Evita loop infinito se já estiver em /public
if (strpos($uri, '/public') === 0) {
    // Já está correto, só carrega o index.php da pasta public
    require __DIR__ . '/public/index.php';
} else {
    // Redireciona para public
    header('Location: /Honda_laravel/trabalho_POO/honda_laravel/public' . $uri, true, 302);
    exit;
}
