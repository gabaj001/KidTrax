<?php
    //$busno = $_GET['busno'];
	define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','root');
	define('DB','studenttracking');

    $studentinfo = $_GET['studentinfo'];
	
	//$pos = strpos($studentinfo,"-");
	//$studentid = substr($studentinfo,0,$pos);
	//$busno = substr($studentinfo,$pos+1);

	$values = explode("-",$studentinfo);

    //echo $values[0] . " " . $values[1] . " " . $values[2];  
	//echo $studentid . '     ' . $busno;

	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	
	$sql = "SELECT bs.BusNo, bs.DriverName, bs.SchoolNo, bs.lat, bs.lon,";
	$sql .="bs.latlondate, bs.latlontime,std.studentID, std.BusNo ";
	$sql .="FROM schoolbus bs ";
	$sql .="INNER JOIN studentinfo std ";
	$sql .=" ON bs.BusNo = std.BusNo ";
	//$sql .=" WHERE std.studentID =" . $values[0];
	$sql .=" WHERE std.BusNo =" . $values[0];
	$sql .=" AND bs.SchoolNo =" . $values[1];	
	
	
	
	$res = mysqli_query($con,$sql);
	
	$result = array();
	
	while($row = mysqli_fetch_array($res)){
		
        array_push($result,array('lat'=>$row['lat'],'lon'=>$row['lon']));
        
	}
	
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>