




<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>TechJunkGigs</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['ID','Sex','AgeCategory','BMI','PhysicalHealth','MentalHealth'],
 <?php 


$username = "root"; 
$password = "";   
$host = "127.0.0.1";
$database="sommar";

$db = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    printf("123123Connectaa failed: %s\n", mysqli_connect_error());
    exit();
}
/*  else {
 printf("Lyckades att hamta stuff");
echo $db;  
} */

			$query = "SELECT PK_ID as ID, Sex, AgeCategory, BMI, PhysicalHealth, MentalHealth
            FROM PrimTable 
            ORDER BY ID
            LIMIT 10";
            
                $exec = mysqli_query($db,$query);
                while($row = mysqli_fetch_array($exec)){
                echo "['".$row['ID']."',".$row['Sex']."',".$row['AgeCategory']."',".$row['BMI']."',".$row['PhysicalHealth']."',".$row['MentalHealth']."],";
                 }
            
			 ?> 



 
 ]);

 var options = {
 title: 'Number of Students according to their class',
  pieHole: 0.5,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
	
    </script>

</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>

</body>
</html>