<?php 
 
   require_once('../../private/initialize.php');
    
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bus Tracking</title>
		
		<script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
		
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		 <script
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwVbE80IgTIqeY4oc3KVa7aHnlwDyOTAo&callback=initMap">
        </script>
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" />

        <link rel="stylesheet" href="mapcss.css"/>
        <script type="text/javascript">
            
            function selectbus()
            {
                //alert(document.getElementById("stdlist").value);

                document.getElementById("buslist").value = document.getElementById("stdlist").value;
                
            }
        
            function checkinthebus()
            {
                //alert(document.getElementById("stdlist").value);
                //var jArray= <?php echo json_encode(findstudentinbus(144301)); ?>;

                //for(var i=0;i<2;i++){
                    //alert(jArray['BusNo']);
                //}
                
            }

        
        </script>

        <style>
            #map-canvas 
            { 
                height: 100%;

            }

            html, body {
                    height: 100%;
                    width: 100%;
                    margin: 0;
                    padding: 0;
            }

            #floating-panel {
                    position: absolute;
                    top: 10px;
                    left: 25%;
                    z-index: 5;
                    width: 700px;

                    background-color: rgba(255, 255, 255, 0.3);
                    padding: 0,0,0,0;
                    border: 0px solid #999;
                    text-align: center;
                    font-family: 'Roboto','sans-serif';
                    line-height: 40px;
                    padding-left: 0px;
            }

        </style>
        
	</head>
	
	<body>
	
	   
       <?php
               require_once('../../private/initialize.php');
               $id = $_GET['id'];
               $studentid =  18; //$_GET['studentid'];
               $busno = 400; //$_GET['busno'];
               $schoolno = 1 ;//$_GET['schoolno'];

               //echo $studenti  . " " . $busno . " " . $schoolno;
               $children_set = parent_children($id) ;
               $bus_set = parent_children($id) ;
               $rowcount=mysqli_num_rows($bus_set);

              
       ?>
		
       <div id="floating-panel">
        <table class="table" >
            <tr>
                <td><label class="btn-block input-sm">Name</label></td>
                <td>
                    <select <?php 
                        if ($rowcount > 1) 
                            echo 'multiple' ;
                        else
                            echo "style='height:30px'";   
                    ?> 
                    onchange="selectbus()" onclick="checkinthebus()" id="stdlist"  class="btn-block input-sm">
                    <?php
                        $i = 0;
                        while($children = mysqli_fetch_assoc($children_set)) {
                            echo "<option " . isfound(). " value=\"{$children["studentID"]}-{$children["BusNo"]}-{$children["SchoolNo"]}\"";
                            if($i == 0) {
                                        echo " selected";
                                    }
                            echo ">{$children["studentName"]}</option>";
                            $i++;
                        }
                       
                    ?>
                    </select>
                </td>
                <td><label class="btn-block input-sm">Bus</label></td>
                <td>
                    <select id="buslist" style="height:30px;" class="btn-block input-sm" disabled>
                    <?php

                        while($bus = mysqli_fetch_assoc($bus_set)) {
                            echo "<option value=\"{$bus["studentID"]}-{$bus["BusNo"]}-{$bus["SchoolNo"]}\"";
                            if($bus["BusNo"] == 0) {
                                        echo " selected";
                                    }
                            echo ">{$bus["BusNo"]}</option>";
                        }
                        

                    ?>
                </select>  

                <td><input type="text"  id="busno"  value="0" hidden /> </td>

                </td>
                <td><button style="width:140px;height:30px;" id="Btnbus">Find bus location</button></td>
                <td>
                    <td><button style="width:140px;height:30px;" id="Btnback">Go Back</button></td>
                </td>
    
            </tr>
        </table>
               

               
               

               
               <!-- <button style="width:140px;height:30px;" id="Btnpath">Find bus path</button>-->
       </div>
        <div id="map-canvas">
            
        </div>

        
        <script>
            
            //document.getElementById('findbus').addEventListener('click',alert('ok'));
            
            var map;
           
            
            function initialize() {

                    var myLatLng = new google.maps.LatLng(42.079611, -80.076703);
                    myOptions = {
                        zoom: 18,
                        center: myLatLng
                       
                        
                        };
                    map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions );
                    var marker = new google.maps.Marker( {position: myLatLng, map: map,icon:'bus.png'} );

                marker.setMap( map );
                
                
                var findthebus = function() {
                    
                    //setInterval(moving, 1000);
                    moveMarker( map, marker );
                    
                };
                
                var moving = function()
                {
                    moveMarker( map, marker );
                    
                }
                
             
                function goback()
                {
                    //alert('GoBack');
                    window.location='../index.php';
                    //history.go(-1);
                    //return false;
                }
                
                document.getElementById("Btnbus").addEventListener("click", findthebus);
                document.getElementById("Btnback").addEventListener("click", goback);
                //document.getElementById("Btnpath").addEventListener("click", findpath);
                

            }
            
   

            function moveMarker( map, marker ) {

                //delayed so you can see it move
                //alert('getlocations.php?studentinfo=' + document.getElementById("stdlist").value);
                setTimeout( function(){ 
                       
                       $.getJSON(
		              'getlocations.php?studentinfo=' + document.getElementById("stdlist").value,
		              
		               function(result){
                            //alert('ok');
                         $.each(result.result, function(){
                             marker.setPosition( new google.maps.LatLng( this['lat'], this['lon'] ) );
                             map.panTo( new google.maps.LatLng( this['lat'], this['lon'] ) );
                             
                         });
		               }); 
                },0 ); 
                
    

            };
            
            
            initialize();
        
        
        </script>
	</body>
</html>