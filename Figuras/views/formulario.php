<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Figuras</title>
    <style>
        body { background: #222; color: #eee; font-family: Arial; text-align: center; }
        form { background: #333; padding: 20px; border-radius: 10px; display: inline-block; }
        input, select { margin: 5px; padding: 8px; border-radius: 5px; border: none; }
        button { background: #06c167; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }
        button:hover { background: #04a158; }
    </style>
</head>
<body>
    <h2>Calculadora de Áreas y Perímetros</h2>

    <form method="POST" action="../index.php">
        <label>Selecciona una figura:</label><br>
        <select name="figura" required>
            <option value="rectangulo">Rectángulo</option>
            <option value="triangulo">Triángulo</option>
            <option value="circulo">Círculo</option>
        </select><br>

        <label>Parámetro 1 (Base / Lado / Radio):</label><br>
        <input type="number" name="param1" step="any" required><br>

        <label>Parámetro 2 (Altura si aplica):</label><br>
        <input type="number" name="param2" step="any"><br>

        <button type="submit">Calcular</button>
    </form>
</body>
</html>
