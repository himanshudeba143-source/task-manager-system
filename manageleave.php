<?php
session_start();
require_once('database1.php');
$query="SELECT * FROM leaveassigned WHERE uid=".$_SESSION['uid'];
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<style>
/* ================= RESET ================= */
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:Arial,sans-serif;background:#080710;overflow-x:hidden;}
ul{list-style:none;}

/* ================= HEADER (DESKTOP SAME AS DASHBOARD) ================= */
header{
    background:#333;
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
    font-family:'Orbitron',sans-serif;
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
    margin-right:10px;
    border:2px solid white;
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
}

/* ================= SIDEBAR ================= */
aside{
    background:#444;
    color:white;
    width:240px;
    padding:20px;
    height:calc(100vh - 70px);
    position:fixed;
    top:70px;
    left:0;
    transition:0.3s;
    z-index:999;
}
.menu-box{
    background:floralwhite;
    border-radius:6px;
    padding:15px;
    text-align:center;
    margin-bottom:10px;
}
.menu-box a{
    font-size:20px;
    font-weight:bold;
    text-decoration:none;
    color:black;
}
.menu-box:hover,
.menu-box.active{
    background:#222;
}
.menu-box:hover a,
.menu-box.active a{
    color:white;
}

/* ================= MAIN (NO HORIZONTAL SCROLL) ================= */
main{
    margin-top:80px;
    margin-left:240px;
    width:calc(100% - 240px);
    padding:13px;
    background:black;
    min-height:100vh;
}

/* ================= PAGE CONTENT ================= */
.update-task-page{
    background:peachpuff;
    padding:15px;
    border-radius:8px;
}

.title-bar{
    background:#333;
    color:white;
    padding:15px 15px;
    border-radius:6px;
    margin-bottom:15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 5px;
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
}

/* ================= TABLE ================= */
.table-wrapper{
    width:100%;
    overflow-x:auto;
}
table{
    width:100%;
    border-collapse:collapse;
    min-width:700px;
}
th,td{
    border:1px solid #ddd;
    padding:8px;
    text-align:center;
}
th{
    background:#333;
    color:white;
}

/* ================= WITHDRAW BUTTON ================= */
.deleteBtn {
    background: linear-gradient(135deg, #e74c3c, #ff6b6b);
    color: #fff;
    padding: 6px 12px;
    font-weight: 600;
    border: 2px solid #fff;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    display: inline-block; /* keep it functional */
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}
.deleteBtn:hover {
    background: linear-gradient(135deg, #c0392b, #ff4e50);
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(0,0,0,0.25);
}

/* ================= MODAL ================= */
.modal {
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    padding: 10px;
}

.modal-content {
    
    background-color: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    position: relative;
    text-align: center;
    animation: scaleIn 0.3s ease;
}

.modal-content p {
    font-size: 16px;
    color: #333;
    margin-bottom: 25px;
}

.close {
    position: absolute;
    top: 12px;
    right: 15px;
    font-size: 26px;
    font-weight: bold;
    color: #888;
    cursor: pointer;
    transition: color 0.3s ease;
}
.close:hover {
    color: #000;
}

/* ================= MODAL BUTTONS – PROFESSIONAL STYLE ================= */
.modal-buttons {
    
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;
}

.modal-buttons button {
    flex: 1 1 auto;
    padding: 10px 18px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* DELETE BUTTON – GRADIENT */
#deleteModalBtn {
    background: linear-gradient(135deg, #e74c3c, #ff6b6b);
    color: #fff;
}
#deleteModalBtn:hover {
    background: linear-gradient(135deg, #c0392b, #ff4e50);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}

/* CLOSE BUTTON – GRADIENT */
#closeModalBtn {
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
    color: #fff;
}
#closeModalBtn:hover {
    background: linear-gradient(135deg, #1abc9c, #2980b9);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}

/* ================= ANIMATIONS ================= */
@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}
@keyframes scaleIn {
    0% {transform: scale(0.8);}
    100% {transform: scale(1);}
}

/* ================= MOBILE ADJUSTMENTS ================= */
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
    margin-left:22px;
}

.header-right{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:2px;
    margin-top:6px;
    margin-left:23px;
}

.header-right img{
    width:43px;
    height:42px;
}

.header-right div{
    display:flex;
    flex-direction:column;
    font-size:12px;
    line-height:1.3;
    font-family:monospace;
}

aside{
    left:-100%;
    top:110px;
    height:calc(100vh - 110px);
}
aside.active{
    left:0;
}

main{
    margin-left:0;
    width:100%;
    padding-top:85px;
}
    .update-task-page{
        padding:6px;
    }
     .title-bar{
        padding:10px 10px;
         font-size:14px;
    }


/* Mobile modal buttons */
@media(max-width:480px){
    .modal-buttons {
        flex-direction: column;
        gap: 12px;
    }
    .modal-buttons button {
        width: 100%;
        padding: 12px 0;
        font-size: 14px;
    }
}
    @media (max-width: 480px) {
    .modal-buttons {
        gap: 18px; /* 👈 increase space between Delete & Close */
    }

    .modal-buttons button {
        margin-top: 0; /* safety reset */
    }
}
    @media (max-width: 480px) {

    .modal-buttons {
        flex-direction: column;
    }

    .modal-buttons button {
        width: 100%;
        margin-bottom: 5px; /* ✅ actual visible gap */
    }

    /* remove extra space after last button */
    .modal-buttons button:last-child {
        margin-bottom: 0;
    }
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
<li><div class="menu-box"><a href="updatetask.php">Update Task</a></div></li>
<li><div class="menu-box"><a href="applyleave.php">Apply Leave</a></div></li>
<li><div class="menu-box active"><a href="manageleave.php">Leave Status</a></div></li>
<li><div class="menu-box"><a href="profile.php">Profile</a></div></li>
<li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
</ul>
</aside>

<main>
<div class="update-task-page">
<div class="title-bar">
<h2>LEAVE APPLICATIONS APPLIED</h2>
</div>

<div class="table-wrapper">
<table>
<thead>
<tr>
<th>Leave ID</th>
<th>From</th>
<th>To</th>
<th>Contact</th>
<th>Reason</th>
<th>Status</th>
<th>Withdraw</th>
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
<td><button class="deleteBtn" data-leaveid="<?php echo $row['Leaveid']; ?>">Withdraw</button></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

</div>
</main>

<!-- The Modal -->
<div id="deleteModal" class="modal" style="display:none;">

    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to withdraw?</p>
        <div class="modal-buttons">
            <button id="deleteModalBtn">Delete</button>
            <button id="closeModalBtn">Close</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var modal = document.getElementById("deleteModal");
    var span = document.getElementsByClassName("close")[0];
    var closeModalBtn = document.getElementById("closeModalBtn");
    var deleteButtons = document.querySelectorAll('.deleteBtn');
    var leaveIdToDelete;

    deleteButtons.forEach(function (button) {
        button.onclick = function () {
            leaveIdToDelete = this.getAttribute('data-leaveid');
            modal.style.display = "flex"; // flex for centering
        };
    });

    span.onclick = function () {
        modal.style.display = "none";
    }

    closeModalBtn.onclick = function () {
        modal.style.display = "none";
    }

    document.getElementById("deleteModalBtn").onclick = function () {
        $.ajax({
            type: "POST",
            url: "deleteleaveprocess.php",
            data: {
                LeaveId: leaveIdToDelete,
                _method: "DELETE"
            },
            beforeSend: function () {
                $("#div-con").css({'display': 'block'});
            },
            success: function (resp) {
                console.log(resp);
                if (resp == 1) {
                    alert('Data deleted successfully');
                    window.location.reload();
                } else {
                    alert('Something went wrong, please try again later');
                    window.location.reload();
                }
                $("#div-con").css({'display': 'none'});
            }
        });
    };
</script>

</body>
</html>
