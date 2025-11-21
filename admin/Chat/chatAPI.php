<?php
$query = $pdo->prepare("SELECT nombre_materia FROM materias WHERE estado = '1'");
$query->execute();
$materias = $query->fetchAll(PDO::FETCH_ASSOC);

// Generar lista en texto
$lista_materias = "";
foreach ($materias as $m) {
    $lista_materias .= "- " . $m['nombre_materia'] . "\n";
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Método no permitido";
    exit;
}

if (!isset($_POST['mensaje'])) {
    echo "No se recibió mensaje";
    exit;
}

$pregunta = $_POST['mensaje'];

$api_key = "API_KEY";

$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        [
            "role" => "system",
            "content" => "
Eres un asistente del sistema escolar. Solo puedes dar información relacionada con las materias registradas en la tabla \"materias\". NO puedes inventar materias, descripciones, grados o contenidos que no existan.

Tu conocimiento sobre materias proviene EXCLUSIVAMENTE de la siguiente lista de materias extraída desde la base de datos:

[MATERIAS_AQUI]

REGLAS:
1. Si el usuario pregunta por una materia NO registrada, responde: 
   \"Esa materia no está registrada en el sistema escolar.\"
2. No inventes materias, contenidos, prerrequisitos ni descripciones que no existan en la tabla.
3. No puedes responder preguntas personales, externas o fuera del contexto del sistema escolar.
4. Si el usuario pregunta información que no está contenida en la tabla \"materias\", responde:
   \"La información solicitada no está disponible en el sistema.\"
5. Mantén un tono formal, claro y conciso.
6. Si el usuario solicita registrar, modificar o eliminar materias, responde:
   \"Solo puedo proporcionar información, no puedo realizar cambios en el sistema.\"
"
        ],
        [
            "role" => "user",
            "content" => $pregunta
        ]
    ],
    "max_tokens" => 200
];

$system_prompt = "
Eres un asistente del sistema escolar. Solo puedes hablar de las materias registradas.

Materias registradas:
$lista_materias

REGLAS:
1. Si la materia no está registrada, responde: 
   'Esa materia no está registrada en el sistema escolar.'
2. No inventes materias ni detalles que no existan.
3. No respondas preguntas fuera del contexto escolar.
4. Sé preciso, formal y claro.
";

$ch = curl_init("https://api.openai.com/v1/chat/completions");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $api_key"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Desactivar SSL (solo si lo necesitas)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "Error CURL: " . curl_error($ch);
    exit;
}

curl_close($ch);

$decoded = json_decode($response, true);

if (!isset($decoded["choices"][0]["message"]["content"])) {
    echo "Respuesta inesperada: " . $response;
    exit;
}

// <<< ESTA ES LA RESPUESTA EN TEXTO SIMPLE >>>
header("Content-Type: text/plain; charset=UTF-8");
echo $decoded["choices"][0]["message"]["content"];

?>