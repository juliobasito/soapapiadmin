<div class="container">
    <div id="map" style="height:500px;"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKkgefLFmKzT-O14c3rICcraC-IrBo4KE&callback=initMap"
        async defer></script>
<script type="text/javascript">
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 44.837789, lng: -0.5791799999999512},
            zoom: 16
        });
        var myLatLng = {lat: 0, lng: 0};
        <?php
        foreach ($trucks as $truck){ ?>
            myLatLng ={lat: <?php echo $truck->getLocation()->getX() ; ?>, lng:<?php echo $truck->getLocation()->getY(); ?>}
            addMarker(myLatLng)
        <?php } ?>
    }
    function addMarker(myLatLng) {
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }
</script>