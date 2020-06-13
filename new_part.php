<?php 
//showing the message back to the user after a transaction is completed
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        $msg = strip_tags($msg);
        $msg = mysql_real_escape_string($msg);
    }

    if(isset($_POST['msg'])){
        $msg = $_POST['msg'];
        $msg = strip_tags($msg);
        $msg = mysql_real_escape_string($msg);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Add Participants</title>

        <!-- ****** faviconit.com favicons ****** -->
            <!-- Basic favicons -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/faviconit/favicon.ico">
                <link rel="shortcut icon" type="image/x-icon" href="img/faviconit/favicon.ico">

            <!--[if IE]><link rel="shortcut icon" href="/favicon.ico"><![endif]-->

            <!-- For Opera Speed Dial -->
                <link rel="icon" type="image/png" sizes="195x195" href="img/faviconit/favicon-195.png">
            <!-- For iPad with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="apple-touch-icon" sizes="152x152" href="img/faviconit/favicon-152.png">
            <!-- For iPad with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="apple-touch-icon" sizes="144x144" href="img/faviconit/favicon-144.png">
            <!-- For iPhone with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="apple-touch-icon" sizes="120x120" href="img/faviconit/favicon-120.png">
            <!-- For iPhone with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="apple-touch-icon" sizes="114x114" href="img/faviconit/favicon-114.png">
            <!-- For Google TV devices -->
                <link rel="icon" type="image/png" sizes="96x96" href="img/faviconit/favicon-96.png">
            <!-- For iPad Mini -->
                <link rel="apple-touch-icon" sizes="76x76" href="img/faviconit/favicon-76.png">
            <!-- For first- and second-generation iPad -->
                <link rel="apple-touch-icon" sizes="72x72" href="img/faviconit/favicon-72.png">
            <!-- For non-Retina iPhone, iPod Touch and Android 2.1+ devices -->
                <link rel="apple-touch-icon" href="img/faviconit/favicon-57.png">
            <!-- Windows 8 Tiles -->
                <meta name="msapplication-TileColor" content="#FFFFFF">
                <meta name="msapplication-TileImage" content="img/faviconit/favicon-144.png">
        <!-- ****** faviconit.com favicons ****** -->

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>

        <script type="text/javascript">
        function submit_part(){
            var x=document.forms["reg_name"]["user"].value;
            var y=document.forms["reg_name"]["quiz_n"].value;
            if (x==null || x=="" || y==null || y==""){
                document.getElementById("required").innerHTML = "Enter Both Values";
                exit();
            }
            close_overlay();
            document.getElementById('new_part').submit(); 
            return false;
        }
        </script>
      
    </head>

    <body style="font-family: Arial;">
        <div id="head" align="center">
            <img src="img/header.jpg" alt="CSI" />
        </div>
        <div id="part_menu">
            <p style="color:#06F;" id="msg">
                <?php echo $msg; ?>
            </p>
            <br><br>
            <div>
            <form action="add_part.php" class="newpart" method="POST" name="new_part" id="regNewPart">
                <p>
                  <br><label class="reg_label" for="user"><center>Username of Participant:</center></label>
                  <center><input type="text" name="user" id="user" required="required"></center>
                </p>
                <p>
                  <br><label class="reg_label" for="quiz_n"><center>Quiz Number:</center></label>
                  <center><input type="number" name="quiz_n" id="quiz_n" required="required"></center>
                </p>
                <p class="addP-submit">
                  <center><button  onClick="submit_part()" id="addP_button" class="addP-button">Enter</button></center>
                </p>
                <p id="required"></p>
                </form>
            </div>
        <div id="footer" align="bottom">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                <tbody>
                    <tr>
                        <td align="left" id="copyright">
                            DIT University, Dehradun
                        </td>
                        <td align="right" id="developer" >
                            Quiz Designed &amp; Developed For : 
                            <a style="color: #c4dcf5">
                                CSI Recruitment Drive 2020
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </body>
        </html>