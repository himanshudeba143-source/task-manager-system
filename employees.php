<?php 
session_start();
require_once('database1.php');
$query = "SELECT * FROM userlogin";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task Management System</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:Arial, sans-serif;background-color:#080710;}

/* Header */
header{
    background-color:#333;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
}
header h1{
     font-family:'Orbitron', sans-serif;
    font-size:1.5rem;
    letter-spacing:0.02cm;
    font-family:
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

/* Table container */
.update-task-page{
    background-color: peachpuff;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
    padding:20px;
    border-radius:10px;
}
.title-bar{
    background-color:#333;
    color:white;
    padding:8px 16px;
    border-radius:10px;
    box-shadow:0 12px 20px rgba(0,0,0,0.4);
    text-align:center;
    margin-bottom:20px;
}

/* Table styles */
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    border:1px solid #ddd;
    padding:8px;
    text-align:left;
}
th{
    background-color:#333;
    color:white;
}
.image-box{
    display:flex;
    justify-content:center;
    align-items:center;
}
.image-box img{
    height:90px;
    width:90px;
    border-radius:10px;
    border:3px solid white;
}

/* Modal styles */
.modal{
    display:none;
    position:fixed;
    z-index:1;
    left:0;
    top:0;
    width:100%;
    height:100%;
    overflow:auto;
    background-color:rgba(0,0,0,0.4);
    padding-top:60px;
}
.modal-content{
    background-color:#fefefe;
    margin:5% auto;
    padding:20px;
    border:1px solid #888;
    border-radius:10px;
    width:80%;
    max-width:400px;
}
.close{
    color:#aaa;
    float:right;
    font-size:28px;
    font-weight:bold;
    cursor:pointer;
}
.close:hover, .close:focus{color:black;text-decoration:none;}
.modal-buttons{
    display:flex;
    justify-content:flex-end;
}
.modal-buttons button{
    margin-left:10px;
    padding:10px 20px;
    font-size:16px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    transition:0.3s;
}
#deleteModalBtn{background-color:#e74c3c;color:white;}
#deleteModalBtn:hover{background-color:#c0392b;}
#closeModalBtn{background-color:#3498db;color:white;}
#closeModalBtn:hover{background-color:#2980b9;}

/* Loader */
#div-con{display:none;}
#loader-wrapper{position:fixed;top:0;left:0;width:100%;height:100%;background:#fff;display:flex;justify-content:center;align-items:center;z-index:9999;}
#loader{border:16px solid #f3f3f3;border-top:16px solid #3498db;border-radius:50%;width:120px;height:120px;animation:spin 2s linear infinite;}
#loader-text{position:absolute;top:70%;font-size:20px;color:#3498db;}
@keyframes spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}

@media(max-width:768px){
    .menu-toggle{display:block;}
    aside{transform:translateX(-100%);}
    aside.show{transform:translateX(0);}
    main{margin-left:20px;margin-right:20px;}
    header h1{font-size:1.5rem;}
    table, th, td{font-size:14px;}
    .image-box img{height:60px;width:60px;}
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function toggleMenu(){
    document.querySelector("aside").classList.toggle("show");
}

// Modal functionality
var modal = document.getElementById("deleteModal");
var span = document.getElementsByClassName("close")[0];
var closeModalBtn = document.getElementById("closeModalBtn");
var deleteButtons = document.querySelectorAll('.deleteBtn');

deleteButtons.forEach(function(button){
    button.onclick = function(){
        var uid = this.getAttribute('data-uidid');
        modal.style.display = "block";
        document.getElementById("deleteModalBtn").onclick = function(){
            $.ajax({
                type:"POST",
                url:"deleteuserprocess.php",
                data:{uid},
                beforeSend:function(){ $("#div-con").css({'display':'block'}); },
                success:function(resp){
                    if(resp==1){ alert('User Removed successfully'); window.location.reload(); }
                    else{ alert('Something went wrong, please try again later'); window.location.reload(); }
                    $("#div-con").css({'display':'none'});
                }
            });
        };
    };
});

span.onclick = closeModalBtn.onclick = function(){ modal.style.display = "none"; }
window.onclick = function(event){ if(event.target == modal){ modal.style.display = "none"; } }
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
        <li><div class="menu-box active"><a href="list.php">Employees</a></div></li>
        <li><div class="menu-box"><a href="createtask.php">Create Task</a></div></li>
        <li><div class="menu-box"><a href="managetask.php">Manage Task</a></div></li>
        <li><div class="menu-box leave-requests"><a href="updateleave.php">Leave Records</a></div></li>
        <li><div class="menu-box"><a href="profile1.php">Profile</a></div></li>
        <li><div class="menu-box"><a href="index.php">Log Out</a></div></li>
    </ul>
</aside>

<main>
<div id="div-con">
<div id="loader-wrapper"><div id="loader"></div><div id="loader-text">Loading...</div></div>
</div>

<div class="update-task-page">
    <div class="title-bar"><h2><b>Employees Registered</b></h2></div>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Employee</th>
                <th>Username</th>
                <th>Email Id</th>
                <th>Contact no</th>
                <th>DOB</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td>USER_00<?php echo $row['uid']; ?></td>
                <td class="image-box"><img src="<?php echo $_SESSION['image']; ?>"></td>
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['Email_Id']; ?></td>
                <td><?php echo $row['Contactno']; ?></td>
                <td><?php echo $row['DOB']; ?></td>
                <td><button class="deleteBtn" data-uidid="<?php echo $row['uid']; ?>" style="font-weight:bolder;border-width:2.5px;">Remove</button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</main>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to Remove?</p>
        <div class="modal-buttons">
            <button id="deleteModalBtn">Remove</button>
            <button id="closeModalBtn">Close</button>
        </div>
    </div>
</div>

</body>
</html>
