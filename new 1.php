<?php session_start();?>
<?php
require_once('database1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        /* Reset some default styles for a cleaner look */
        body, ul {
            margin: 0;
            padding: 0;
        }

        /* Define the overall page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #080710;
        }

        /* Header styles */
        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }

            header h1 {
                margin: 0;
                font-family: "Cascadia Mono";
            }

        /* Sidebar styles */
        aside {
            background-color: #444;
            color: white;
            width: 200px;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        /* Sidebar menu styles */
        ul {
            list-style: none;
            padding: 0;
        }

            ul li {
                margin-bottom: 8px;
            }

        /* Content styles */
        main {
            margin-top: 30px;
            margin-left: 250px;
            margin-right: 400px;
            padding: 10px;
            background-color: navajowhite;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Box styles for menu items */
        .menu-box {
            background-color: floralwhite;
            border: 1px solid double;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

            .menu-box a {
                font-size: 23px;
                font-weight: bold;
                text-decoration: none;
            }

        .title-bar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 5px;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
        }

            .title-bar h2 {
                margin: 0;
            }

        /* Form styles */
        .task-form {
            padding: 0px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

            .task-form label {
                font-weight: bold;
            }

            .task-form select, .task-form input[type="text"], .task-form input[type="date"] {
                margin-top: 2px;
                width: 200%;
                padding: 10px;
                margin-bottom: auto;
            }

            .task-form button {
                background-color: #333;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }
    </style>
</head>
<body>
    <header>
        <h1>TASK MANAGEMENT SYSTEM</h1>
        <div>
            <div>Email ID: <?php echo $_SESSION['email'];?></div>
            <div>Username: <?php echo $_SESSION['uname'];?></div>
        </div>
    </header>
    <aside>
        <ul>
            <li>
                <div class="menu-box">
                    <a href="https://localhost:44338/Admin%20Dashboard.html">Dashboard</a>
                </div>
            </li>
            <li>
                <div class="menu-box">
                    <a href="createtask.php">Create Task</a>
                </div>
            </li>
            <li>
                <div class="menu-box">
                   <a href="managetask.php">Manage task</a>
                </div>
            </li>
            <li>
                <div class="menu-box">
                    <a href="">Leave Applications</a>
                </div>
            </li>
            <li>
                <div class="menu-box">
                    <a href="https://localhost:44338/Admin%20Profile.html">Profile</a>
                </div>
            </li>
            <li>
                <div class="menu-box">
                    <a href="index.php">Log Out</a>
                </div>
            </li>
        </ul>
    </aside>

    <main>
	
        <div class="task-form">
		<?php
		$Taskid = $_GET['Taskid'];
		?>
            <form method="post" action="edittaskprocess.php?Taskid=<?php echo $Taskid;?>">
			<?php
				$query="select * from taskassigned where `Taskid` = '$Taskid'";
				$result=mysqli_query($con,$query);
				if($result->num_rows == 1)
				{
					$row = $result->fetch_assoc();
			?>
                <div class="title-bar">
                    <h2><b>EDIT TASK</b></h2>
                </div>
                <table>
                    <tr>
                        <td><label for="user">Select User:</label></td>
                        <td>					
                            <select id="user" name="uname"  required >
							<option disabled selected required>~Select~</option>
                            <?php
                                    
                                    $sql = "SELECT uid , Username FROM userlogin ORDER BY Username";
                                    $result = $con->query($sql);
                                   
                                    if ($result->num_rows > 0) 
									{
                                        while($row2 = $result->fetch_assoc()) 
										{
											$selected = $row['Username'] == $row2['Username'] ? 'selected':'';
                                            echo "<option $selected value=" . $row2["Username"] . ">" . $row2["Username"] . "</option>";
                                        }
                                    } 
									else 
									{
                                        echo "<option value=''>No users found</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td> <label for="description">Description:</label></td>
                        <td><textarea id="description" name="description" rows="4" style="width: 170%;" required placeholder="Type Message"><?= $row['Description']?></textarea></td>
                    </tr>
                    </br>
                    <tr>
                        <td> <label for="startdate">Start Date:</label></td>
                        <td> <input type="date" id="startdate" name="startdate" required placeholder="Enter start-date" value="<?= $row['Startdate']?>"></td>
                    </tr>
                    </br>
                    <tr>
                        <td> <label for="enddate">End Date:</label></td>
                        <td><input type="date" id="enddate" name="enddate" required placeholder="Enter end-date" value="<?= $row['Enddate']?>"></td>
                    </tr> </br>
                </table>
				<input type="hidden" name="Taskid" value="<?= $Taskid; ?>">
                <button type="submit" name="submit">Modify</button>
<?php
}

?>
            </form>
        </div>
    </main>
</body>
</html>



<?php
require_once('database1.php');
$Taskid= isset($_POST['Taskid'])?$_POST['Taskid']:null;

if( $Taskid != null && $_SERVER['REQUEST_METHOD'] == "POST")
{
	
        if(isset($_POST['submit']))
		{
			//$uid = $_POST['uid'];           		
			$Username = $_POST['uname']; 
			$Description = $_POST['description']; 
			$Startdate= $_POST['startdate'];
			$Enddate = $_POST['enddate'];
			$query = "update taskassigned set  Username = '$Username', Description = '$Description', Startdate = '$Startdate',  Enddate = '$Enddate' where `Taskid` = $Taskid";
			$result = mysqli_query($con, $query);
			if($result){ echo "<script>alert('Data updated successfully');window.location.href='managetask.php';</script>"; }
			else{echo "<script>alert('Something went wrong, please try again later.');window.location.href='managetask.php';</script>"; }
			   
			
		}
}
else
{
	header('Location: managetask.php');
}
?>
