<?php
include('../connect/connect.php');
$sAction=$_REQUEST['action'];
if($sAction=="addstore")
{
    $query = "SELECT * FROM store ORDER BY storeid DESC LIMIT 1 ";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($result);
    if($row)
    {
        $s_code=$row['s_code'];
        $s_code=str_split($s_code,2);
        $s_code= $s_code[1];
        $s_code++;
        $s="SC";
        $s_code=$s.$s_code;
    }
    else{
        $s_code="SC1";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5"> 
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4"style="text-align: left">Add Store</h1>
             <table>
            <td style="padding-left: 1100px" ">
            <a href="store.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
             </div>
             
              <div class="form-group">
            <label>Store Code</label>
                    <input style="width: 100px;" type="text" id = "s_code" name="s_code" value="'.$s_code.'" readonly  class="form-control  text-center" />
             
            </div>
             
             <form onsubmit="return submitstore();" class="user" method="POST" action=""> 
             <div class="form-group"> <label>Storename</label><span style="color: red">*</span><input type="text" class="form-control " id="storename" name="storename"  placeholder="Enter Storename" required autocomplete="off" maxlength="25" > </div>
             <div class="form-group"><label>Longitude</label><span style="color: red">*</span> <input  type="text" class="form-control " id="longitude" name="longitude"  placeholder="Enter Longitude" readonly   autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"  "> </div>
            <div class="form-group"> <label>Latitude</label><span style="color: red">*</span><input type="text" class="form-control " id="latitude" name="latitude"  placeholder="Enter Latitude" readonly  autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"  "> </div>
            <div class="form-group"><input type="radio"  name="status" id="status" value="active"class="fields" required="required" />Active
                                <input type="radio" name="status" id="status" value="disabled"class="fields" required="required" />Disabled</div>
            <input type="submit" name="Add"  value="Add" class="btn btn-info  btn-block"> </form> 
            </div>
                </div>
            </div>
            <h1>My First Google Map</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
    function initMap() {

        var settings = {
            center: {
                lat:31.5204,
                lng:74.3587,
            },
            zoom: 13,
        }

        let markers = [];
        var map = new google.maps.Map(document.getElementById(\'googleMap\'), settings);
        google.maps.event.addListener(map, \'click\', function(e) {

            var marker = new google.maps.Marker({
                position: e.latLng,
                map: map
            });
            markers.push(marker);

            google.maps.event.addListener(map, "click", function(e) {
                marker.setMap(null);
            })
            // google.maps.event.addListener(marker, "click", function(e) {
            //   HideAllMarkers(markers);
            // })

            if (markers.length >= 2) {

                const index = markers.indexOf(markers[0])

                if (index > -1) {
                    markers.splice(index, 1);
                    markers[0].setVisible(true);
                    document.getElementById(\'latitude\').value = \'\'
                    document.getElementById(\'longitude\').value = \'\'
                }

            }
            document.getElementById(\'latitude\').value = e.latLng.lat()
            document.getElementById(\'longitude\').value = e.latLng.lng()

        });

        function HideAllMarkers(markers) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setVisible(false);
                document.getElementById(\'latitude\').value = \'\'
                document.getElementById(\'longitude\').value = \'\'
            }
        }


        // setMapOnAll(null);

        // function hideMarkers() {
        //   setMapOnAll(null);
        // }


    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf6UJtqIUabhRfEVpl5kbV8npQTMGKGdI&callback=initMap" async defer></script>

            
            
            
            ';

    echo $html;
}
if($sAction=="edititem")
{
    $id=$_POST['id'];
    $sActive="";
    $sdisabled="";
    $sql=mysqli_query($conn,"SELECT * from store where storeid='$id'");
    $result=mysqli_fetch_array($sql);
    $storename=$result['storename'];
    $longitude=$result['longitude'];
    $latitude=$result['latitude'];
    $status=$result['status'];
    if($status==1)
    {
        $sActive="checked=checked";
    }
    else{
        $sdisabled="checked=checked";
    }
    $html='
    <link href="http://localhost/admin/admin/css/sb-admin-2.min.css" rel="stylesheet">
            <div class="row" id="divmain"> </div><div class="col-lg-6"> <div class="p-5">
            <div class="text-center">
             <h1 class="h4 text-gray-900 mb-4" style="text-align: left">Update Store</h1>
             <table>
            <td style="padding-left: 1100px" ">
            <a href="store.php" role="button" title="Back" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-arrow-left" ></i></a>
                
            </td>
            </table>
             </div>
             <form onsubmit="return updatestore()" class="user" method="POST" action="">
             <input type="hidden" class="form-control " id="id" name="id"  hidden value='.$id.' > 
             <div class="form-group"><label>Storename</label><span style="color: red">*</span> <input type="text" class="form-control " id="storename" name="storename" aria-describedby="emailHelp" value="'.$storename.'" autocomplete="off"> </div>
             <div class="form-group"><label>Longitude</label><span style="color: red">*</span> <input type="text" class="form-control " id="longitude" name="longitude"  value='.$longitude.'  required autocomplete="off" readonly  oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><label>Latitude</label><span style="color: red">*</span> <input type="text" class="form-control " id="latitude" name="latitude" value='.$latitude.' required autocomplete="off" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\..*)\./g, \'$1\');"> </div>
            <div class="form-group"><input type="radio"  name="status" id="status" value="active" class="fields" required="required" '.$sActive.' />Active
                                <input type="radio" name="status" id="status" value="disabled" class="fields" required="required" '.$sdisabled.' />Disabled</div>
            <input type="submit" name="update" value="Update" class="btn btn-info  btn-block">
             </form>
            </div>
                </div>
            </div>

            <h1>My First Google Map</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
    function initMap() {
        var settings = {
            center: {
                lat:31.5204,
                lng:74.3587,
            },
            zoom: 13,
        };
        var map = new google.maps.Map(document.getElementById(\'googleMap\'), settings);
        var latitude=document.getElementById(\'latitude\').value;
        console.log(latitude);
        var longitude=document.getElementById(\'longitude\').value;
        var myLatlng = new google.maps.LatLng(latitude,longitude);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
        });
        google.maps.event.addListener(map, "click", function(e) {
            marker.setMap(null);
        })
        console.log("init map");
        let markers = [];


        google.maps.event.addListener(map, \'click\', function(e) {

            var marker = new google.maps.Marker({
                position: e.latLng,
                map: map
            });
            markers.push(marker);

            google.maps.event.addListener(map, "click", function(e) {
                marker.setMap(null);
            })

            if (markers.length >= 2) {

                const index = markers.indexOf(markers[0])

                if (index > -1) {
                    markers.splice(index, 1);
                    markers[0].setVisible(true);

                    document.getElementById(\'latitude\').value = \'\'
                    document.getElementById(\'longitude\').value = \'\'
                }

            }
            document.getElementById(\'latitude\').value = e.latLng.lat()
            document.getElementById(\'longitude\').value = e.latLng.lng()

        });

        function HideAllMarkers(markers) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setVisible(false);
                document.getElementById(\'latitude\').value = \'\'
                document.getElementById(\'longitude\').value = \'\'
            }
        }


        // setMapOnAll(null);

        // function hideMarkers() {
        //   setMapOnAll(null);
        // }


    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDf6UJtqIUabhRfEVpl5kbV8npQTMGKGdI&callback=initMap" async defer></script>
    
            ';
    echo $html;
}

?>