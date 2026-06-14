# TODO - Problema Hospitalario (Presupuesto con porcentajes y validaciones)

- [x] Actualizar `app/models/HospitalBudgetModel.php` para calcular distribución en base a un **presupuesto total ingresado** usando porcentajes fijos 40/35/25 y preparar data para gráfica.

- [x] Actualizar `app/controllers/Problem7Controller.php` para manejar GET/POST con:


  - [x] CSRF (generate/verify)
  - [x] Sanitización de entrada
  - [x] Validación OWASP: presupuesto **negativo** y **0** con mensajes exactos
  - [x] Cálculo de montos por área
- [x] Actualizar `app/views/problem7.php`:

  - [x] Formulario Bootstrap 5 estilizado (botón verde)
  - [x] Tarjetas con íconos y montos/porcentajes
  - [x] Gráfica Chart.js responsiva con paleta verde
  - [x] Escapado de salidas

- [x] Probar manualmente en navegador `?action=problem7` con valores: -10, 0, 12345 y texto inválido.
- [x] Ejecutar verificación rápida (si hay) y ajustar estilos menores.


