<?php 


    require_once("scripts/connect_db.php");


    $index_selecting_quiz = mysql_query("SELECT quiz_id, display_questions, time_allotted, quiz_name
                                    FROM quizes WHERE set_default=1");
    $index_selecting_quiz_row = mysql_fetch_array($index_selecting_quiz);
    $index_selecting_quiz_num = mysql_num_rows($index_selecting_quiz);



    $user_taken = "";
    if(isset($_POST['user_msg']) && $_POST['user_msg']!=""){
        $user_taken = $_POST['user_msg'];
    }
    if(isset($_GET['user_msg']) && $_GET['user_msg']!=""){
        $user_taken = $_GET['user_msg'];
    }

    $total_questions = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['display_questions']);
    $total_time = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['time_allotted']);
    $quizName = $index_selecting_quiz_row['quiz_name'];

    if($index_selecting_quiz_num>0)
    	$first_item = 'You\'ve got '.$total_time.' mins for attempting 4 Subjective Questions and '.$total_questions.' Objective questions.';
    else
    	$first_item = '<strong>Sorry, but it seems there are no quizzes Available right now!</strong>';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Instructions</title>

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
        <!-- ****** favicons ****** -->

        <!-- ****** faviconit.com favicons ****** -->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        
        <script type="text/javascript" src="js/ss_load.js"></script>

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>

        <script type="text/javascript">
            function submit(){
                var x=document.forms["onlyForm"]["rollno"].value;
                if (x==null || x==""){
                    document.getElementById("enter_rollno").innerHTML = "Please Enter Your Username";
                    exit();
                }
                document.getElementById('myForm').submit(); 
                return false;
            }
        </script>

        <script language="javascript">
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        </script>


    </head>
    <style>
			.bt {
				border-radius: 3px;
			  background-color: #4CAF50;
			  border: none;
			  color: white;
			  padding: 3px 10px;
			  text-align: center;
			  font-size: 16px;
			  cursor: pointer;
			}
			
			.bt:hover {
			  background-color: green;
			}
			</style>

    <body style="font-family: Arial;">
    <div id="head" align="center">
            <img src="img/logo.png" alt="CSI" height="150" width="400" />
        </div>

        <!-- Top content -->
        <div class="top-content">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1>WELCOME TO <strong>SKILL HUNT</strong> !<br><strong>Aptitude Round</strong></h1>
                    
                    <div class="description">
                        <p>
                            For more Information Follow our  <a href="https://www.instagram.com/csi_ditu/"><strong style="color: #5DADEC">Instagram Account </strong></a>
                        </p>
                    </div>
                </div>
            </div>
        	
            <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3 align="left">Here are the rules:</h3>
            <div align="left">
                <ul>
                <li>This Quiz Contain 1 Coding Question Which has to be completed Before 1 PM, 16th May 2020.</li>
                    <li>If time runs out, your quiz will automatically be submitted</li>
                    <li>You'll only be getting confirmation pop-up once if you try to leave during the quiz</li>
                    <li>You can only attempt the quiz once</li>
                </ul>
            </div>

            <h3>GOOD LUCK!</h3>
                        		</div>
                        		
                            </div>
                            <div class="form-bottom">
                            <form id="myForm" name="onlyForm" action="quiz.php" method="POST">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="rollno" placeholder="Enter Your Email ID Here" class="form-username form-control" id="form-username">
                                    </div>
                                    
                                    <td align="center">
                                    <button type="submit" href="javascript:submit();" class="btn">Start The Quiz</button>
                            
                        </td>  
                        <div id = "enter_rollno" align="center"><?php echo $user_taken ?></div>
			                    </form>
                            </div>
                            <td>
                            
                        </td>
                        </div>
                    </div>
                    
                    
                </div>
                <br><br><br><br>

        
        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
                

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

