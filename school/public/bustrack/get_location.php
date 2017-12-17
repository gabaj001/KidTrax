<?php
    //$busno = $_GET['busno'];
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','root');
	define('DB','studenttracking');

    $busno = $_GET['busno'];
	

  
	//echo $studentid . '     ' . $busno;

	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	
	$sql = "SELECT BusNo, DriverName, SchoolNo, lat, lon,";
	$sql .="latlondate, latlontime ";
	$sql .="FROM schoolbus ";
	$sql .=" WHERE BusNo =" . $busno;
	
	//echo $sql;
	
	$res = mysqli_query($con,$sql);
	
	$result = array();
	
	while($row = mysqli_fetch_array($res)){
		
        array_push($result,array('lat'=>$row['lat'],'lon'=>$row['lon']));
        
	}
	
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>