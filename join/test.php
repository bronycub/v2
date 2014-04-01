<?php
$filename = 'data_test.php';
$content = "<?php //INFOS DU MEMBRES
//////////////////////////////////////////////
\$pseudo='Heuzef';
\$gravatar='c0f08ae603e364cb554fe71c9fc94ffd';
\$prenom='Florent';
\$nom='Heuzé';
\$naissance='05/07/1990';
//////////////////////////////////////////////
include 'template_membres.php'; ?>";

if (is_writable($filename)) 
{

    if (!$handle = fopen($filename, 'a+')) 
    {
         echo "Impossible d'ouvrir le fichier ($filename)";
         exit;
    }

    if (fwrite($handle, $content) === FALSE) 
    {
        echo "Impossible d'écrire dans le fichier ($filename)";
        exit;
    }

    echo "L'écriture dans le fichier ($filename) a réussi";

    fclose($handle);

} else 
{
    echo "Le fichier $filename n'est pas accessible en écriture.";
}
?>