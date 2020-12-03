<?php
// Create connection
$con=mysqli_connect("localhost","newuser","password","pss");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$result = mysqli_query($con,"SELECT * FROM event as e ORDER BY e.Date DESC");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>Date</th>
<th>Location</th>
<th>FundraiserName</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "<td>" . $row['FundraiserName'] . "</td>";
  
  echo "</tr>";
  }
echo "</table>";




mysqli_close($con);
?>
