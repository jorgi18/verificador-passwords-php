<?php
function evaluarPassword($pwd) {
    $puntos = 0;
    $reglas = [];
    if (strlen($pwd) >= 12) {
        $puntos++; $reglas[] = "Longitud >= 12 caracteres";
    }
    if (preg_match('/[A-Z]/', $pwd)) {
        $puntos++; $reglas[] = "Contiene mayúsculas";
    }
    if (preg_match('/[0-9]/', $pwd)) {
        $puntos++; $reglas[] = "Contiene números";
    }
    if (preg_match('/[^A-Za-z0-9]/', $pwd)) {
        $puntos++; $reglas[] = "Contiene símbolos";
    }
    $niveles = ["Muy débil", "Débil", "Aceptable", "Fuerte", "Muy fuerte"];
    return [$niveles[$puntos], $reglas];
}
 
$resultado = null;
$reglas = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pwd = $_POST['password'] ?? '';
    [$resultado, $reglas] = evaluarPassword($pwd);
}
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Verificador de Contraseñas</title></head>
<body style="font-family:sans-serif; max-width:480px; margin:60px auto;">
  <h1>Verificador de Fortaleza de Contraseñas</h1>
  <form method="POST">
    <input type="password" name="password" placeholder="Escribe una contraseña" required>
    <button type="submit">Evaluar</button>
  </form>
  <?php if ($resultado): ?>
    <h2>Resultado: <?= htmlspecialchars($resultado) ?></h2>
    <ul>
      <?php foreach ($reglas as $r): ?>
        <li><?= htmlspecialchars($r) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</body>
</html>
