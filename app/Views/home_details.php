<?= view('templates/html_open.php') ?>

<?php var_dump($annonce); ?>

<p><a href="<?= base_url("/homes/" . $annonce['A_idannonce'] . "/contact") ?>">Contacter le propriétaire</a></p>

<div id="map"></div>

<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly"
        async
></script>

<?= view('templates/html_close.php') ?>
