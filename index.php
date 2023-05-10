<head>
 <title>Restraunt Menu</title>
 <style type="text/css">
  h1 { color:  red ; }
  h2 { font-family: Times New Roman; color: blue ; }
  p { font-family: Ariel; color: green}
  input[type=submit] {
     background-color: #4CAF50; /* Green */
     border: none;
     color: white;
     padding: 20px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 12px;
     margin: 4px 2px;
     cursor: pointer;
  }
 </style>
</head>
<body>
 <h1>Restraunt Menu Order Form</h1>
 <h2>Order</h2>
 <div>
<?php
	define ( 'DB_HOST', 'localhost' );
        define ( 'DB_USER', 'my_username' );
        define ( 'DB_PASSWORD', 'my_password' );
        define ( 'DB_NAME', 'my_database' );

	// Open database connection
	$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) ;

	if (!$conn) {
		echo mysqli_connect_errno().": ".mysqli_connect_error() ;
		die("<p>The database server is not available.</p>") ;
	}
	echo "<p>Database connection is open</p>" ;

	// Select database
	$DBSelect = @mysqli_select_db($conn, DB_NAME) ;
	if (!$DBSelect) {
		die("<p>The database is not available.</p>") ;
	}
	echo "<p>Successfully opened the database.</p>" ;

	if (isset($_POST['PickupName']) && isset($_POST['Number']) && isset($_POST['Order']) && isset($_POST['PickUpTime'])) {
		$pickupName = filter_var($_POST['PickupName'], FILTER_SANITIZE_STRING) ;
		$phoneNumber = filter_var($_POST['PhoneNumber'], FILTER_SANITIZE_STRING) ; 
		$order = filter_var($_POST['Order'], FILTER_SANITIZE_STRING) ; 
		$pickUpTime = filter_var($_POST['PickUpTime'], FILTER_SANITIZE_STRING) ; 
	
		
		 // Disply query result
                $Row = @mysqli_fetch_row($ResultSet) ;
		$Order = $Row[0] + 1 ;
		
		$query = "INSERT INTO Orders (pickup_name, phoneNumber, order, PickUpTime) VALUES (".$pickupName.", '".$pickupName."', '".$order."', '".$pickUpTime."')" ;
		echo "<p>".$query."</p>" ;
		$ResultSet = @mysqli_query($conn, $query) 
			Or die("<p>Unable to execute the update</p>"
				."<p>Error code: ".mysqli_errno($conn).": "
				.mysqli_error($conn))."</p>" ;
		echo "<p>Successfully updated ".mysqli_affected_rows($conn)." record(s).</p>" ;
	}

	// Close the database connection
	mysqli_close($conn) ;
?>
</div>
</body>
