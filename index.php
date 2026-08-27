&lt;?php
function evaluarPassword($pwd) {
$puntos = 0;
$reglas = [];
if (strlen($pwd) &gt;= 12) {
$puntos++; $reglas[] = &quot;Longitud &gt;= 12 caracteres&quot;;
}
if (preg_match(&#39;/[A-Z]/&#39;, $pwd)) {
$puntos++; $reglas[] = &quot;Contiene mayúsculas&quot;;
}
if (preg_match(&#39;/[0-9]/&#39;, $pwd)) {
$puntos++; $reglas[] = &quot;Contiene números&quot;;
}
if (preg_match(&#39;/[^A-Za-z0-9]/&#39;, $pwd)) {
$puntos++; $reglas[] = &quot;Contiene símbolos&quot;;
}
$niveles = [&quot;Muy débil&quot;, &quot;Débil&quot;, &quot;Aceptable&quot;, &quot;Fuerte&quot;, &quot;Muy fuerte&quot;];
return [$niveles[$puntos], $reglas];
}
$resultado = null;
$reglas = [];
if ($_SERVER[&#39;REQUEST_METHOD&#39;] === &#39;POST&#39;) {
$pwd = $_POST[&#39;password&#39;] ?? &#39;&#39;;
[$resultado, $reglas] = evaluarPassword($pwd);
}
?&gt;
&lt;!doctype html&gt;
&lt;html lang=&quot;es&quot;&gt;
&lt;head&gt;&lt;meta charset=&quot;utf-8&quot;&gt;&lt;title&gt;Verificador de Contraseñas&lt;/title&gt;&lt;/head&gt;
&lt;body style=&quot;font-family:sans-serif; max-width:480px; margin:60px auto;&quot;&gt;
&lt;h1&gt;Verificador de Fortaleza de Contraseñas&lt;/h1&gt;
&lt;form method=&quot;POST&quot;&gt;
&lt;input type=&quot;password&quot; name=&quot;password&quot; placeholder=&quot;Escribe una contraseña&quot;
required&gt;
&lt;button type=&quot;submit&quot;&gt;Evaluar&lt;/button&gt;
&lt;/form&gt;
&lt;?php if ($resultado): ?&gt;
&lt;h2&gt;Resultado: &lt;?= htmlspecialchars($resultado) ?&gt;&lt;/h2&gt;
&lt;ul&gt;
&lt;?php foreach ($reglas as $r): ?&gt;
&lt;li&gt;&lt;?= htmlspecialchars($r) ?&gt;&lt;/li&gt;
&lt;?php endforeach; ?&gt;
&lt;/ul&gt;
&lt;?php endif; ?&gt;
&lt;/body&gt;
&lt;/html&gt;
