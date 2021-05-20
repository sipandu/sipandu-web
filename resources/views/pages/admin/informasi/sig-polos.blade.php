<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIG POLOS</title>
    <style>
        #mapid {
            height: 800px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
    <div id="mapid"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        var mymap = L.map('mapid').setView([-8.30926555343337, 115.09210838237348], 10);

        //function marker
        function marker(posyandu){
            var marker = L.marker([posyandu['latitude'], posyandu['longitude']]).addTo(mymap);
            var msg = '<p>Nama Posyandu : '+posyandu['nama_posyandu']+'</p>'+
                      '<p>Alamat : '+posyandu['alamat']+'</p>'+
                      '<p>Nomor Telepon : '+posyandu['nomor_telepon']+'</p>'+
                      '<a target="_blank" href="http://www.google.com/maps/place/'+posyandu['latitude']+','+posyandu['longitude']+'">Lihat lokasi posyandu pada google maps</a>'
            marker.bindPopup(msg);
            //when marker on click
            marker.on('click', function(event){
                marker.openPopup();
            });
        }

        $(document).ready(function(){
            $.ajax({
                url : '{{ route("sig-posyandu.get_data") }}',
                method : 'GET',
                success : function(response) {
                    for(let i = 0; i < response.posyandu.length; i++) {
                        marker(response.posyandu[i]);
                    }
                }
            });
        });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: '<a href="https://www.openstreetmap.org/copyright" class="text-decoration-none link-primary">SIPANDU</a> © 2021',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZmlyZXJleDk3OSIsImEiOiJja2dobG1wanowNTl0MzNwY3Fld2hpZnJoIn0.YRQqomJr_RmnW3q57oNykw'
        }).addTo(mymap);
    </script>
</body>
</html>
