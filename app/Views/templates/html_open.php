<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>PROJEEEEEEEEEEEEEEET</title>
    <link rel="stylesheet" href="/styles/normalize.css">
    <link rel="stylesheet" href="/styles/styles.css">
    <?php
    if(isset($styles))
    {
        foreach ($styles as $style)
            echo '<link rel="stylesheet" href="/styles/' . $style . '">';
    }
    ?>
</head>

<body>