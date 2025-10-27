<?php
// views/formulario.php — este archivo se incluye desde index.php
// Calculamos la base (ej: "/figuras") para construir la URL del API
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), "/\\"); // ejemplo: "/figuras"
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Figuras</title>
    <style>
        body { background: #222; color: #eee; font-family: Arial; text-align: center; padding: 24px; }
        form { background: #333; padding: 20px; border-radius: 10px; display: inline-block; min-width: 320px; }
        input, select { margin: 5px; padding: 8px; border-radius: 5px; border: none; width: 90%; box-sizing: border-box; }
        button { background: #06c167; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }
        button[disabled] { opacity: 0.6; cursor: not-allowed; }
        .hidden { display: none; }
        .result { margin-top: 16px; background: #111; padding: 12px; border-radius: 8px; }
        .error { color: #ff6b6b; }
    </style>
</head>
<body>
    <h2>Calculadora de Áreas y Perímetros</h2>

    <form id="formFiguras" autocomplete="off">
        <label>Selecciona una figura:</label><br>
        <select name="figura" id="figuraSelect" required>
            <option value="">--Selecciona--</option>
            <option value="rectangulo">Rectángulo</option>
            <option value="triangulo">Triángulo</option>
            <option value="circulo">Círculo</option>
        </select><br>

        <div id="param1Container">
            <label id="labelParam1">Parámetro 1 (Base / Lado / Radio):</label><br>
            <input type="number" name="param1" id="param1" step="any" required><br>
        </div>

        <div id="param2Container" class="hidden">
            <label id="labelParam2">Parámetro 2 (Altura):</label><br>
            <input type="number" name="param2" id="param2" step="any"><br>
        </div>

        <button type="submit" id="submitBtn">Calcular</button>
    </form>

    <div id="output" class="result hidden"></div>

    <script>
        (function () {
            const figuraSelect = document.getElementById('figuraSelect');
            const param2Container = document.getElementById('param2Container');
            const labelParam1 = document.getElementById('labelParam1');
            const param1 = document.getElementById('param1');
            const param2 = document.getElementById('param2');
            const form = document.getElementById('formFiguras');
            const output = document.getElementById('output');
            const submitBtn = document.getElementById('submitBtn');

            // Construimos la URL del API usando la base que inyectó PHP
            const apiUrl = '<?= htmlspecialchars($base, ENT_QUOTES) ?>/api/calculate.php';

            function actualizarCampos() {
                const figura = figuraSelect.value;
                if (figura === 'circulo') {
                    param2Container.classList.add('hidden');
                    param2.removeAttribute('required');
                    labelParam1.textContent = 'Radio:';
                } else if (figura === 'rectangulo') {
                    param2Container.classList.remove('hidden');
                    param2.setAttribute('required', 'required');
                    labelParam1.textContent = 'Base:';
                } else if (figura === 'triangulo') {
                    param2Container.classList.remove('hidden');
                    param2.setAttribute('required', 'required');
                    labelParam1.textContent = 'Lado:';
                } else {
                    param2Container.classList.add('hidden');
                    param2.removeAttribute('required');
                    labelParam1.textContent = 'Parámetro 1 (Base / Lado / Radio):';
                }
            }

            figuraSelect.addEventListener('change', actualizarCampos);
            actualizarCampos(); // init

            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                output.classList.add('hidden');
                output.innerHTML = '';
                submitBtn.disabled = true;

                const fd = new FormData(form);

                try {
                    const res = await fetch(apiUrl, {
                        method: 'POST',
                        body: fd,
                        credentials: 'same-origin'
                    });

                    const data = await res.json();

                    if (!res.ok) {
                        output.classList.remove('hidden');
                        output.innerHTML = `<div class="error">Error: ${data.error || 'Error desconocido'}</div>`;
                        submitBtn.disabled = false;
                        return;
                    }

                    output.classList.remove('hidden');
                    output.innerHTML = `
                        <strong>${data.nombre}</strong><br>
                        Área: ${data.area} <br>
                        Perímetro: ${data.perimetro} <br>
                    `;
                } catch (err) {
                    output.classList.remove('hidden');
                    output.innerHTML = `<div class="error">Error de red: ${err.message}</div>`;
                } finally {
                    submitBtn.disabled = false;
                }
            });
        })();
    </script>
</body>
</html>
