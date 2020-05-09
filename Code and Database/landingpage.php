<!DOCTYPE html>
<html>

<head>
    <title>Travel.ba</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
</head>

<body>
    <?php include "biblioteke - landingPage.php" ?>
        <div id="map"></div>

        <script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
        <script src="leaflet-routing-machine.js"></script>

        <script type="text/javascript">
            var map = L.map('map').setView([40.85, 18.25], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            map.options.maxZoom = 5;

            function createIcons(iconUrl, w, h) {
                var iconName = L.icon({
                    iconUrl: iconUrl,
                    iconSize: [w, h]
                });
                return iconName;
            }
            var firstIcon = createIcons('images/travel1.png', 400, 400);
            marker1 = new L.marker([48.85, 18.25], {
                draggable: false,
                icon: firstIcon
            }).addTo(map);
            map.setView([48.85, 18.25], 5);

            marker1.on('click', function(e) {
                window.location.href = "http://127.0.0.1/Travel.ba/index.php";
            });

            marker1.bounce({
                duration: 500,
                height: 100
            }, function() {
                alert("done")
            });
        </script>
</body>

</html>