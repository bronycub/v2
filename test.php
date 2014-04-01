<?php
$filename = 'test.txt';
$content = "
Ajout de chaîne dans le fichier
";
if (is_writable($filename)) 
{

    if (!$handle = fopen($filename, 'a')) 
    {
         echo "Impossible d'ouvrir le fichier ($filename)";
         exit;
    }

    if (fwrite($handle, $content) === FALSE) 
    {
        echo "Impossible d'écrire dans le fichier ($filename)";
        exit;
    }

    echo "L'écriture de ($content) dans le fichier ($filename) a réussi";

    fclose($handle);

} else 
{
    echo "Le fichier $filename n'est pas accessible en écriture.";
}
?>