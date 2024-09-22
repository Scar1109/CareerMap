


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.styles.css">

    <!--change title icon-->
    <title>CareerMap</title>
</head>

<body>
    <?php
    include_once 'header.php';
    ?>
    <!--slide show -->
    <!--slide show -->

    <div class="slideshow">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="../images/1.svg" style="width:100%; height:auto;" >
            </div>
            <div class="mySlides fade">
                <img src="../images/2.svg" style="width:100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/3.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/4.svg" style="width: 100%; height:auto;">
            </div>
            <div class="mySlides fade">
                <img src="../images/5.svg" style="width: 100%; height:auto;">
            </div>
        </div>
        <br>

        <div class="dots" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
                <span class="dot" onclick="currentSlide(4)"></span> 
                <span class="dot" onclick="currentSlide(5)"></span> 
        </div>
        
    </div>

        <?php
        include_once 'footer.php';
        ?>
        <script src="../js/myscript.js"></script>
</body>

</html>