<?php

// Central configuration helpers for Honda Dealership system

if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

if (!function_exists('format_currency')) {
    /**
     * Formata um valor monetário em Real Brasileiro
     */
    function format_currency(float $val): string {
        return 'R$ ' . number_format($val, 2, ',', '.');
    }
}

if (!function_exists('format_date')) {
    /**
     * Formata uma data do formato Y-m-d para d/m/Y
     */
    function format_date(string $date): string {
        if (empty($date) || $date === '0000-00-00') return '-';
        return date('d/m/Y', strtotime($date));
    }
}

if (!function_exists('format_km')) {
    /**
     * Formata quilometragem com separador de milhar
     */
    function format_km(int $km): string {
        return number_format($km, 0, ',', '.') . ' km';
    }
}
