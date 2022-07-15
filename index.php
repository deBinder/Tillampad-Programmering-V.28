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
    else {
    printf("Lyckades att hamta stuff");
    //echo $db; 
    }


    $sqlquery = "
    SELECT PK_ID as ID, Sex, AgeCategory, BMI, PhysicalHealth, MentalHealth
    FROM PrimTable 
    LIMIT 50;
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
LIMIT 50;
");
mysqli_stmt_execute($stmt);

/* bind variables to prepared statement */
mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6);

/* fetch values */
while (mysqli_stmt_fetch($stmt)) {
    printf("%s %s\n", $col1, $col2, $col3, $col4, $col5, $col6);
}




    echo "<pre>";
 //   print_r($data);
  echo "</pre>";

$female = 0;
$male = 0;

foreach($data as $key => $value) {
  echo "<pre>";
  print_r($value);
   echo "</pre>";

   echo $value['Sex'];

if($value['Sex'] == "Female") {
  $female++;
}
if($value['Sex'] == "Male") {
  $male++;
}

}

$output = "['Kon','Fordelning'],['Kvinnor',$female],['Man',$male]";

print_r($output);

echo "<br>";
echo "<br>";
echo $female;
echo "<br>";
echo $male;

echo json_encode($data);

    /* echo json_encode($data); */

    //write to json file
    $fp = fopen('MySQL1.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);   

    mysqli_close($db);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	google.charts.load("current", {packages: ["corechart"]});

      google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {

  var data = new google.visualization.arrayToDataTable([
    <?php echo $output; ?>
  ]);

  var options = {
    title: 'My Daily Activities'
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 1900px; height: 100px; padding: 50px;"></div>

    <div id="piechart" style="width: 900px; height: 500px;"></div>

    <?php echo json_encode($output); ?>

    <?php echo $output; ?>
  </body>
</html>