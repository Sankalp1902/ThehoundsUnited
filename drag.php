<!DOCTYPE html>
<html class='use-all-space'>
<head>
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <meta charset='UTF-8'>
    <title>Maps SDK for Web - Draggable marker</title>
    <meta name='viewport'
          content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href='assets/ui-library/index.css'/>
    <script>
            alert('Please Select your location from the marker');            
            </script>
</head>
<body>
    <div id='map' class='map'></div>
     <script>
            alert('Project still under development, please visit "thehoundsunited.000webhostapp.com" after sometime to check it fully working');            
            </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps-web.min.js"></script>    
    <script data-showable type='text/javascript' src='assets/js/mobile-or-tablet.js'></script>
    <script data-showable type='text/javascript' src='assets/js/formatters.js'></script>
    <script>
        var roundLatLng = Formatters.roundLatLng;
        var center = [4.890659, 52.373154];
        var popup = new tt.Popup({
            offset: 35
        });
        var map = tt.map({
            key: '57NbLt5SDV09G7Gw6gaOCw8VPNteWURM',
            container: 'map',
            style: 'tomtom://vector/1/basic-main',
            dragPan: !isMobileOrTablet(),
            center: center,
            zoom: 14
        });
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());

        var marker = new tt.Marker({
            draggable: true
        }).setLngLat(center).addTo(map);

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            lngLat = new tt.LngLat(roundLatLng(lngLat.lng), roundLatLng(lngLat.lat));

            popup.setHTML(lngLat.toString());
            popup.setLngLat(lngLat);
            marker.setPopup(popup);
            marker.togglePopup();
        }

        marker.on('dragend', onDragEnd);
    </script>
</body>
</html>
