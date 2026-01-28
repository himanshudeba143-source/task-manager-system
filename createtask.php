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

<!-- Orbitron font -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<style>
*{margin:0; padding:0; box-sizing:border-box;}
body{font-family:Arial, sans-serif; background-color:#080710;}

/* Header */
header {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items:center;
    position: fixed;
    top:0;
    width: 100%;
    z-index: 9999;
}

header h1 {
    margin: 0;
     font-family: 'Orbitron', sans-serif;
    font-size: 24px;
    letter-spacing: 1px;
}

.header-right {
    display: flex;
    align-items: center;
}

.header-right img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    border: 2px solid white;
}

.header-right div {
    font-family: cursive;
    margin-right: 2px;
}

/* LAYOUT */
.wrapper{
    display:flex;
    margin-top:80px; /* space for fixed header */
}

/* SIDEBAR */
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
    width:240px;
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
    background: floralwhite;
    border-radius:6px;
    padding:15px;
    text-align:center;
    transition: all 0.25s ease;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
}
.menu-box a{
    font-size:20px;
    font-weight:bold;
    text-decoration:none;
    color:black;
    display:block;
}
.menu-box:hover{
    background:#222;
    transform: translateX(4px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
}
.menu-box:hover a{color:white;}
.menu-box.active{background:#222;}
.menu-box.active a{color:white;}



/* MAIN */
main {
    margin-left: 240px;
    padding: 20px;
    width:100%;
}

.instruction {
    background-color: antiquewhite;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 10px #080710;
}

.instruction h1{
    font-family:cursive;
}

/* HAMBURGER */
.hamburger{
    display:none;
    font-size:26px;
    cursor:pointer;
    margin-right:10px;
}


/* Main content */
main{
    margin-top:100px;
    margin-left:240px;
    padding:20px;
    min-height:calc(100vh - 120px);
}

/* White container for form */
.form-container{
    background:white;
    border-radius:10px;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
    max-width:700px;
    margin:20px 0 0 20px; /* top-left positioning */
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

/* Mobile */
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
</head>
<body>

<header>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <h1>TASK MANAGEMENT SYSTEM</h1>
    <div class="header-right">
        <img src="<?php echo $_SESSION['image']; ?>" alt="User Image">
        <div>
            <div>Email ID: <?php echo $_SESSION['email']; ?></div>
            <div>Username: <?php echo $_SESSION['uname']; ?></div>
        </div>
    </div>
</header>

<aside>
    <ul>
        <li><div class="menu-box"><a href="admindashboard.php">Dashboard</a></div></li>
        <li><div class="menu-box"><a href="list.php">Employees</a></div></li>
        <li><div class="menu-box active"><a href="createtask.php">Create Task</a></div></li>
        <li><div class="menu-box"><a href="managetask.php">Manage Task</a></div></li>
        <li><div class="menu-box leave-requests"><a href="updateleave.php">Leave Records</a></div></li>
        <li><div class="menu-box"><a href="profile1.php">Profile</a></div></li>
        <li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
    <div class="form-container">
        <div class="task-form">
            <div class="title-bar"><h2>CREATE TASK</h2></div>
            <form method="post" action="createtaskprocess.php">
                <table>
                    <tr>
                        <td><label for="user">Select User:</label></td>
                        <td>
                            <select id="user" name="uid" required>
                                <option disabled selected>~Select~</option>
                                <?php
                                $sql = "SELECT uid , Username FROM userlogin ORDER BY Username";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row['uid'].'">'.$row['Username'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="description">Description:</label></td>
                        <td><textarea id="description" name="description" rows="4" required placeholder="Type Message"></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="startdate">Start Date:</label></td>
                        <td><input type="date" id="startdate" name="startdate" required></td>
                    </tr>
                    <tr>
                        <td><label for="enddate">End Date:</label></td>
                        <td><input type="date" id="enddate" name="enddate" required></td>
                    </tr>
                </table>
                <button type="submit" name="submit">Create Task</button>
            </form>
        </div>
    </div>
</main>

<script>
function toggleMenu(){
    document.querySelector("aside").classList.toggle("show");
}
</script>

</body>
</html>
