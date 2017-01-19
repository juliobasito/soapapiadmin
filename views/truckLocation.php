<?php
    $x = $truckLocation->getX();
    $y = $truckLocation->getY();
?>
<div class="container">
    <div id="map" style="height:500px;"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKkgefLFmKzT-O14c3rICcraC-IrBo4KE&callback=initMap"
        async defer></script>
<script type="text/javascript">
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: <?php echo $x; ?>, lng: <?php echo $y; ?>},
            zoom: 16
        });
        var myLatLng = {lat: <?php echo $x; ?>, lng: <?php echo $y; ?>};
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }

</script>