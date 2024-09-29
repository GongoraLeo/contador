<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de palabras</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Contador de palabras</h1>
    <h2>Sencillo contador de palabras en PHP</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" name="form" method="post">
        <textarea name="texto" id="texto">

        </textarea>
        <br>
        <input type="submit" value="Contar">
        <input type="reset" value="Reset">
    </form>
    

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $texto = $_POST['texto'];
        $palabras = str_word_count($texto);
        echo "<p>El texto introducido es: $texto</p>";
        echo "<p>El texto tiene $palabras palabras.</p>";
        echo "<p>El texto tiene " . strlen($texto) . " caracteres.</p>";
        
        //caracteres sin espacios
        echo "<p>El texto tiene " . strlen(str_replace(' ', '', $texto)) . " caracteres sin espacios.</p>";
        
        //número de palabras repetidas debe aparecer un minimo de 2 veces cada palabra en el texto para ser repetida decir el número de veces que se repite cada palabra

        $palabras_repetidas = array_diff_assoc(str_word_count($texto, 1), array_unique(str_word_count($texto, 1)));

        echo "<p>El texto tiene " . count(array_unique($palabras_repetidas)) . " palabras repetidas.</p>";

        echo "<p>Las palabras repetidas son: </p>";
        foreach (array_unique($palabras_repetidas) as $palabra) {

            echo "$palabra (" . substr_count($texto, $palabra) . " veces), ";
        } 

        //número de palabras unicas las palabras unicas son todas las palabras que aparecen al menos una vez
        echo "<p>El texto tiene " . count(array_unique(str_word_count($texto, 1))) . " palabras unicas.</p>";
    }

    ?>
    <script src="contador.js"></script>
</body>

</html>