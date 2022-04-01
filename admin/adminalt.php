<!DOCTYPE html>
<html>
    <head>
        <title>
            Admin Seite
        </title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
    <h1>Admin Seite</h1>

    
    
    <form action="" method="post">
    <table id="users">
  
  <thead>
    <th>User-ID</th>
    <th>Last-Name</th>
    <th>First-Name</th>
    <th>Birthdate</th>
    <th>Phonenumber</th>
    <th>Position</th>
    <th>Email</th>
    <th>Username</th>
    <th>Password</th>
    <th colspan="2">Delete</th>
  </thead>
  
  <tbody>

  <?php
  require("../database/dbConnect.php");

  if(isset($_POST['act1'])){
    $userID = $_POST['user_id'];
    if($userID != "cancel")
      deleteUser($userID);
  }
  ?>


  <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "propra";
    $row = '';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT * from user";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {?>
        <tr>
      <!-- <td data-label="User-ID">Ken Griffey Jr.</td> -->
      <td><?php echo $row['userID']; ?></td>
      <td><?php echo $row['lastName']; ?></td>
      <td><?php echo $row['firstName']; ?></td>
      <td><?php echo $row['birthdate']; ?></td>
      <td><?php echo $row['phonenumber']; ?></td>
      <td><?php echo $row['position']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td><input type="submit" name="act1" value="Löschen" onClick="deleteConfirm(1)" class="delete"/></td>
      <td><input type="submit" name="act2" value="Bearbeiten" onClick="deleteConfirm(2)" class="delete" formaction="./editUser.php"/></td>
    </tr>
    <?php }?>
    <?php
    } else {
      //echo "0 results";
    }
    $conn->close();
    ?>

    

    <input type="hidden" name="user_id" id="user_id" />
    
  </tbody>
 
</table>

    


<!-- <button type="submit" class="login__submit">Benutzer Einfügen</button> -->

<a href="../register/register.php" class="button">Benutzer Einfügen</a>
<script>
function deleteConfirm(a) {
			let thetable = document.getElementById('users')
					.getElementsByTagName('tbody')[0];
			for (let i = 0; i < thetable.rows.length; i++) {
				thetable.rows[i].onclick = function() {
					TableRowClick(this, a);
				};
			}
		}

    function TableRowClick(therow, y) {
			let msg = therow.cells[0].innerHTML;
			if (y == 1) {
				var r = confirm("Do you want to delete the user " + msg + "?");
				if (r != true) {
					msg = "cancel";
				}
				document.getElementById('user_id').value = msg;
			} else {
				// var r = confirm("Do you want to edit the user " + msg + "?");
				// if (r != true) {
				// 	msg = "cancel";
				// }
				document.getElementById('user_id').value = msg;
			}
		};
</script>
    </body>
</html>