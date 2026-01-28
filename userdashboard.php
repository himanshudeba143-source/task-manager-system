<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<title>Task Management System</title>

<style>
body, ul {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #080710;
}

/* HEADER */
header {
    background-color: #333;
    color: white;
    padding: 8px 20px;
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
    margin-right: 20px;
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

/* MOBILE */
@media (max-width: 768px) {

    /* ===== HEADER ===== */
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
   
    .instruction h1{
    font-family: 'Orbitron', sans-serif !important;
        font-size:25px;
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

<div class="wrapper">

<aside id="sidebar">
    <ul>
        <li><div class="menu-box active"><a href="admindashboard.php">Dashboard</a></div></li>
        <li><div class="menu-box "><a href="updatetask.php">Update Task</a></div></li>
        <li><div class="menu-box "><a href="applyleave.php">Apply Leave</a></div></li>
        <li><div class="menu-box "><a href="manageleave.php">Leave Status</a></div></li>
        <li><div class="menu-box "><a href="profile.php">Profile</a></div></li>
        <li><div class="menu-box "><a href="index.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
    <li>
    <div class="instruction">
        <h1>Welcome back, <?php echo $_SESSION['uname'];?> !</h1>
        <h2>Instructions for EMPLOYEES :</h2>
        <p>
            - All Employees should mark their attendance daily.<br>
            - All should be clear about the rules and regulation of company.<br>
            - All should Update their recommended tasks up to date.<br>
            - Kindly maintain the decorum of the office.<br>
            - The structure of pay will be different according to the changes made.<br>
            - There was Equal opportunities to all the Employees.<br>
            - All should aware of their number of leave days.
        </p>
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
