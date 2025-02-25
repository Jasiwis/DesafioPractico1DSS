<?php

// Función para verificar si un número es primo
function esPrimo($num) {
    if ($num < 2) return false;
    for ($i = 2; $i * $i <= $num; $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

// Función para obtener los números primos de un array
function obtenerPrimos($numeros) {
    $primos = [];
    foreach ($numeros as $num) {
        if (esPrimo($num)) {
            $primos[] = $num;
        }
    }
    return $primos;
}

// Función para validar que no se ingresen números negativos o caracteres no permitidos
function validarNumeros($numeros) {
    foreach ($numeros as $num) {
        if ($num < 0 || !is_numeric($num)) {
            return false;
        }
    }
    return true;
}

// Función para calcular la sumatoria de los números
function calcularSuma($numeros) {
    return array_sum($numeros);
}

// Función para contar la cantidad de números ingresados
function contarNumeros($numeros) {
    return count($numeros);
}
?>
