<?php


	require_once("scripts/connect_db.php");

	$selecting_quiz = mysql_query("SELECT quiz_id, display_questions, time_allotted, quiz_name
									FROM quizes WHERE set_default=1");
	$selecting_quiz_row = mysql_fetch_array($selecting_quiz);



 //checking if all 3 values are there
	if(isset($_POST['rollno']) && $_POST['rollno'] != "")
	{
		
	 //getting values in variables
		$roll_no = $_POST['rollno'];
		$roll_no = htmlspecialchars($roll_no);
		$roll_no = mysql_real_escape_string($roll_no);

		$total_questions = preg_replace('/[^0-9]/', "", $selecting_quiz_row['display_questions']);

	 //total time converted to seconds
		$total_time = (preg_replace('/[^0-9]/', "", $selecting_quiz_row['time_allotted']))*60;

		$final_quiz_ID = preg_replace('/[^0-9]/', "", $selecting_quiz_row['quiz_id']);

		$quzz_name = $selecting_quiz_row['quiz_name'];

	 //checking if user has already taken this quiz
		$userCheck = mysql_query(" SELECT id FROM participants 
										WHERE username = '$roll_no' 
										AND quiz_id='$final_quiz_ID' ")or die(mysql_error());
		if((mysql_num_rows($userCheck) < 1)){
			$user_msg = 'Sorry, but '.$roll_no.', is not registered!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		}
		$userCheck = mysql_query(" SELECT id FROM quiz_takers 
										WHERE username = '$roll_no' 
										AND quiz_id='$final_quiz_ID'")or die(mysql_error());
	 //if user already did, redirect to index.php with error
		if(!(mysql_num_rows($userCheck) < 1)){
			$user_msg = 'Sorry, but '.$roll_no.', has already attempted the quiz!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		}
		
			else{
	 //else inserting few columns into the table
		mysql_query("INSERT INTO quiz_takers (username, percentage, date_time, quiz_id) 
					 VALUES ('$roll_no', '0', now(), '$final_quiz_ID')")or die(mysql_error());
		}
	}else{
		$user_msg = 'Hey, This is the start Page, So enter your username here first';
		header('location: index.php?user_msg='.$user_msg.'');
			exit();
	}







 //getting body i.e. questions, options and submit button for the page

 //initialize the optput variable
	$m_output='';
 
 //Getting the questions from DB here
	$m_questions_from_DB = mysql_query("SELECT * FROM questions WHERE quiz_id='$final_quiz_ID'
								ORDER BY rand() LIMIT $total_questions");

		while (mysql_num_rows($m_questions_from_DB)<1) {
			$user_msg = 'Hey, weird, but it seems there are no questions in this quiz!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		}

	 //setting Question No. to 1 on quiz page(necessary due to rand() above)
		$m_display_ID = 1;

	 //looping through the questions and adding them on the page
		while($m_row = mysql_fetch_array($m_questions_from_DB)){
		 //initializing the options
			$m_answers='';
				
		 //getting row attributes in variables
			$m_id = $m_row['id'];
			$m_thisQuestion = $m_row['question'];
			$m_type = $m_row['type'];
			$m_question_id = $m_row['question_id'];
			$m_code = $m_row['code'];
			$m_code_type = $m_row['code_type'];

		 //html for question
			$m_q = '<tr>
						<td width="40px" rowspan="1" align="top">
							<strong>'.$m_display_ID.'.</strong>
						</td>
						<td>
							<pre class="question_style"><strong><div style="width: 730px; display: inline-block;
							word-break: break-word;">'.$m_thisQuestion.'</div></strong></pre>
						</td>
					</tr>';
		 //if programming code is inserted, its html for the code
			if($m_code != "" && $m_code_type != ""){
				$m_q .='<tr>
						<td></td>
						<td>
							<pre class="brush: '.$m_code_type.';">'.$m_code.'</pre>
						</td>
					</tr>
					';
			}
			

		 //gathering options of the question here
			$m_options_from_DB = mysql_query("SELECT * FROM answers 
									WHERE question_id='$m_question_id' ORDER BY rand()");

				$m_answers .=  '<br>
				                   <tr>
									<td></td>
									<td>
								';
				 //adding html to individual options here
					while($m_row2 = mysql_fetch_array($m_options_from_DB)){
					 //getting row attributes in variables
						$m_answer = $m_row2['answer'];
						$m_answer_ID = $m_row2['id'];

						
						$m_answers .= ' <label style="cursor:pointer;">
									   		<input type="radio" name="rads'.$m_display_ID.'" value="'.$m_answer_ID.'">'.$m_answer.'</label>
										<br /><br />
									  ';

					}
	
					$m_answers .=  '</td>
								</tr>
								<tr height="20px">
								</tr>
								   ';

			 // the complete div that is sent back to quiz.php
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;

		}

		$m_display_ID--;

		$m_output .='<div style="color: black">
		<h1>Subjective Questions</h1>
		<br>
		 <div align="left" >
		 <pre>
		<h3>1. What do you think, are the steps involve in planning the event from ideation to 
its execution
(4 Marks)</h3>
		</pre>
		
		  
		<textarea placeholder="Write Your Answer Here.." cols="95"  name="first" rows="10" style="align: center;" wrap="hard"></textarea><br>
		  <br>
		 <br>
		 <pre>
		<h3>2.  Suppose there is a national level event (HACKATHON) that is going to organise 
in your campus, but due to some reasons college is unable to process the required funds, how 
will you manage the situation?
(3 Marks)</h3>
		 </pre>
		 

		 <textarea placeholder="Write Your Answer Here.." cols="95" name="second" rows="10" style="align: center;" wrap="hard"></textarea><br>
		 <br><br>
		 <pre>
		<h3>3.  Tell us about a situation where you have organised a workshop, but at the last 
moment the orator that was scheduled to give the presentation back-out due to some reason. 
What steps would you take? Assume or Give real time Experience. 
(3 Marks)
</h3> 
</pre>

          
<textarea placeholder="Write Your Answer Here.." cols="95" name="third" rows="10" style="align: center;" wrap="hard"></textarea><br>
		   <br><br>
		   <pre>
		<h3>4. Is there any strong or unique skill in you that you think, sets you apart 
from others.
(2 Marks)</h3>
		 </pre>
		 
<textarea placeholder="Write Your Answer Here.." cols="95" name="fourth" rows="10" style="align: center;" wrap="hard"></textarea><br>
		   <br>
		   <br>
		   </div>
		   <h1>Objective Questions</h1>
		   <p style="color:red;"><br>Correct Answer: 2 marks<br>Wrong Answer: -1 marks<br><br></p>
		   </div>
		    ';

	 //adding html for submit button
		$m_output .= '  <tr>
							<td colspan="2" align="center">
								<span id="m_btnSpan">
									<a href="javascript:{}" onclick="quiz_submit()" class="myButton">Submit</a>
								</span>
							</td>
						</tr>';

	 //adding html for hidden values to be sent to result.php
		$m_output .= '<input type="hidden" name="rollno" value="'.$roll_no.'">
					  <input type="hidden" name="total_ques" value="'.$m_display_ID.'">
					  <input type="hidden" name="total_time" value="'.$total_time.'">
					  <input type="hidden" name="quizID" value="'.$final_quiz_ID.'">
					  ';
?>
<style>
.countdown{
	background-color: #5DADEC;
	border-radius: 2px;
}

</style>
























<!DOCTYPE html>
<html>

	<head>
		<title>Quiz</title>

		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>

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

     <!-- SYNTAX HIGHLIGHTER LINKS & SCRIPTS -->
        <link rel="stylesheet" type="text/css" href="sh/styles/shCore.css">
		<link rel="stylesheet" type="text/css" href="sh/styles/shThemeDefault.css">
		<script type="text/javascript" src="sh/scripts/shCore.js"></script>
	 <!-- INCLUDING ALL SCRIPTS FOR BRUSHES -->
		<script type="text/javascript" src="sh/scripts/shBrushAppleScript.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushAS3.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushBash.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushColdFusion.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCpp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCSharp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushCss.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushDelphi.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushDiff.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushErlang.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushGroovy.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJava.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJavaFX.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushJScript.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPerl.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPhp.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPlain.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPowerShell.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushPython.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushRuby.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushSass.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushScala.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushSql.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushVb.js"></script>
		<script type="text/javascript" src="sh/scripts/shBrushXml.js"></script>
		<script type="text/javascript">
		    SyntaxHighlighter.all()
		</script>

        <script type="text/javascript">
	     //function that submits the quiz
			function quiz_submit(){
				window.onbeforeunload = null;
	            document.getElementById('quiz_form').submit(); 
	        }

	     //function that keeps the counter going
			function timer(secs){
				var ele = document.getElementById("countdown");
				ele.innerHTML = "Your Time Starts Now";			
				var mins_rem = parseInt(secs/60);
				var secs_rem = secs%60;
				
				if(mins_rem<10 && secs_rem>=10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":"+secs_rem;
				else if(secs_rem<10 && mins_rem>=10)
					ele.innerHTML = "Time Remaining: "+mins_rem+":0"+secs_rem;
				else if(secs_rem<10 && mins_rem<10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":0"+secs_rem;
				else
					ele.innerHTML = "Time Remaining: "+mins_rem+":"+secs_rem;

				if(mins_rem=="00" && secs_rem < 1){
                    alert('Time Out! Click on OK and Quiz will be submitted Automatically!');
					quiz_submit(); 
				}
				secs--;
			 //to animate the timer otherwise it'd just stay at the number entered
			 //calling timer() again after 1 sec
				var time_again = setTimeout('timer('+secs+')',1000);
			}

		 //wwarning confirmation that appears on closing/refreshing the quiz window/tab
			function closeEditorWarning(){
    				return "WARNING!!!\n*********************\nReally Wanna quit!? \nIt will Result in lost of data and time!\nClick on Stay on this Page!\n*********************";
			}
			window.onbeforeunload = closeEditorWarning;
        </script>

        <script language="javascript">
			document.addEventListener("contextmenu", function(e){
			    e.preventDefault();
			}, false);
		</script>
		<script type="text/JavaScript">
          //courtesy of BoogieJack.com
             function killCopy(e){
               return false
               }
             function reEnable(){
              return true
                  }
           document.onselectstart=new Function ("return false")
            if (window.sidebar){
            document.onmousedown=killCopy
            document.onclick=reEnable
            }
        </script>
	<style>
        .boxed, .hd{
		background-color: black;
        }
		.ques,.mid{
			background-color: white;
		}
         </style>
	<body style="font-family: Arial;">

		<div id="head" class="hd" align="center" >
            <img src="img/header.jpg" alt="CSI" />

        </div>
        <div class="boxed" align="center" style="color: white">
		<br><strong><?php echo $quzz_name; ?></strong>
		<br><strong>Total Time: <?php echo $total_time/60; ?> mins</strong>
		
		<p style="color:#FF0000";>Warning!<br>
		<br>Don't Close or Reload this Tab!</p>
        
        
        
		<div id="main_body" class="mid" align="center" style="margin-bottom: 100px;">
		 <div class="ques">
			<form id="quiz_form" name="quiz_form_name" action="result.php" method="POST">
			<br /><BR /><BR />
				<table width="780px" align="center">
					<?php echo $m_output ?>
					
				</table>
				
			</form>
			</div>
		</div>
        </div>
        <div id="countdown" class="countdown">

        	<script type="text/javascript" style="color: black">
        		timer(<?php echo $total_time; ?>);
        	</script>
        </div>


		




        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
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
</html