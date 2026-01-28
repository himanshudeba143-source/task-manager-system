<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: '', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url("https://wallpapercave.com/wp/wp5154762.jpg");
        }

        .card {
            position: relative;
            background-color: black;
            color: ghostwhite;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 10px 18px 18px 0 rgba(0, 0, 0, 0.8);
            width: 300px;
            height: 13.4cm;
            transition: transform 0.3s;
            overflow: hidden;
        }

        .card-inner {
            position: relative;
            z-index: 1;
        }

        .card:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: solid ghostwhite 3px;
            border-radius: 10px;
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-10px);
            transform: translateX(10px);
        }

        .card h2 {
            margin-top: 0;
            color: navjowhite;
            text-align: center;
			letter-spacing:0.05cm;
			font-family:Agency FB;
        }

        .card p {
            margin: 10px 0;
            line-height: 1.3;
            text-align: left;
			font-family:cursive;
			
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .image-box {
            border: 3px solid white;
            border-radius: 10px;
            padding: 7px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-box img {
            height: 90px;
            width: 90px;
        }

        .back-button {
            display: inline-block;
            margin-top: 13px;
            padding: 5px 16px;
            background-color: #6a11cb;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s;
            align-items: right;
        }

        .back-button:hover {
            background-color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>User Profile</h2>
        <div class="image-container">
            <div class="image-box">
                <?php echo "<img src='" . $_SESSION['image'] . "'>"; ?>
            </div>
            <p><strong><?php echo $_SESSION['uname'];?></strong></p>
        </div>
        <p><strong >NAME: </strong> <?php echo $_SESSION['uname'];?></p>
        <p><strong style="letter-spacing:0.06cm" >DOB: </strong>  <?php echo $_SESSION['dob'];?></p>
        <p><strong>USER ID: USER_00</strong><?php echo $_SESSION['uid'];?></p>
        <p><strong>CONTACT: </strong>  <?php echo $_SESSION['contactno'];?></p>
        <p><strong>EMAIL ID: </strong>  <?php echo $_SESSION['email'];?></p>       
        <p><strong>ABOUT: </strong> I'm a software engineer with over 10 years of experience in web development.</p>
        <a href="javascript:history.back()" class="back-button">Go Back</a>
    </div>
</body>
</html>
