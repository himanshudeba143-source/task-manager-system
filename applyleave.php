<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:Arial, sans-serif;
    background-color:#080710;
}

/* ================= HEADER ================= */
header{
    background-color:#333;
    color:white;
    padding:8px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    width:100%;
    z-index:9999;
}

header h1{
    font-family:'Orbitron', sans-serif;
    font-size:24px;
    letter-spacing:1px;
}

.header-right{
    display:flex;
    align-items:center;
}

.header-right img{
    width:50px;
    height:50px;
    border-radius:50%;
    border:2px solid white;
    margin-right:10px;
}

.header-right div{
    font-family:cursive;
    margin-right:20px;
}

/* ================= HAMBURGER ================= */
.hamburger{
    display:none;
    font-size:26px;
    cursor:pointer;
    margin-right:10px;
}

/* ================= SIDEBAR ================= */
aside{
    background:#444;
    color:white;
    width:240px;
    padding:20px;
    height:100vh;
    position:fixed;
    top:70px;
    left:0;
    transition:0.3s;
    z-index:999;
}

aside ul{list-style:none;}
aside li{margin-bottom:10px;}

.menu-box{
    background:floralwhite;
    padding:15px;
    border-radius:6px;
    text-align:center;
    transition:0.25s;
}

.menu-box a{
    text-decoration:none;
    color:black;
    font-weight:bold;
    font-size:20px;
}

.menu-box:hover{
    background:#222;
    transform:translateX(4px);
}

.menu-box:hover a,
.menu-box.active a{
    color:white;
}

.menu-box.active{
    background:#222;
}

/* ================= MAIN ================= */
main{
    margin-left:240px;
    padding:20px;
    margin-top:80px;
}

/* ================= FORM ================= */
.form-container{
    background:white;
    max-width:650px;
    padding:20px;
    border-radius:10px;
    box-shadow:0 6px 15px rgba(0,0,0,0.3);
}

.task-form{
    background:navajowhite;
    padding:15px;
    border-radius:10px;
}

.task-form table{width:100%;}

.task-form td{
    padding:10px;
    font-weight:bold;
}

.task-form input,
.task-form textarea{
    width:100%;
    padding:10px;
    border:2px solid black;
    border-radius:5px;
    font-size:16px;
}

.task-form button{
    margin-top:15px;
    padding:10px;
    width:50%;
    background:#333;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.task-form button:hover{
    background:white;
    color:black;
}

.title-bar{
    background:#333;
    color:white;
    padding:10px;
    text-align:center;
    border-radius:8px;
    margin-bottom:15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 5px;

    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
}

/* ================= MOBILE ================= */
@media(max-width:768px){

    header{
        flex-wrap:wrap;
        padding:10px 12px;
    }

    .hamburger{
        display:block;
        position:absolute;
        left:14px;
        top:7px;
    }

    header h1{
        width:100%;
        text-align:center;
        font-size:16px;
        padding:6px 0 4px;
        margin-left:23px;
    }

    .header-right{
        width:100%;
        justify-content:center;
        gap:10px;
        margin-top:6px;
        margin-left:23px;
    }

    .header-right img{
        width:43px;
        height:43px;
        margin:0;
    }

    .header-right div{
        display:flex;
        flex-direction:column;
        font-size:12px;
        line-height:1.3;
        font-family:monospace;
    }

    aside{
        top:110px;
        left:-100%;
        height:calc(100vh - 110px);
    }

    aside.active{
        left:0;
    }

    main{
        margin-left:0;
        padding-top:130px;
    }
    .form-container{
        margin-top:-50px;
        padding:13px;
    }
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

<aside>
    <ul>
        <li><div class="menu-box"><a href="userdashboard.php">Dashboard</a></div></li>
        <li><div class="menu-box"><a href="updatetask.php">Update Task</a></div></li>
        <li><div class="menu-box active"><a href="applyleave.php">Apply Leave</a></div></li>
        <li><div class="menu-box"><a href="manageleave.php">Leave Status</a></div></li>
        <li><div class="menu-box"><a href="profile.php">Profile</a></div></li>
        <li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
    <div class="form-container">
        <div class="task-form">
            <div class="title-bar"><h2>APPLY LEAVE</h2></div>

            <form method="POST" action="applyleaveprocess.php">
                <table>
                    <tr>
                        <td>From Date:</td>
                        <td><input type="date" name="startdate" placeholder="Enter from date"required></td>
                    </tr>
                    <tr>
                        <td>To Date:</td>
                        <td><input type="date" name="enddate" placeholder="enter to date"required></td>
                    </tr>
                    <tr>
                        <td>Contact No:</td>
                        <td><input type="text" name="contact"placeholder="Contact no" required></td>
                    </tr>
                    <tr>
                        <td>Reason:</td>
                        <td><textarea name="reason" rows="4" placeholder="Message..."required></textarea></td>
                    </tr>
                </table>
                <button type="submit" name="submit">Apply</button>
            </form>

        </div>
    </div>
</main>

<script>
function toggleMenu(){
    document.querySelector("aside").classList.toggle("active");
}
</script>

</body>
</html>
