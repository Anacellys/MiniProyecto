<?php
/**
 * Plantilla de encabezado (Header)
 * Reutilizable en todas las vistas
 * Incluye Bootstrap 5 y estilos personalizados
 *
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talleres - Desarrollo Web VII - UTP</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff !important;
        }

        .container-main {
            flex: 1;
            padding: 40px 20px;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--secondary-color);
            color: white;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        .btn-primary-custom {
            background-color: var(--secondary-color);
            border: none;
            border-radius: 5px;
            padding: 10px 25px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary-custom {
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-secondary-custom:hover {
            background-color: #34495e;
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #bdc3c7;
            padding: 10px;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .alert-custom {
            border-radius: 5px;
            border-left: 5px solid;
        }

        .alert-danger-custom {
            border-left-color: var(--danger-color);
            background-color: #fadbd8;
            color: var(--danger-color);
        }

        .alert-success-custom {
            border-left-color: var(--success-color);
            background-color: #d5f4e6;
            color: var(--success-color);
        }

        .text-center-custom {
            text-align: center;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .menu-card h4 {
            color: var(--secondary-color);
            margin-bottom: 15px;
            font-weight: bold;
        }

        .menu-card p {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .menu-card a {
            display: inline-block;
            margin-top: 15px;
            color: white;
            background-color: var(--secondary-color);
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-card a:hover {
            background-color: #2980b9;
            text-decoration: none;
        }

        .result-section {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 5px solid var(--secondary-color);
        }

        .result-title {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #bdc3c7;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-label {
            font-weight: bold;
            color: var(--primary-color);
        }

        .result-value {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .link-back {
            display: inline-block;
            margin-top: 20px;
            color: white;
            background-color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .link-back:hover {
            background-color: #34495e;
            text-decoration: none;
            color: white;
            transform: translateY(-2px);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="?action=menu">
                Mini Proyecto Desarrollo Software VII
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?action=menu">Menú Principal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container-main">
        <div class="container">
