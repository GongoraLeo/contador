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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form" name="form" method="post" enctype="multipart/form-data">
        <textarea name="texto" id="texto">

        </textarea>
        <br>
        <label for="fichero">Sube tu fichero: </label><input type="file" name="fichero" id="fichero">
        <br>
        <input type="submit" value="Contar">
        <input type="reset" value="Reset">
        <br>

    </form>


    <?php



    //trabajo sobre textarea si el textarea no tiene texto que no se imprima

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (($_POST['texto'])) {
            $texto = $_POST['texto'];
            $palabras = str_word_count($texto);
            if ($palabras == 0) {
                echo "No ha introducido ningún texto.<br>";
            } else {
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
        }


        //trabajo sobre fichero
        //asegurarse de que se ha subido un fichero para ejecutarlo

        if (isset($_FILES['fichero'])) {

            if (!isset($_FILES['fichero'])) {
                echo "No ha subido ningún fichero.";
            } else {
                $fichero = $_FILES['fichero'];
                $nombre_fichero = $fichero['name'];
                $tipo_fichero = $fichero['type'];
                $tamano_fichero = $fichero['size'];
                $ruta_fichero = $fichero['tmp_name'];
                $error_fichero = $fichero['error'];

                if ($error_fichero == UPLOAD_ERR_OK) {
                    $contenido_fichero = file_get_contents($ruta_fichero);
                    $palabras_fichero = str_word_count($contenido_fichero);
                    echo "<p>El fichero $nombre_fichero tiene $palabras_fichero palabras.</p>";
                    echo "<p>El fichero $nombre_fichero tiene " . strlen($contenido_fichero) . " caracteres.</p>";
                    echo "<p>El fichero $nombre_fichero tiene " . strlen(str_replace(' ', '', $contenido_fichero)) . " caracteres sin espacios.</p>";
                    //número de palabras repetidas en el fichero debe aparecer un minimo de 2 veces cada palabra en el texto para ser repetida decir el número de veces que se repite cada palabra
                    $palabras_repetidas_fichero = array_diff_assoc(str_word_count($contenido_fichero, 1), array_unique(str_word_count($contenido_fichero, 1)));
                    echo "<p>El fichero $nombre_fichero tiene " . count(array_unique($palabras_repetidas_fichero)) . " palabras repetidas.</p>";
                    echo "<p>Las palabras repetidas son: </p>";
                    foreach (array_unique($palabras_repetidas_fichero) as $palabra) {
                        echo "$palabra (" . substr_count($contenido_fichero, $palabra) . " veces), ";
                    }
                    //número de palabras unicas las palabras unicas son todas las palabras que aparecen al menos una vez
                    echo "<p>El fichero $nombre_fichero tiene " . count(array_unique(str_word_count($contenido_fichero, 1))) . " palabras unicas.</p>";
                } else {
                    echo "No ha subido ningún fichero.";
                }
            }
        }
    }


    //si el textarea no tiene texto que no se ejecute el if del textarea, si no se carga un fichero que no se ejecute el if del fichero


    ?>
        <nav><img src="img/modo-claro.png" alt="" class="dark"></nav>

    
    <script src="dark.js"></script>
</body>

</html>