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

  
    /* echo json_encode($data); */

    //write to json file
    $fp = fopen('MySQL1.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);   

    mysqli_close($db);
?>