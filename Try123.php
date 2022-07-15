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


    $sqlquery = "
    SELECT PK_ID as ID, Sex, AgeCategory, BMI, PhysicalHealth, MentalHealth
    FROM PrimTable 
    LIMIT 20;
    ";

    $result = mysqli_query($db,$sqlquery);

/* 
    $query = mysqli_query($myquery); */

    if ( ! $result ) {
        echo mysqli_error();
        die;
    }

    $data = array();

    for ($x = 0; $x < mysqli_num_rows($result); $x++) {
        $data[] = mysqli_fetch_assoc($result);
    }






    


/* prepare statement */
$stmt = mysqli_prepare($db, "SELECT PK_ID as ID, Sex, AgeCategory, BMI, PhysicalHealth, MentalHealth
FROM PrimTable 
ORDER BY ID
LIMIT 10;
");
mysqli_stmt_execute($stmt);

/* bind variables to prepared statement */
mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6);

/* fetch values */
while (mysqli_stmt_fetch($stmt)) {
    /* printf("%s dd %s\n", $col1, $col2, $col3, $col4, $col5, $col6); */
    echo "ID:";
    printf($col1);
    echo "SEX:";
    printf($col2);
    echo "AGE:";
    printf($col3);
    echo "BMI:";
    printf($col4); 
    echo "PHYSICAL:";
    printf($col5);
    echo "MENTAL:";
    printf($col6);
    echo "</br>";
}
echo "</br>";
echo $col2;

$output = "['Kon','Fordelning'],['ID',$col1],['Sex', $col2]";

$table1 = array();
$table2 = array();












$query = "SELECT PK_ID as ID, Sex
FROM PrimTable 
ORDER BY ID
LIMIT 10";

	$exec = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($exec)){
	echo "['".$row['ID']."',".$row['Sex']."]";
	 }






?>

<!DOCTYPE html>
<html lang="sv" xmlns="http://www.w3.org/1999/ xhtml">
  <head>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});

      google.charts.setOnLoadCallback(drawChart1);

function drawChart1() { // Första grafen!

  var data = new google.visualization.arrayToDataTable([
    ['ID','Sex'],

    
  ]);

  var options = {
    title: 'Alla människor uppdelat i procent'
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>


<meta charset="ISO-8859-1">
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Charts - Visualisering</title>
    </style>
  </head>
  <body>

<div id="piechart" style="width: 900px; height: 500px;"></div> <!-- Graph 1 -->

  </body>
  <footer>
  </footer>
  </html>