<?php session_start();?>
<?php
  require_once('database1.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<title>Task Management System</title>

<style>
body, ul {margin:0;padding:0;}
body {font-family: Arial, sans-serif;background-color:#080710;}

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
    margin:0;
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
    margin-right: 19px;
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


/* HAMBURGER */
.hamburger{
    display:none;
    font-size:26px;
    cursor:pointer;
    margin-right:10px;
}

/* Main */
main{
    margin-top:80px;
    margin-left:240px;   /* FIXED SIZE MISMATCH */
    padding:13px;
    background:black;
}

/* Page */
.update-task-page{
    background:peachpuff;
    padding:12px;
    border-radius:7px;
}

.title-bar{
    background:#333;
    color:white;

    height: 32px;                 /* control bar height */
    padding: 13px 13px;

    display: flex;
    align-items: center;          /* vertical centering */

   /* font-size: 14px;*/
    line-height: 1;               /* 🔥 THIS IS KEY */

    border-top-left-radius: 5px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 5px;

    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
}

/* Table */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    min-width:600px;
}
th,td{
    border:1px solid #ddd;
    padding:8px;
}
th{background:#333;color:white;}

.update-button{
    background:black;
    color:white;
    border:none;
    padding:5px 10px;
    border-radius:5px;
    cursor:pointer;
}
.update-button:hover{
    background:green;
}

/* Select */
.styled-select{
    position:relative;
    width:120px;
    margin:0 auto;
}
.styled-select select{
    width:100%;
    padding:5px;
    border:2px solid #333;
    border-radius:5px;
}

/* ================= MOBILE ================= */
@media(max-width:768px){

header{
        flex-wrap: wrap;
        padding: 10px 12px;
    }

    /* TOP ROW */
    .hamburger{
        display: block;
        font-size: 26px;
        position: absolute;
        left: 14px;
        top: 7px;
    }

    header h1{
        width: 100%;
        text-align: center;
        font-size: 16px;
        margin: 0;
        padding: 6px 0 4px;
    }

    /* SECOND ROW INLINE */
    .header-right{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 6px;
    }

    .header-right img{
        width: 40px;
        height: 40px;
        margin: 0;
        flex-shrink: 0;
    }

     .header-right div{
        display: flex;
        flex-direction: column;
        font-size: 12px;
        text-align: left;
        line-height: 1.3;
        font-family: 'Monospace', sans-serif;
    }
    .title-bar{
        padding:10px 10px;
    }


    /* ===== SIDEBAR ===== */
    aside{
        position: fixed;
        top: 110px; /* BELOW header */
        left: -100%;
        height: calc(100vh - 110px);
        z-index: 999;
    }

    aside.active{
        left: 0;
    }

    /* ===== MAIN ===== */
    main{
        margin-left: 0;
        padding-top: 85px;
    }
    .update-task-page{
    background:peachpuff;
    padding:6px;
    border-radius:7px;
}
}

</style>

<script>
function toggleMenu(){
    document.getElementById("sidebar").classList.toggle("active");
}
</script>
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

<aside id="sidebar">
<ul>
<li><div class="menu-box"><a href="userdashboard.php">Dashboard</a></div></li>
<li><div class="menu-box active"><a href="updatetask.php">Update Task</a></div></li>
<li><div class="menu-box"><a href="applyleave.php">Apply Leave</a></div></li>
<li><div class="menu-box"><a href="manageleave.php">Leave Status</a></div></li>
<li><div class="menu-box"><a href="profile.php">Profile</a></div></li>
<li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
</ul>
</aside>

<main>
<div class="update-task-page">
<div class="title-bar">
<h2>UPDATE TASK</h2>
</div>

<div class="table-wrapper">
<table>
<thead>
<tr>
<th>Sno</th>
<th>Description</th>
<th>Start Date</th>
<th>End Date</th>
<th>Status</th>
<th>Action</th>
<th></th>
</tr>
</thead>

<tbody>
<?php 
$query="select * from taskassigned where uid=$_SESSION[uid]";
$sno=1;
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<form method="POST" action="updatetaskprocess.php">
<td><?php echo $sno; ?></td>
<td><?php echo $row['Description']; ?></td>
<td><?php echo $row['Startdate']; ?></td>
<td><?php echo $row['Enddate']; ?></td>
<td><?php echo $row['Status']; ?></td>

<td>
<div class="styled-select">
<select name="action" required>
<option disabled selected>~Select~</option>
<option <?= $row['Status']=='In-Progress'?'selected':'';?> value="In-Progress">In-Progress</option>
<option <?= $row['Status']=='Completed'?'selected':'';?> value="Completed">Completed</option>
</select>
</div>
</td>

<td>
<input type="hidden" name="Taskid" value="<?php echo $row['Taskid']; ?>">
<button type="submit" class="update-button">UPDATE</button>
</td>
</form>
</tr>
<?php $sno++; } ?>
</tbody>
</table>
</div>

</div>
</main>
</body>
</html>
