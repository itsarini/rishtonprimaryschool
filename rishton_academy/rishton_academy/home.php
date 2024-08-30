<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Rishton Academy</title>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

            body, html {
              height: 100%;
              line-height: 1.8;
            }

            .bgimg-1 {
              background-position: center;
              background-size: cover;
              background-image: url("students.jpeg");
              min-height: 100%;
            }

            .w3-bar .w3-button {
              padding: 16px;
            }

            h1{
                font-weight: 700;
            }

            .paragraph{
                font-size: 18px;
            }

            #content{
                background-color: black;
                opacity: 0.7;
                border-radius: 10px;
/*                font-weight: bold;*/
            }
        </style>
    </head>
    <body>

    <div class="w3-top">
        <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="home.php" class="w3-bar-item w3-button w3-wide"><img src="logo.png" width="100px"></a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small" style="vertical-align: middle; line-height: 100px;">
          <a href="home.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
          <a href="login.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> LOGIN</a>
        </div>

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </div>


    <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
      <div class="w3-display-left w3-text-white" id="content" style="padding:48px; border: 2px solid transparent; width: 50%;">
        <span class="paragraph">A very warm</span> 
        <h1>welcome to Rishton Primary School</h1><br>
        <span class="paragraph">
            Rishton Primary School is one of the best schools in London rated by Ofsted and we are proud of that achievement. We have strong links to our families, local schools and our community. We put every effort into ensuring our children become confident, happy and good citizens.
        </span>
    </header>

    </body>
</html>
