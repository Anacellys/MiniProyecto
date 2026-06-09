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

    <div class="menu-card">
        <h4>Problema #5</h4>
        <p>Determina la estación del año según el día y mes ingresados.</p>
        <a href="?action=problem5">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #6</h4>
        <p>Clasifica edades y muestra estadísticas con gráfica.</p>
        <a href="?action=problem6">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #7</h4>
        <p>Distribución del presupuesto hospitalario con gráfica.</p>
        <a href="?action=problem7">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #8</h4>
        <p>Calcula media, desviación estándar, mínimo y máximo con gráfica.</p>
        <a href="?action=problem8">Resolver</a>
    </div>

    <div class="menu-card">
        <h4>Problema #9</h4>
        <p>Calcula las 15 primeras potencias de un número.</p>
        <a href="?action=problem9">Resolver</a>
    </div>

</div>


<?php include VIEWS_PATH . 'footer.php'; ?>

