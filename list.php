<?php session_start();?>
<?php
  require_once('database1.php');
  $query="select * from taskassigned";
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
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:Arial, sans-serif;background:#080710;overflow-x:hidden;}

/* HEADER */
header{
    background:#333;color:white;
    padding:10px 15px;
    display:flex;
    align-items:center;
    position:fixed;
    top:0;width:100%;
    z-index:9999;
    min-height:70px;
}
.hamburger{
    display:none;
    font-size:26px;
    cursor:pointer;
    position:absolute;
    right:15px;
    top:15px;
}
header h1{
    font-family:'Orbitron',sans-serif;
    font-size:20px;
    white-space:nowrap;
}
.header-right{
    display:flex;
    align-items:center;
    margin-left:auto;
}
.header-right img{
    width:50px;height:50px;
    border-radius:50%;
    border:2px solid white;
    margin-right:10px;
}
.user-info{
    font-size:15px;
    line-height:1.3;
}

/* SIDEBAR */
aside{
    background:#444;color:white;
    width:240px;
    padding:20px;
    height:100vh;
    position:fixed;
    top:70px;
    left:0;
    transition:transform 0.3s ease;
    z-index:999;
}
ul{list-style:none;}
ul li{margin-bottom:10px;}

.menu-box{
    background:floralwhite;
    border-radius:6px;
    padding:15px;
    text-align:center;
    transition:0.25s;
}
.menu-box a{
    font-size:20px;
    font-weight:bold;
    text-decoration:none;
    color:black;
}
.menu-box:hover{background:#222;}
.menu-box:hover a{color:white;}
.menu-box.active{background:#222;}
.menu-box.active a{color:white;}

/* MAIN DESKTOP */
main{
    margin-left:240px;
    margin-top:80px;
    padding:20px;
    max-width:calc(100% - 240px);
    background:white;
    min-height:100vh;
}

/* PAGE */
.update-task-page{
    background:peachpuff;
    padding:20px;
    border-radius:10px;
}
.title-bar{
    background:#333;color:white;
    padding:8px;
    text-align:center;
    border-radius:10px;
    margin-bottom:15px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ddd;
    padding:8px;
}
th{background:#333;color:white;}

/* ACTION BUTTONS */
.action-cell{
    display:flex;
    gap:10px;
}
.action-btn{
    padding:10px 18px;
    font-size:15px;
    font-weight:bold;
    border-radius:6px;
    border:1px solid #333;
    cursor:pointer;
    text-decoration:none;
    min-height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.edit-btn{background:#d4edda;}
.delete-btn{background:#f8d7da;}

/* ================= MOBILE ================= */
@media(max-width:768px){

    .hamburger{display:block;}

    aside{
        transform:translateX(-100%);
        top:120px;
        height:calc(100vh - 120px);
    }
    aside.active{transform:translateX(0);}

    header{
        flex-direction:column;
        align-items:flex-start;
        min-height:120px;
    }

    header h1{
        font-size:16px;
        margin-bottom:6px;
    }
    

    .header-right{
        margin-left:0;
    }
     .header-right img{
        width:42px;
        height:42px;
    }

    .email-text{font-size:13px;}
    .user-text{font-size:12px;}


    main{
        margin-left:0;
        max-width:100%;
        margin-top:130px;
        padding:10px;
    }

    /* CARD TABLE */
    table, thead, tbody, th, td, tr{
        display:block;
        width:100%;
    }
    thead{display:none;}

    tr{
        background:#ffe4c4;
        margin-bottom:15px;
        border-radius:12px;
        padding:12px;
        box-shadow:0 4px 10px rgba(0,0,0,0.3);
    }

    td{
        border:none;
        display:flex;
        justify-content:space-between;
        padding:6px 4px;
    }

    td::before{font-weight:bold;}

    td:nth-child(1)::before{content:"Task ID";}
    td:nth-child(2)::before{content:"Employee";}
    td:nth-child(3)::before{content:"Description";}
    td:nth-child(4)::before{content:"Start Date";}
    td:nth-child(5)::before{content:"End Date";}
    td:nth-child(6)::before{content:"Status";}
    td:nth-child(7)::before{content:"Action";}

    .action-cell{
        width:100%;
        justify-content:space-between;
    }

    .action-btn{
        width:48%;
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
        <div class="user-info">
            <div>Email ID: <?php echo $_SESSION['email']; ?></div>
            <div>Username: <?php echo $_SESSION['uname']; ?></div>
        </div>
    </div>
</header>

<aside id="sidebar">
<ul>
<li><div class="menu-box"><a href="admindashboard.php">Dashboard</a></div></li>
<li><div class="menu-box"><a href="list.php">Employees</a></div></li>
<li><div class="menu-box"><a href="createtask.php">Create Task</a></div></li>
<li><div class="menu-box active"><a href="managetask.php">Manage Task</a></div></li>
<li><div class="menu-box"><a href="updateleave.php">Leave Records</a></div></li>
<li><div class="menu-box"><a href="profile1.php">Profile</a></div></li>
<li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
</ul>
</aside>

<main>
<div class="update-task-page">
<div class="title-bar"><h2>TASKS ASSIGNED TO USERS</h2></div>

<table>
<thead>
<tr>
<th>Task ID</th>
<th>Employee</th>
<th>Description</th>
<th>Start Date</th>
<th>End Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['Taskid']; ?></td>
<td><?php echo $row['Username']; ?></td>
<td><?php echo $row['Description']; ?></td>
<td><?php echo $row['Startdate']; ?></td>
<td><?php echo $row['Enddate']; ?></td>
<td><?php echo $row['Status']; ?></td>
<td class="action-cell">
<a href="edittask.php?Taskid=<?php echo $row['Taskid']; ?>" class="action-btn edit-btn">Edit</a>
<button class="action-btn delete-btn">Delete</button>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</main>

</body>
</html>
