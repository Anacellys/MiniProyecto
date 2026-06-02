<?php
/**
 * Vista del menú principal
 * Permite seleccionar qué problema resolver
 *
 * @author anacelis
 */

include VIEWS_PATH . 'header.php';
?>

<h1 class="text-white mb-5 text-center-custom">Mini Proyecto Desarrollo Software VII</h1>

<div class="menu-grid">
    <div class="menu-card">
        <h4>Problema #1</h4>
        <p>Calcula la media, desviación estándar, valor mínimo y máximo de 5 números positivos.</p>
        <a href="?action=problem1">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #2</h4>
        <p>Calcula la suma de los números del 1 al 1000 mostrando el procedimiento con ciclo for.</p>
        <a href="?action=problem2">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #3</h4>
        <p>Imprime los N primeros múltiplos de 4 según el valor ingresado.</p>
        <a href="?action=problem3">Resolver</a>
    </div>

   
    <div class="menu-card">
        <h4>Problema #4</h4>
        <p>Calcula la suma de números pares e impares comprendidos entre 1 y 200.</p>
        <a href="?action=problem4">Resolver</a>
    </div>
</div>

<?php include VIEWS_PATH . 'footer.php'; ?>
