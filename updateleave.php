<?php session_start(); ?>
<?php
  require_once('database1.php');
  $query="select * from leaveassigned where uid=$_SESSION[uid]";
  $result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
<title>Task Management System</title>

<style>
body, ul { margin:0; padding:0; }
body { font-family: Arial, sans-serif; background:#080710; }

/* HEADER */
header{
    background:#333;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    width:100%;
    z-index:9999;
}
header h1{
    margin:0;
    font-family:'Orbitron',sans-serif;
    font-size:24px;
    letter-spacing:1px;
}
.header-right{
    display:flex;
    align-items:center;
}
.header-right img{
    width:50px;height:50px;
    border-radius:50%;
    border:2px solid white;
    margin-right:10px;
}
.header-right div{font-family:cursive;}

/* LAYOUT */
.wrapper{display:flex;margin-top:80px;}

/* SIDEBAR */
aside{
    background:#444;
    color:white;
    width:200px;
    padding:20px;
    height:100vh;
    position:fixed;
    top:70px;
    left:0;
    transition:.3s;
}
ul{list-style:none;}
ul li{margin-bottom:10px;}

.menu-box{
    background:floralwhite;
    border-radius:6px;
    padding:15px;
    text-align:center;
    transition:.25s;
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
    transform:translateX(4px);
}
.menu-box:hover a{color:white;}
.menu-box.active{background:#222;}
.menu-box.active a{color:white;}

/* MAIN */
main{
    margin-left:240px;
    padding:20px;
    width:100%;
}

/* PAGE CONTENT */
.update-task-page{
    background:peachpuff;
    padding:20px;
    border-radius:8px;
}
.title-bar{
    background:#333;
    color:white;
    padding:16px 16px;
    border-radius:6px;
}

/* TABLE */
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{border:1px solid #ddd;padding:8px;text-align:left;}
th{background:#333;color:white}

/* HAMBURGER */
.hamburger{display:none;font-size:26px;cursor:pointer;}

@media(max-width:900px){
    .hamburger{display:block;}
    aside{left:-100%;}
    aside.active{left:0;}
    main{margin-left:0;}
    .header-right div{display:none;}
}
</style>
</head>

<body>

<header>
    <span class="hamburger" onclick="toggleMenu()">☰</span>
    <h1>TASK MANAGEMENT SYSTEM</h1>
    <div class="header-right">
        <img src="<?php echo $_SESSION['image']; ?>">
        <div>
            <div>Email ID: <?php echo $_SESSION['email']; ?></div>
            <div>Username: <?php echo $_SESSION['uname']; ?></div>
        </div>
    </div>
</header>

<div class="wrapper">

<aside id="sidebar">
    <ul>
        <li><div class="menu-box active"><a href="admindashboard.php">Dashboard</a></div></li>
        <li><div class="menu-box"><a href="list.php">Employees</a></div></li>
        <li><div class="menu-box"><a href="createtask.php">Create Task</a></div></li>
        <li><div class="menu-box"><a href="managetask.php">Manage Task</a></div></li>
        <li><div class="menu-box"><a href="updateleave.php">Leave Records</a></div></li>
        <li><div class="menu-box"><a href="profile1.php">Profile</a></div></li>
        <li><div class="menu-box"><a href="homepage.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
<div class="update-task-page">
    <div class="title-bar">
        <h2>LEAVE APPLICATIONS APPLIED</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Leave ID</th>
                <th>From</th>
                <th>To</th>
                <th>Contact</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row=mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $row['Leaveid']; ?></td>
                <td><?php echo $row['Startdate']; ?></td>
                <td><?php echo $row['Enddate']; ?></td>
                <td><?php echo $row['Contactno']; ?></td>
                <td><?php echo $row['Reason']; ?></td>
                <td><?php echo $row['Status']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</main>

</div>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}
</script>

</body>
</html>
