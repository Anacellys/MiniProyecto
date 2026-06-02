<?php
/**
 * Plantilla de pie de página (Footer)
 * Reutilizable en todas las vistas
 * Incluye fecha dinámica del sistema
 *
 */
?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>
            <strong>Mini Proyecto Desarrollo Software VII</strong> |
            Universidad Tecnológica de Panamá<br>
            <small>
                <?php echo date('d/m/Y H:i:s'); ?>
            </small>
        </p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
