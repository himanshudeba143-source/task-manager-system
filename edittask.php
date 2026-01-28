<?php
session_start();
require_once('database1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<style>
*{margin:0; padding:0; box-sizing:border-box;}
body{font-family:Arial, sans-serif; background-color:#080710;}

/* Header */
header{
    background-color:#333;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0; width:100%; z-index:1000;
}
header h1{
    font-family:'Orbitron', sans-serif;
    font-size:1.5rem;
    letter-spacing:0.02cm;
}
.header-right{
    display:flex;
    align-items:center;
}
.header-right img{
    width:50px;
    height:50px;
    border-radius:50%;
    margin-left:10px;
    border:2px solid white;
}

/* Hamburger toggle */
.menu-toggle{
    display:none;
    font-size:28px;
    cursor:pointer;
    margin-right:10px;
}

/* Sidebar */
aside{
    background-color:#444;
    color:white;
    width:200px;
    padding:20px;
    height:100vh;
    position:fixed;
    top:70px;
    left:0;
    transition: transform 0.3s ease;
    z-index:999;
}
aside.show{transform:translateX(0);}
ul{list-style:none;}
ul li{margin-bottom:10px;}

/* Menu box */
.menu-box{
    background-color: floralwhite;
    border-radius:6px;
    padding:18px;
    text-align:center;
    transition: all 0.25s ease;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
    display:flex;
    align-items:center;
    justify-content:center;
}
.menu-box a{
    font-size:18px;
    font-weight:bold;
    text-decoration:none;
    color:black;
    display:block;
}
.menu-box:hover{
    background:#222;
    transform: translateX(4px);
    box-shadow:0 6px 12px rgba(0,0,0,0.3);
}
.menu-box:hover a{color:white;}
.menu-box.active{background:#222;}
.menu-box.active a{color:white;}

/* Main content */
main{
    margin-top:100px;
    margin-left:240px;
    padding:20px;
    min-height:calc(100vh - 120px);
}

/* White container around form */
.form-container{
    background:white;
    border-radius:10px;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
    max-width:700px;
    margin:20px 0 0 20px;
}

/* Task form inside container */
.task-form{
    background:navajowhite;
    border-radius:10px;
    padding:15px;
    width:100%;
}
.task-form table{width:100%;}
.task-form td{
    padding:8px;
    vertical-align:middle;
    font-weight:bold;
    white-space:nowrap;
}
.task-form input,
.task-form select,
.task-form textarea{
    width:100%;
    padding:10px;
    border:1px solid black;
    border-radius:5px;
    outline:none;
    font-size:16px;
}
.task-form input:focus,
.task-form select:focus,
.task-form textarea:focus{
    border-color:#333;
    box-shadow:0 0 5px rgba(0,0,0,0.2);
}
.task-form input::placeholder,
.task-form textarea::placeholder{
    color:#666;
    font-style:italic;
}

/* Button hover */
.task-form button{
    margin-top:15px;
    background-color:#333;
    color:white;
    border:none;
    padding:10px 25px;
    border-radius:5px;
    cursor:pointer;
}
.task-form button:hover{
    background-color:white;
    color:black;
}

/* Title bar */
.title-bar{
    background-color:#333;
    color:white;
    padding:10px 20px;
    border-top-left-radius: 5px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 5px;
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
    text-align:left;
}

/* Mobile responsiveness */
@media(max-width:768px){
    .menu-toggle{display:block;}
    aside{transform:translateX(-100%); position:fixed; top:70px; left:0;}
    aside.show{transform:translateX(0);}
    main{margin-left:20px; margin-right:20px;}
    .form-container{margin:20px; max-width:calc(100% - 40px);}
    .task-form input,
    .task-form select,
    .task-form textarea{font-size:14px; padding:8px;}
    header h1{font-size:1.5rem;}
}
</style>

<script>
function toggleMenu(){
    document.querySelector("aside").classList.toggle("show");
}

function updateUsername(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    document.getElementById('username').value = selectedOption.text;
}
</script>

</head>
<body>
<header>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <h1>TASK MANAGEMENT SYSTEM</h1>
    <div class="header-right">
        <img src="<?php echo isset($_SESSION['image']) ? $_SESSION['image'] : ''; ?>" alt="User Image">
        <div>
            <div>Email ID: <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></div>
            <div>Username: <?php echo isset($_SESSION['uname']) ? $_SESSION['uname'] : ''; ?></div>
        </div>
    </div>
</header>

<aside>
    <ul>
        <li><div class="menu-box"><a href="admindashboard.php">Dashboard</a></div></li>
        <li><div class="menu-box"><a href="list.php">Employees</a></div></li>
        <li><div class="menu-box active"><a href="createtask.php">Create Task</a></div></li>
        <li><div class="menu-box"><a href="managetask.php">Manage Task</a></div></li>
        <li><div class="menu-box leave-requests"><a href="updateleave.php">Leave Applications</a></div></li>
        <li><div class="menu-box"><a href="profile1.php">Profile</a></div></li>
        <li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
    <div class="form-container">
        <div class="task-form">
            <?php
            if(isset($_GET['Taskid']) && !empty($_GET['Taskid'])) {
                $Taskid = intval($_GET['Taskid']);
                $query = "SELECT * FROM taskassigned WHERE Taskid = '$Taskid'";
                $result = $con->query($query);
                if($result && $result->num_rows > 0){
                    $row = $result->fetch_assoc();
            ?>
            <form method="post" action="edittaskprocess.php?Taskid=<?php echo $Taskid; ?>">
                <div class="title-bar">
                    <h2>EDIT TASK</h2>
                </div>
                <table>
                    <tr>
                        <td><label for="user">Select User:</label></td>
                        <td>
                            <select id="user" name="uid" onchange="updateUsername(this)" required>
                                <option disabled selected>~Select~</option>
                                <?php
                                $sql = "SELECT uid, Username FROM userlogin ORDER BY Username";
                                $userResult = $con->query($sql);
                                if($userResult && $userResult->num_rows > 0) {
                                    while($row2 = $userResult->fetch_assoc()) {
                                        $selected = $row['uid'] == $row2['uid'] ? 'selected' : '';
                                        echo "<option $selected value='" . $row2['uid'] . "'>" . $row2['Username'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" id="username" name="uname" value="<?php echo $row['Username']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description:</label></td>
                        <td><textarea id="description" name="description" rows="4" required placeholder="Type Message"><?php echo $row['Description']; ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="startdate">Start Date:</label></td>
                        <td><input type="date" id="startdate" name="startdate" required value="<?php echo $row['Startdate']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="enddate">End Date:</label></td>
                        <td><input type="date" id="enddate" name="enddate" required value="<?php echo $row['Enddate']; ?>"></td>
                    </tr>
                </table>
                <input type="hidden" name="Taskid" value="<?php echo $Taskid; ?>">
                <button type="submit" name="submit">Modify</button>
            </form>
            <?php
                } else {
                    echo "<p style='color:red;text-align:center;'>Task not found.</p>";
                }
            } else {
                echo "<p style='color:red;text-align:center;'>Invalid Task ID.</p>";
            }
            ?>
        </div>
    </div>
</main>
</body>
</html>
