<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJEEEEEEEEEEEEEEET</title>

    <?php
        if (isset($fontAwesome) && $fontAwesome)
            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">';
    ?>

    <link rel="stylesheet" href=<?= base_url("/styles/normalize.css") ?>>
    <link rel="stylesheet" href=<?= base_url("/styles/styles.css") ?>>
    <?php
    if(isset($styles))
    {
        foreach ($styles as $style)
            echo '<link rel="stylesheet" href="'. base_url('/styles/'.$style) . '">';
    }
    ?>
</head>

<body>