<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Silicon Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: slategray;
            margin: 0;
            overflow-x: hidden;
        }

        .container-fluid{
            padding-left:0 !important;
            padding-right:0 !important;
        }

        /* HEADER */
        .section1 {
            background-color: rgba(0, 0, 0, 0.75);
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 9999;
            padding: 15px 40px;
            text-align: center;
        }

        .heading h1 {
            font-size: 1.5rem;
            color: ghostwhite;
            font-family: 'Orbitron', sans-serif;
            display: inline;
            margin: 0 6px;
        }

        /* MAIN WHITE CONTAINER */
        .section2 {
            background-color: ghostwhite;
            padding: 37px 50px;   /* reduced height */
            margin-top: 90px;
            border-radius: 12px;
            margin-left:40px;
            margin-right:40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        .heading1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.7rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* FORM BOX */
        .xyz {
            border-radius: 12px;
            background-color: navajowhite;
            box-shadow: -9px -9px 15px black;
            opacity: 0.95;
            padding: 22px;
        }

        .form-group {
            text-align: left;
            font-family:'cursive'
            font-weight: 850;
            padding:11px;
        }

        .buttondesign {
            background-color: black;
            border: none;
            width: 49%;
            color: ghostwhite;
            font-family: 'Agency FB';
            font-weight: 900;
            border-radius: 8px;
            margin-top: 0px;
        }

        .buttondesign:hover {
            color: black;
            background-color: ghostwhite;
        }

        /* SLIDER */
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 360px;
            overflow: hidden;
        }

        .image-container {
            width: 100%;
            height: 360px;
            display: none;
            position: absolute;
            object-fit: contain;
        }

        .prev-img, .next-img {
            cursor: pointer;
            position: absolute;
            top: 50%;
            padding: 14px;
            background: rgba(0,0,0,0.6);
            color: white;
            font-size: 18px;
            border-radius: 6px;
        }

        .next-img { right: 0; }
        
          .bottom-section {
            background-color: lightgray;
            padding: 40px 20px;
            margin-top: 40px;
        }

        .card1, .card2, .card3 {
            margin: 15px 0;
            box-shadow: 3px -3px 10px black;
            transition: 0.3s;
            
        }

        .card1:hover, .card2:hover, .card3:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.6);
        }

        .box-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            margin: -40px auto 10px;
        }
        /* ================= MOBILE (UNCHANGED) ================= */
        @media (max-width: 768px) {

            .section1 {
                text-align: center;
                padding: 12px;
            }

            .heading h1 {
                text-align: center;
                font-size: 14px;
                display: inline;
            }

            .section2 {
                padding: 10px;
                margin-top: 82px;
                width: 98%;
                margin-left: 11px;
            }

            .heading1 {
                text-align: center;
                font-size: 1.3rem;
            }

            .xyz {
                width: 100%;
                padding: 15px; /* form height reduced */
            }
            
        .form-group {
            
            font-weight: 850;
            
        }

            .buttondesign {
                width: 49%;
            }

            .slideshow-container,
            .image-container {
                height: 220px;
            }

            /* smaller arrows */
            .prev-img, .next-img {
                padding: 8px;
                font-size: 14px;
            }
        }
@media (min-width: 992px) {
    .xyz {
        width: 82%;
        padding: 11px;   /* reduces height */
        margin: 0 auto;
        font-weight:700;
    }
}
@media (min-width: 992px) {
    .section2 {
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        padding: 33px 50px;   /* reduces height */
    }
}
@media (min-width: 992px) {
    .heading1 {
        margin-left: 112px;   /* adjust: 10px, 20px, 30px as you like */
    }
}

    </style>
</head>

<body>

<div class="container-fluid">

    <div class="section1 heading">
        <h1>Task Management System</h1>
         <h1>|</h1>
         <h1>HS</h1>
    </div>

    <div class="section2 row align-items-center">

        <!-- FORM -->
        <div class="col-md-5">
            <h1 class="heading1">Admin-Login</h1>
            <div class="xyz">
                <form method="post" action="adminloginprocess.php" autocomplete="off">
                    <div class="form-group">
                       

                        <label>Name:</label>
                        <input type="text" class="form-control" name="uname" placeholder="Username" required>

                       
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>

                       
                    </div>

                    <button class="btn buttondesign" onclick="window.location.href='index.php'">Go Back</button>
                    <button type="submit" class="btn buttondesign" >Login</button>
                </form>
            </div>
        </div>

        <!-- SLIDER -->
        <div class="col-md-7">
            <div class="slideshow-container">
                <img class="image-container" src="https://erp.silicon.ac.in/estcampus/images/slider/df8be4de2fbe2b39f7da4866d9ca45e3.jpg">
                <img class="image-container" src="https://erp.silicon.ac.in/estcampus/images/slider/5eb3275b927b0287422f67ae70d662b1.jpg">
                <img class="image-container" src="https://erp.silicon.ac.in/estcampus/images/slider/15adff189ee718cc6f1551bc21b40c13.jpg">
                <a class="prev-img" onclick="slides(-1)">❮</a>
                <a class="next-img" onclick="slides(1)">❯</a>
            </div>
        </div>
    </div>
                            <div class="bottom-section row">
        <div class="col-md-4">
            <div class="card card-body card1">
                <img class="box-icon" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTPYZAee2qA-j7eekFOiK8iJ_UmkM25UaxBH7E6DZJdGwPDMiDc">
                <h4 class="text-center">HRMS</h4>
                <ul>
                    <li>Employee Profile</li>
                    <li>Attendance</li>
                    <li>Leave</li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-body card2">
                <img class="box-icon" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSMp3nB8YlyKbfdXopSm4lIEqZx2Nyw4w52eyYpwisak9oRAC9d">
                <h4 class="text-center">BUDGET</h4>
                <ul>
                    <li>Planning</li>
                    <li>Workflow</li>
                    <li>Utilization</li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-body card3">
                <img class="box-icon" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFZjjatnP8s6RQMmmGeml8do14x8oibZpTLB07iMLZRDLfiExc">
                <h4 class="text-center">EXPENSES</h4>
                <ul>
                    <li>Advance</li>
                    <li>Settlement</li>
                    <li>Tracking</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    let index = 0;
    showSlides();

    function showSlides() {
        let slides = document.getElementsByClassName("image-container");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        index++;
        if (index > slides.length) index = 1;
        slides[index-1].style.display = "block";
        setTimeout(showSlides, 3000);
    }
</script>

</body>
</html>
