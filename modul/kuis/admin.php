<?php
	
	/*
    Short Programming Quiz Framework
        Copyright (C) 2014  Rahul Jain

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
    	
    	Short Programming Quiz Framework -- Copyright (C) 2014  Rahul Jain
        This program comes with ABSOLUTELY NO WARRANTY.
        This is free software, and you are welcome to redistribute it
        under certain conditions found in the GNU GPL license
    */


    include("session.php");

//inserting the questions into the database
 //checking if the required data has been filled
	if(isset($_POST['desc'])){
		if(!isset($_POST['iscorrect']) || $_POST['iscorrect'] == ""){
			echo "Sorry, important data to submit your question is missing. Please press back in your browser and try again and make sure you select a correct answer for the question.";
			exit();
		}

		if(!isset($_POST['type']) || $_POST['type'] == ""){
			echo "Sorry, there was an error parsing the form. Please press back in your browser and try again";
			exit();
		}

	 //connecting to the database
		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	 //initializing the variables
		$question = $_POST['desc'];
		$program = $_POST['code_desc'];
		$programType = $_POST['prog-lang'];
		$answer1 = $_POST['answer1'];
		$answer2 = $_POST['answer2'];
		$answer3 = $_POST['answer3'];
		$answer4 = $_POST['answer4'];
		$type = $_POST['type'];
		$quizID = $_POST['quizID'];

	 //replacing everything except 0-9 with nothing as its values are - 1/2/3...
		$quizID = preg_replace('/[^0-9]/', "", $quizID);

	 //replacing everything except a-z with nothing as its values are - mc/tf
		$type = preg_replace('/[^a-z]/', "", $type);

	 //replacing everything except 0-9 & a-z with nothhing as value is - answer1/2/3/4
		$isCorrect = preg_replace('/[^0-9a-z]/', "", $_POST['iscorrect']);

	 //getting and converting strings as they are
		$question = htmlspecialchars($question);
		$question = mysql_real_escape_string($question);

		$program = htmlspecialchars($program);
		$program = mysql_real_escape_string($program);

		$answer1 = htmlspecialchars($answer1);
		$answer1 = mysql_real_escape_string($answer1);

		$answer2 = htmlspecialchars($answer2);
		$answer2 = mysql_real_escape_string($answer2);

		$answer3 = htmlspecialchars($answer3);
		$answer3 = mysql_real_escape_string($answer3);

		$answer4 = htmlspecialchars($answer4);
		$answer4 = mysql_real_escape_string($answer4);



	 //if its a true/false question, do this-
		if($type == 'tf'){
		 //if any field is null or empty, say sorry
			if((!$question) || (!$answer1) || (!$answer2) || (!$isCorrect)){
				if($answer1=='0' || $answer2=='0')
				{
					//do nothing
				}else{
					echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
					exit();
				}
			}
		}

	 //if its a multiple choice question, do this-
		if($type == 'mc'){
		 //if any field is null or empty, say sorry
			if((!$question) || (!$answer1) || (!$answer2) || (!$answer3) || (!$answer4) || (!$isCorrect)){
				if($question=='0' || $answer1=='0' || $answer2=='0' || $answer3=='0' || $answer4=='0')
				{
					//do nothing
				}else{
					echo "Sorry, All fields must be filled in to add a new question to the quiz. Please press back in your browser and try again.";
					exit();
				}
			}
		}
		
	 //inserting the question and type into table question
		$sql = mysql_query("INSERT INTO questions (quiz_id, question, code, code_type, type) VALUES ('$quizID', '$question', '$program', '$programType', '$type')")or die(mysql_error());
		//lastId is there, so we can insert the id, question_id in our table
			$lastId = mysql_insert_id();
			mysql_query("UPDATE questions SET question_id='$lastId' WHERE id='$lastId' LIMIT 1")or die(mysql_error());

	 ///////Updating value of total questions in quizes
		mysql_query("UPDATE quizes SET total_questions=total_questions+1 WHERE quiz_id='$quizID' LIMIT 1")or die(mysql_error());


 	 /// Update answers based on which is correct //////////////

	 //if inserting a true/false question, insert answers by this-
		if($type == 'tf'){
		 //if answer1 is marked correct, do this--
			if($isCorrect == "answer1"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 //if answer2 is marked correct, do this--
			if($isCorrect == "answer2"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
				header('location: admin.php?msg='.$msg.'');
				exit();
			}	
		}

	 //if inserting a multiple choice question, insert answers by this-
		if($type == 'mc'){
		 //if answer1 is marked correct, do this--
			if($isCorrect == "answer1"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer3', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer4', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
			  	header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 //if answer2 is marked correct, do this--
			if($isCorrect == "answer2"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer3', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer4', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 //if answer3 is marked correct, do this--
			if($isCorrect == "answer3"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer3', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer4', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
		  		header('location: admin.php?msg='.$msg.'');
				exit();
			}
		 //if answer4 is marked correct, do this--
			if($isCorrect == "answer4"){
				$sql2 = mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer4', '1')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer1', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer2', '0')")or die(mysql_error());
				mysql_query("INSERT INTO answers (quiz_id, question_id, answer, correct) VALUES ('$quizID', '$lastId', '$answer3', '0')")or die(mysql_error());
				$msg = 'Thanks, question no.'.$lastId.' has been added';
			  	header('location: admin.php?msg='.$msg.'');
				exit();
			}
		}
	}
?>


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




<?php
//if resetTables is clicked
	if(isset($_POST['resetTables']) && $_POST['resetTables'] != ""){
		$resetT = $_POST['resetTables'];

		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

		$resetT = preg_replace('/[^a-z]/', "", $resetT);

		if($resetT=='yes'){
			mysql_query("TRUNCATE TABLE admins")or die(mysql_error());
			mysql_query("TRUNCATE TABLE answers")or die(mysql_error());
			mysql_query("TRUNCATE TABLE questions")or die(mysql_error());
			mysql_query("TRUNCATE TABLE quizes")or die(mysql_error());
			mysql_query("TRUNCATE TABLE quiz_takers")or die(mysql_error());

			mysql_query("INSERT INTO admins (username, password) 
            	VALUES ('admin','12345')")or die(mysql_error());
		}
		
		echo "Alright then, your database is now reset! Just re-login with new ID.";
		exit();

	}

?>



<?php
//When editaquestion is clicked
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	if(isset($_POST['editaquestion']) && $_POST['editaquestion'] != ""){
		$editQ = $_POST['editaquestion'];

		$get_quiz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
										WHERE quiz_name = '$editQ'")or die(mysql_error());
		$get_quiz_id_rows = mysql_fetch_array($get_quiz_id_SQL);
		$get_quiz_id = $get_quiz_id_rows['quiz_id'];

		$m_output='';

		if($editQ=='allthequestions')
			$multipleSQL = mysql_query("SELECT * FROM questions") or die(mysql_error());
		else
			$multipleSQL = mysql_query("SELECT * FROM questions WHERE quiz_id = '$get_quiz_id'");

			$m_display_ID = 1;

			while($m_row = mysql_fetch_array($multipleSQL)){
				$m_answers='';
			 //id var = id column and so on
				$m_id = $m_row['id'];
				$m_thisQuestion = $m_row['question'];
				$m_type = $m_row['type'];
				$m_question_id = $m_row['question_id'];
				$m_code = $m_row['code'];
				$m_code_type = $m_row['code_type'];
				$m_quiz_id = $m_row['quiz_id'];

				$m_quiz_id_SQL = mysql_query("SELECT quiz_name FROM quizes 
												WHERE quiz_id='$m_quiz_id'") or die(mysql_error());
				$m_quiz_id_SQL_row = mysql_fetch_array($m_quiz_id_SQL);
				$m_quiz_name = $m_quiz_id_SQL_row['quiz_name'];


				$m_q = '<tr>
							<td width="40px" rowspan="1" align="center">';

				if($editQ=='allthequestions'){
					$m_q .=	'<br>
								<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>
								<input type="radio" name="editAQ" value="'.$m_question_id.'">
								<small><i>('.$m_quiz_name.')</i></small><br>';
				}else{
					$m_q .= '	<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>
								<input type="radio" name="editAQ" value="'.$m_question_id.'">
							';
				}
						$m_q .=	'<pre class="question_style"><strong><div style="width: 730px; word-wrap: break-word;">'.$m_thisQuestion.'</div></strong></pre>
							</td>
						</tr>';

				if($m_code != "" && $m_code_type != ""){
					$m_q .='<tr>
							<td>
							</td>
							<td>
								<pre class="brush: '.$m_code_type.';">'.$m_code.'</pre>
							</td>
						</tr>
						';
				}

			 //gathering answers of question here
				$m_sql2 = mysql_query("SELECT * FROM answers WHERE question_id='$m_question_id'") or die(mysql_error());
				//running loop on all the answers

				$m_answers .=  '<tr>
									<td></td>
									<td>
										<ol type="a">
								';

					while($m_row2 = mysql_fetch_array($m_sql2)){
					//putting column values in variables
						$m_answer = $m_row2['answer'];
						$m_correct = $m_row2['correct'];

						if($m_correct == 1)
							$m_answers .= '<u><i>';
						$m_answers .= '<div style="width: 730px; word-wrap: break-word;"><li>'.$m_answer.'</li></div>';
						if($m_correct == 1)
							$m_answers .= '</i></u>';
					}

				$m_answers .=  '		</ol>
									</td>
								</tr>
								<tr height="20px"></tr>
								';

			 // the complete div that is sent back to quiz.php
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;
			}

			$m_display_ID--;

			$m_output .= '  <tr>
							<td colspan="2" align="center">

								<input type="hidden" name="total_ques" value="'.$m_display_ID.'">

								<span id="m_btnSpan">
									<a href="javascript:{}" onclick="editQ_submit()" class="myButton">Submit</a>
								</span>
							</td>
						</tr>';

			echo $m_output;
			exit();
	}
?>



<?php
//When editAQ is clicked
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	$editQoutput='';
	$gaq_question_id='';

	if(isset($_POST['editAQ']) && $_POST['editAQ'] != ""){
		$editAQ = $_POST['editAQ'];
		$editAQ = preg_replace('/[^0-9]/', "", $editAQ);

	 //getting everything about the question
		$getaquestion_SQL = mysql_query("SELECT * FROM questions 
						WHERE question_id='$editAQ'")or die(mysql_error());
		$getaquestion_row = mysql_fetch_array($getaquestion_SQL);

		$gaq_id = $getaquestion_row['id'];
		$gaq_quiz_id = $getaquestion_row['quiz_id'];
		$gaq_question_id = $getaquestion_row['question_id'];
		$gaq_question = $getaquestion_row['question'];
		$gaq_code_editor = $getaquestion_row['code'];
		$gaq_code_type = $getaquestion_row['code_type'];
		$gaq_type = $getaquestion_row['type'];
	 //converting program into what it ought to be
		$gaq_code_editor = htmlspecialchars_decode($gaq_code_editor);
		$gaq_code_editor = mysql_real_escape_string($gaq_code_editor);
		$gaq_code_editor = str_replace(array("\r\n", "\r", "\n"), '\n', $gaq_code_editor);



		$getanswers_SQL = mysql_query("SELECT * FROM answers 
						WHERE question_id='$editAQ'")or die(mysql_error());

	 //if question is true/false type
		if($gaq_type=='tf'){
			$editQoutput .= '<script>
								showDiv(\'tf\', \'mc\', \'quesans\');
								document.getElementById(\'quizIDtf\').value = '.$gaq_quiz_id.';
								document.getElementById(\'tfDesc\').value = "'.$gaq_question.'";
							 </script>
							';
		 //if there's programming code attached to the question, add this
			if($gaq_code_type!=""){
				$editQoutput .=	'<script>
									document.getElementById(\'prog-lang-tf\').value = \''.$gaq_code_type.'\';
								 	change_editor("'.$gaq_code_type.'");
								 	tfeditor.setValue("'.$gaq_code_editor.'");
							 	</script>
							 	';
			}
		 //getting answers of T/F questions
			$ga_index=1;
			while($getanswers_row = mysql_fetch_array($getanswers_SQL)){
				$ga_answer = $getanswers_row['answer'];
				$ga_correct = $getanswers_row['correct'];

				if($ga_correct==1 && $ga_answer=="True"){
					$editQoutput .= '<script>
										document.getElementById(\'tfans1\').checked=true;
									 </script>
									';
				}
				else if($ga_correct==1 && $ga_answer=="False"){
					$editQoutput .= '<script>
										document.getElementById(\'tfans2\').checked=true;
									 </script>
									';
				}
				$ga_index++;
			}
		 
		 //changing the submit button and action
			$editQoutput .= '<script>
								document.addQuestion.action = "editaquest.php";
								document.getElementById(\'addToQuizTF\').value = "Save";
							 </script>
							';

		}

	 //if the question is multiple choice!
		else if($gaq_type=='mc'){
			$editQoutput .= '<script>
								showDiv(\'mc\', \'tf\', \'quesans\');
								document.getElementById(\'quizIDmc\').value = '.$gaq_quiz_id.';
								document.getElementById(\'mcdesc\').value = "'.$gaq_question.'";
							 </script>
							';
			if($gaq_code_type!=""){
				$editQoutput .=	'<script>
									document.getElementById(\'prog-lang-mc\').value = \''.$gaq_code_type.'\';
								 	change_editor("'.$gaq_code_type.'");
								 	mceditor.setValue("'.$gaq_code_editor.'");
							 	 </script>
								';
			}

			$ga_index=1;
			while($getanswers_row = mysql_fetch_array($getanswers_SQL)){
				$ga_answer = $getanswers_row['answer'];
				$ga_correct = $getanswers_row['correct'];
				$ga_answer = mysql_real_escape_string($ga_answer);

				if($ga_correct==1){
					$editQoutput .= '<script>
										document.getElementById(\'mcans'.$ga_index.'\').checked=true;
									 </script>
									';
				}

				$editQoutput .= '<script>
									document.getElementById(\'mcanswer'.$ga_index.'\').value = \''.$ga_answer.'\';
								 </script>
								';

				$ga_index++;
			}

			$editQoutput .= '<script>
								document.addMcQuestion.action = "editaquest.php";
								document.getElementById(\'addToQuizMC\').value = "Save";
							 </script>
							';
		
		}






	}
?>




<?php
//When deleteSomeQuestions is clicked
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	if(isset($_POST['deleteSomeQuestions']) && $_POST['deleteSomeQuestions'] != ""){
		$deleteSQ = $_POST['deleteSomeQuestions'];

		$get_quiz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
										WHERE quiz_name = '$deleteSQ'")or die(mysql_error());
		$get_quiz_id_rows = mysql_fetch_array($get_quiz_id_SQL);
		$get_quiz_id = $get_quiz_id_rows['quiz_id'];

		$m_output='';

		if($deleteSQ=='allthequestions')
			$multipleSQL = mysql_query("SELECT * FROM questions") or die(mysql_error());
		else
			$multipleSQL = mysql_query("SELECT * FROM questions WHERE quiz_id = '$get_quiz_id'");

			$m_display_ID = 1;

			while($m_row = mysql_fetch_array($multipleSQL)){
				$m_answers='';
			 //id var = id column and so on
				$m_id = $m_row['id'];
				$m_thisQuestion = $m_row['question'];
				$m_type = $m_row['type'];
				$m_question_id = $m_row['question_id'];
				$m_code = $m_row['code'];
				$m_code_type = $m_row['code_type'];
				$m_quiz_id = $m_row['quiz_id'];

				$m_quiz_id_SQL = mysql_query("SELECT quiz_name FROM quizes 
												WHERE quiz_id='$m_quiz_id'") or die(mysql_error());
				$m_quiz_id_SQL_row = mysql_fetch_array($m_quiz_id_SQL);
				$m_quiz_name = $m_quiz_id_SQL_row['quiz_name'];


				$m_q = '<tr>
							<td width="40px" rowspan="1" align="center">';

				if($deleteSQ=='allthequestions'){
					$m_q .=	'<br>
								<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>
								<input type="checkbox" name="qu'.$m_display_ID.'" value="'.$m_question_id.'">
								<small><i>('.$m_quiz_name.')</i></small><br>';
				}else{
					$m_q .= '	<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>
								<input type="checkbox" name="qu'.$m_display_ID.'" value="'.$m_question_id.'">
							';
				}
						$m_q .=	'<pre class="question_style"><strong><div style="width: 730px; word-wrap: break-word;">'.$m_thisQuestion.'</div></strong></pre>
							</td>
						</tr>';

				if($m_code != "" && $m_code_type != ""){
					$m_q .='<tr>
							<td>
							</td>
							<td>
								<pre class="brush: '.$m_code_type.';">'.$m_code.'</pre>
							</td>
						</tr>
						';
				}

			 //gathering answers of question here
				$m_sql2 = mysql_query("SELECT * FROM answers WHERE question_id='$m_question_id'") or die(mysql_error());
				//running loop on all the answers

				$m_answers .=  '<tr>
									<td></td>
									<td>
										<ol type="a">
								';

					while($m_row2 = mysql_fetch_array($m_sql2)){
					//putting column values in variables
						$m_answer = $m_row2['answer'];
						$m_correct = $m_row2['correct'];

						if($m_correct == 1)
							$m_answers .= '<u><i>';
						$m_answers .= '<div style="width: 730px; word-wrap: break-word;"><li>'.$m_answer.'</li></div>';
						if($m_correct == 1)
							$m_answers .= '</i></u>';
					}

				$m_answers .=  '		</ol>
									</td>
								</tr>
								<tr height="20px"></tr>
								';

			 // the complete div that is sent back to quiz.php
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;
			}

			$m_display_ID--;

			$m_output .= '  <tr>
							<td colspan="2" align="center">

								<input type="hidden" name="total_ques" value="'.$m_display_ID.'">

								<span id="m_btnSpan">
									<a href="javascript:{}" onclick="quiz_submit()" class="myButton">Submit</a>
								</span>
							</td>
						</tr>';

			echo $m_output;
			exit();
	}
?>



<?php 
//if deleteAdmin is clicked, check--
	if(isset($_POST['deleteAdmin']) && $_POST['deleteAdmin'] != ""){
		$deleteA = $_POST['deleteAdmin'];

		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

		mysql_query("DELETE FROM admins WHERE username = '$deleteA'")or die(mysql_error());

	//checking the admins table
		$admin_SQL = mysql_query("SELECT id FROM admins 
									WHERE username = '$deleteA'")or die(mysql_error());
		$admin_numSQL = mysql_num_rows($admin_SQL);

		if($admin_numSQL > 0){
			echo "Sorry, there was a problem deleting the /".$deleteA."/ admin. Please try again later.";
			exit();
		}else{
			echo "Alright! The admin /".$deleteA."/ has now been deleted. You just have to logout now!";
			exit();
		}
	}
?>




<?php 
//if defaultQuiz is clicked, check--
	if(isset($_POST['defaultQuiz']) && $_POST['defaultQuiz'] != ""){
		$defaultQ = $_POST['defaultQuiz'];
		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	 ///////Updating value of set_default in quizes
		mysql_query("UPDATE quizes SET set_default=0 WHERE set_default=1")or die(mysql_error());
		mysql_query("UPDATE quizes SET set_default=1 WHERE quiz_name='$defaultQ'")or die(mysql_error());


 //checking if update is successful
	//getting rows from tables
		$defaultQ_sql1 = mysql_query("SELECT id FROM quizes WHERE set_default=1")or die(mysql_error());
	//getting number of rows that were returned
		$numDefaults = mysql_num_rows($defaultQ_sql1);
	//checking if the number of rows==0
		if($numDefaults < 1 || $numDefaults > 1){
			echo "Sorry, there was a problem setting /".$defaultQ."/ default. Please try again later.";
			exit();
		}else{
			echo "Thanks! The quiz, /".$defaultQ."/ has now been set as default.";
			exit();
		}
	}
?>






<?php 
//if clearResult is clicked, check--
	if(isset($_POST['clearResult']) && $_POST['clearResult'] != ""){
		$clearR = preg_replace('/^[a-z]/', "", $_POST['clearResult']);
		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	//deleting
		mysql_query("DELETE FROM quiz_takers WHERE quiz_id='$clearR'")or die(mysql_error());



 //checking if delete is successful
	//getting rows from tables
		$QuizTakersSQL = mysql_query("SELECT id FROM quiz_takers WHERE quiz_id='$clearR' LIMIT 1")or die(mysql_error());
	//getting number of rows that were returned
		$numQuizTakers = mysql_num_rows($QuizTakersSQL);
	//checking if the number of rows==0
		if($numQuizTakers > 0){
			echo "Sorry, there was a problem clearing the result. Please try again later.";
			exit();
		}else{
			echo "Result has been cleared!";
			exit();
		}
	}
?>






<?php 
//if reset is clicked, check--
	if(isset($_POST['reset']) && $_POST['reset'] != ""){
		$reset = preg_replace('/^[a-z]/', "", $_POST['reset']);
		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	//resetting the tables
		mysql_query("TRUNCATE TABLE questions")or die(mysql_error());
		mysql_query("TRUNCATE TABLE answers")or die(mysql_error());

	 ///////Updating value of total questions in quizes
		mysql_query("UPDATE quizes SET total_questions=0")or die(mysql_error());


 //checking if truncate is successful
	//getting rows from tables
		$sql1 = mysql_query("SELECT id FROM questions LIMIT 1")or die(mysql_error());
		$sql2 = mysql_query("SELECT id FROM answers LIMIT 1")or die(mysql_error());
	//getting number of rows that were returned
		$numQuestions = mysql_num_rows($sql1);
		$numAnswers = mysql_num_rows($sql2);
	//checking if the number of rows==0
		if($numQuestions > 0 || $numAnswers > 0){
			echo "Sorry, there was a problem reseting the quiz. Please try again later.";
			exit();
		}else{
			echo "Thanks! The all quizes have now been reset back to 0 questions.";
			exit();
		}
	}
?>




<?php 
//if deleteQuiz is clicked, check--
	if(isset($_POST['deleteQuiz']) && $_POST['deleteQuiz'] != ""){
		$deleteQ = $_POST['deleteQuiz'];

		/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	//resetting the tables
		$qz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
									WHERE quiz_name = '$deleteQ'")or die(mysql_error());
		$qz_id_SQL_row = mysql_fetch_array($qz_id_SQL);
        $qz_id = $qz_id_SQL_row['quiz_id'];

		mysql_query("DELETE FROM quizes WHERE quiz_id = '$qz_id'")or die(mysql_error());
		mysql_query("DELETE FROM questions WHERE quiz_id = '$qz_id'")or die(mysql_error());
		mysql_query("DELETE FROM answers WHERE quiz_id = '$qz_id'")or die(mysql_error());

 //checking if delete is successful
	//getting rows from tables
		$qz_sql1 = mysql_query("SELECT id FROM questions WHERE quiz_id = '$qz_id' LIMIT 1")or die(mysql_error());
		$qz_sql2 = mysql_query("SELECT id FROM answers WHERE quiz_id = '$qz_id' LIMIT 1")or die(mysql_error());
		$qz_sql3 = mysql_query("SELECT id FROM quizes WHERE quiz_id = '$qz_id' LIMIT 1")or die(mysql_error());

	//getting number of rows that were returned
		$qz_numQuestions = mysql_num_rows($qz_sql1);
		$qz_numAnswers = mysql_num_rows($qz_sql2);
		$qz_numQuizes = mysql_num_rows($qz_sql3);
	//checking if the number of rows==0
		if($qz_numQuestions > 0 || $qz_numAnswers > 0 || $qz_numQuizes > 0)
			echo "Sorry, there was a problem deleting the /".$deleteQ."/ quiz. Please try again later.";
		else
			echo "Thanks! The quiz /".$deleteQ."/ has now been deleted.";
		
		exit();
	}
?>





<?php
//php to get everything for menu quiz Management!

	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	$quizSelect = "";
	$quizesMenu = "";

	$quizIdSQL = mysql_query("SELECT quiz_id, quiz_name, display_questions, time_allotted FROM quizes") or die(mysql_error());

	 //getting individual quiz's info!
		while($quizID_row = mysql_fetch_array($quizIdSQL)){
			$m_quizID = $quizID_row['quiz_id'];
			$m_quiz_name = $quizID_row['quiz_name'];
			$m_disp_ques = $quizID_row['display_questions'];
			$m_time_alot = $quizID_row['time_allotted'];
		 //getting options for the selecting quiz part of create/edit question
			$quizSelect .= ' <option value="'.$m_quizID.'">'.$m_quiz_name.'</option>';
		 //getting the quiz menu!
			$quizesMenu .= '<li>'.$m_quiz_name.' (Q='.$m_disp_ques.', T='.$m_time_alot.')
					  			<ul>
					  				<li>Pengaturan Latihan
					  					<ul>
					  						<a href="javascript:default_quiz(\''.$m_quiz_name.'\')">
					  							<li>Set Sebagai Default</li>
					  						</a>
					  						<a href="javascript:update_quiz(\''.$m_quiz_name.'\')">
					  							<li>Perbaharui Metadata</li>
					  						</a>
					  						<a href="javascript:delete_quiz(\''.$m_quiz_name.'\')">
					  							<li>Hapus Latihan Ini</li>
					  						</a>
					  					</ul>
					  				</li>

					  				<li>Manajemen Pertanyaan
					  					<ul>
					  						<a href="javascript:view_questions(\''.$m_quiz_name.'\')">
					  							<li>Lihat Semua Pertanyaan</li>
					  						</a>
					  						<a href="javascript:edit_question(\''.$m_quiz_name.'\')">
					  							<li>Ubah Pertanyaan</li>
											</a>
											<a href="javascript:delete_some_questions(\''.$m_quiz_name.'\')">
					  							<li>Hapus Pertanyaan</li>
					  						</a>
					  					</ul>
					  				</li>



					  				<li>Hasil
					  					<ul>
					  						<a href="javascript:top_users(\''.$m_quiz_name.'\')">
					  							<li>Hasil(20 Besar)</li>
					  						</a>
					  						<a href="javascript:all_users(\''.$m_quiz_name.'\')">
					  							<li>Hasil(Seluruhnya)</li>
					  						</a>
					  						<a href="javascript:clear_result(\''.$m_quizID.'\')">
					  							<li>Hapus Hasil</li>
					  						</a>
					  					</ul>
					  				</li>

					  		'./*Everything is a single long list
					  				<a href="javascript:default_quiz(\''.$m_quiz_name.'\')">
					  					<li>Set Default</li>
					  				</a>
					  				<a href="javascript:view_questions(\''.$m_quiz_name.'\')">
					  					<li>View all Questions</li>
					  				</a>
					  				<a href="javascript:edit_question(\''.$m_quiz_name.'\')">
					  					<li>Edit a Question</li>
									</a>
					  				<a href="javascript:delete_some_questions(\''.$m_quiz_name.'\')">
					  					<li>Delete Some Questions</li>
					  				</a>
					  				<a href="javascript:update_quiz(\''.$m_quiz_name.'\')">
					  					<li>Update Metadata</li>
					  				</a>
					  				<a href="javascript:delete_quiz(\''.$m_quiz_name.'\')">
					  					<li>Delete this Quiz</li>
					  				</a>
					  				<a href="javascript:top_users(\''.$m_quiz_name.'\')">
					  					<li>Result(Top 20)</li>
					  				</a>
					  				<a href="javascript:clear_result(\''.$m_quizID.'\')">
					  					<li>Clear the Result</li>
					  				</a>
					  		*/'
					  			</ul>
			  				</li>';
		}
?>




<?php
//PHP for showing Top 20 Users
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	if(isset($_POST['usersQuiz']) && $_POST['usersQuiz'] != ""){
		$usersQ = $_POST['usersQuiz'];

		$get_quiz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
										WHERE quiz_name = '$usersQ'")or die(mysql_error());
		$get_quiz_id_rows = mysql_fetch_array($get_quiz_id_SQL);
		$get_quiz_id = $get_quiz_id_rows['quiz_id'];

		$m_output=' <tr align="center">
						<th>Rank</th>
						<th>Roll No.</th>
						<th>Marks</th>
						<th>Percentage</th>
						<th>Time Taken</th>
						<th>TimeStamp</th>
					</tr>
				 ';

		$multipleSQL = mysql_query("SELECT * FROM quiz_takers 
									WHERE quiz_id = '$get_quiz_id'
									ORDER BY marks desc, duration asc LIMIT 20");

			$m_display_ID = 1;

			while($m_row = mysql_fetch_array($multipleSQL)){
				$m_answers='';
			 //id var = id column and so on
				$m_id = $m_row['id'];
				$m_username = $m_row['username'];
				$m_marks = $m_row['marks'];
				$m_percentage = $m_row['percentage'];
				$m_duration = $m_row['duration'];
				$m_timestamp = $m_row['date_time'];

				
				$m_row = '<tr align="center">
							  <td>'.$m_display_ID.'</td>
							  <td>'.$m_username.'</td>
							  <td>'.$m_marks.'</td>
							  <td>'.$m_percentage.'</td>
							  <td>'.$m_duration.'</td>
							  <td>'.$m_timestamp.'</td>
						  </tr>
						 ';

			 // the complete div that is sent back to quiz.php
				$m_output .= $m_row;

				$m_display_ID++;
			}
			echo $m_output;
			exit();
	}
?>




<?php
//PHP for showing All Users
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	if(isset($_POST['usersAll']) && $_POST['usersAll'] != ""){
		$usersQ = $_POST['usersAll'];

		$get_quiz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
										WHERE quiz_name = '$usersQ'")or die(mysql_error());
		$get_quiz_id_rows = mysql_fetch_array($get_quiz_id_SQL);
		$get_quiz_id = $get_quiz_id_rows['quiz_id'];

		$m_output=' <tr align="center">
						<th>Rank</th>
						<th>Roll No.</th>
						<th>Marks</th>
						<th>Percentage</th>
						<th>Time Taken</th>
						<th>TimeStamp</th>
					</tr>
				 ';

		$multipleSQL = mysql_query("SELECT * FROM quiz_takers 
									WHERE quiz_id = '$get_quiz_id'
									ORDER BY marks desc, duration asc");

			$m_display_ID = 1;

			while($m_row = mysql_fetch_array($multipleSQL)){
				$m_answers='';
			 //id var = id column and so on
				$m_id = $m_row['id'];
				$m_username = $m_row['username'];
				$m_marks = $m_row['marks'];
				$m_percentage = $m_row['percentage'];
				$m_duration = $m_row['duration'];
				$m_timestamp = $m_row['date_time'];

				
				$m_row = '<tr align="center">
							  <td>'.$m_display_ID.'</td>
							  <td>'.$m_username.'</td>
							  <td>'.$m_marks.'</td>
							  <td>'.$m_percentage.'</td>
							  <td>'.$m_duration.'</td>
							  <td>'.$m_timestamp.'</td>
						  </tr>
						 ';

			 // the complete div that is sent back to quiz.php
				$m_output .= $m_row;

				$m_display_ID++;
			}
			echo $m_output;
			exit();
	}
?>





<?php
//PHP for showing all the questions
	/*require_once('scripts/connect_db.php');*/
    	require_once('scripts/koneksi.php');

	if(isset($_POST['questionsQuiz']) && $_POST['questionsQuiz'] != ""){
		$questionsQ = $_POST['questionsQuiz'];

		$get_quiz_id_SQL = mysql_query("SELECT quiz_id FROM quizes 
										WHERE quiz_name = '$questionsQ'")or die(mysql_error());
		$get_quiz_id_rows = mysql_fetch_array($get_quiz_id_SQL);
		$get_quiz_id = $get_quiz_id_rows['quiz_id'];

		$m_output='';

		if($questionsQ=='allthequestions')
			$multipleSQL = mysql_query("SELECT * FROM questions") or die(mysql_error());
		else
			$multipleSQL = mysql_query("SELECT * FROM questions WHERE quiz_id = '$get_quiz_id'");

			$m_display_ID = 1;

			while($m_row = mysql_fetch_array($multipleSQL)){
				$m_answers='';
			 //id var = id column and so on
				$m_id = $m_row['id'];
				$m_thisQuestion = $m_row['question'];
				$m_type = $m_row['type'];
				$m_question_id = $m_row['question_id'];
				$m_code = $m_row['code'];
				$m_code_type = $m_row['code_type'];
				$m_quiz_id = $m_row['quiz_id'];

				$m_quiz_id_SQL = mysql_query("SELECT quiz_name FROM quizes 
												WHERE quiz_id='$m_quiz_id'") or die(mysql_error());
				$m_quiz_id_SQL_row = mysql_fetch_array($m_quiz_id_SQL);
				$m_quiz_name = $m_quiz_id_SQL_row['quiz_name'];

			 //putting the question in h2 tag
				$m_q = '<tr>
							<td width="40px" rowspan="1" align="center">';

				if($questionsQ=='allthequestions'){
					$m_q .=	'<br>
								<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>
								<small><i>('.$m_quiz_name.')</i></small><br>';
				}else{
					$m_q .= '	<strong>'.$m_display_ID.'.</strong>
							</td>
							<td>';
				}
						$m_q .=	'<pre class="question_style"><strong><div style="width: 730px; word-wrap: break-word;">'.$m_thisQuestion.'</div></strong></pre>
							</td>
						</tr>';
				

				if($m_code != "" && $m_code_type != ""){
					$m_q .='<tr>
							<td></td>
							<td>
								<pre class="brush: '.$m_code_type.';">'.$m_code.'</pre>
							</td>
						</tr>
						';
				}

			 //gathering answers of question here
				$m_sql2 = mysql_query("SELECT * FROM answers WHERE question_id='$m_question_id'") or die(mysql_error());
				//running loop on all the answers

				$m_answers .=  '<tr>
									<td></td>
									<td>
										<ol type="a">
								';

					while($m_row2 = mysql_fetch_array($m_sql2)){
					//putting column values in variables
						$m_answer = $m_row2['answer'];
						$m_correct = $m_row2['correct'];

						if($m_correct == 1)
							$m_answers .= '<u><i>';
						$m_answers .= '<div style="width: 730px; word-wrap: break-word;"><li>'.$m_answer.'</li></div>';
						if($m_correct == 1)
							$m_answers .= '</i></u>';
					}

				$m_answers .=  '		</ol>
									</td>
								</tr>
								<tr height="20px"></tr>
								';

			 // the complete div that is sent back to quiz.php
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;
			}
			echo $m_output;
			exit();
	}
?>




































<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<title>Admin</title>

		<!-- ****** faviconit.com favicons ****** -->
            <!-- Basic favicons -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
                <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

            <!--[if IE]><link rel="shortcut icon" href="/favicon.ico"><![endif]-->

            <!-- For Opera Speed Dial -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For iPad with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For iPad with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For iPhone with high-resolution Retina Display running iOS ≥ 7 -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For iPhone with high-resolution Retina Display running iOS ≤ 6 -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For Google TV devices -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For iPad Mini -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For first- and second-generation iPad -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- For non-Retina iPhone, iPod Touch and Android 2.1+ devices -->
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
            <!-- Windows 8 Tiles -->
                <meta name="msapplication-TileColor" content="#FFFFFF">
                <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="img/favicon.ico">
        <!-- ****** faviconit.com favicons ****** -->

	    <!-- SYNTAX HIGHLIGHTER -->
			<link rel="stylesheet" type="text/css" href="sh/styles/shCore.css">
			<link rel="stylesheet" type="text/css" href="sh/styles/shThemeDefault.css">
			<link rel="stylesheet" type="text/css" href="css/main.css">
			<script type="text/javascript" src="sh/scripts/shCore.js"></script>
		   <!-- INCLUDING ALL BRUSHES SCRIPTS -->
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
		<!-- SYNTAX HIGHLIGHTER -->

	<!-- BUGGY CODE INPUT FIELD -->
		<link rel="stylesheet" href="codemirror/lib/codemirror.css">
		<script type="text/javascript" src="codemirror/codemirror-compressed.js"></script>
	<!--	
		<script src="codemirror/lib/codemirror.js"></script>

		<script src="codemirror/mode/clike/clike.js"></script>
		<script src="codemirror/mode/css/css.js"></script>
		<script src="codemirror/mode/diff/diff.js"></script>
		<script src="codemirror/mode/erlang/erlang.js"></script>
		<script src="codemirror/mode/groovy/groovy.js"></script>
		<script src="codemirror/mode/javascript/javascript.js"></script>
		<script src="codemirror/mode/perl/perl.js"></script>
		<script src="codemirror/mode/php/php.js"></script>
		<script src="codemirror/mode/python/python.js"></script>
		<script src="codemirror/mode/ruby/ruby.js"></script>
		<script src="codemirror/mode/sass/sass.js"></script>
		<script src="codemirror/mode/scala/scala.js"></script>
		<script src="codemirror/mode/shell/shell.js"></script>
		<script src="codemirror/mode/sql/sql.js"></script>
		<script src="codemirror/mode/vb/vb.js"></script>
		<script src="codemirror/mode/xml/xml.js"></script>
	-->
		
		<link rel="stylesheet" type="text/css" href="css/admin.css">



		<script type="text/javascript">
		//displaying different code-blocks on button click
			function showDiv(el1,el2,el3){
				document.getElementById(el1).style.display = 'block';
				document.getElementById(el2).style.display = 'none';
				document.getElementById(el3).style.display = 'none';
			}

		 //hide all divs
			function hideDivs(){
				document.getElementById('tf').style.display = 'none';
				document.getElementById('mc').style.display = 'none';
				document.getElementById('quesans').style.display = 'none';
			}



/*SETTING TIMELOCKS
			function set_timelock(quizz){
				
			}

			function remove_timelock(quizzz){

			}
*/


			function clear_result(qquizID){
				if(confirm("Apakah anda benar-benar ingin menghapus seluruh pertanyaan?!")) {
					var x = new XMLHttpRequest();
					var url = "admin.php";
					var vars = 'clearResult='+qquizID;
					x.open("POST", url, true);
					x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					x.onreadystatechange = function() {
						if(x.readyState == 4 && x.status == 200) {
							document.getElementById("msg").innerHTML = x.responseText;
						}
					}
					x.send(vars);
					document.getElementById("msg").innerHTML = "sedang memproses...";
				}
			}	
			


			
			function reset_tables(){
				if(confirm("Apakah anda benar-benar ingin menghapus tabel?!")) {
					if(confirm("Your admin ID will be \'admin\' and password \'12345\'")){
						var x = new XMLHttpRequest();
						var url = "admin.php";
						var vars = 'resetTables='+'yes';
						x.open("POST", url, true);
						x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						x.onreadystatechange = function() {
							if(x.readyState == 4 && x.status == 200) {
								window.open("login.php?user_msg="+x.responseText, "_self");
							}
						}
						x.send(vars);
						document.getElementById("msg").innerHTML = "sedang memproses...";
					}
				}
			}




			function delete_account(){
				if(confirm("Apakah anda benar-benar ingin menghapus akun Admin ini?!")) {
					var x = new XMLHttpRequest();
					var url = "admin.php";
					var vars = 'deleteAdmin='+'<?php echo $login_session; ?>';
					x.open("POST", url, true);
					x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					x.onreadystatechange = function() {
						if(x.readyState == 4 && x.status == 200) {
							document.getElementById("msg").innerHTML = x.responseText;
						}
					}
					x.send(vars);
					document.getElementById("msg").innerHTML = "sedang memproses...";
				}
			}


			function top_users(qiiizName){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'usersQuiz='+qiiizName;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						showDiv('quesans', 'mc', 'tf');
						document.getElementById("quesans_table").innerHTML = x.responseText;
						document.getElementById("msg").innerHTML = "";

					}
				}
				x.send(vars);
				document.getElementById("msg").innerHTML = "sedang memproses...";
			}



			function all_users(qqizName){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'usersAll='+qqizName;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						showDiv('quesans', 'mc', 'tf');
						document.getElementById("quesans_table").innerHTML = x.responseText;
						document.getElementById("msg").innerHTML = "";
					}
				}
				x.send(vars);
				document.getElementById("msg").innerHTML = "sedang memproses...";
			}


			function delete_some_questions(quizzName){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'deleteSomeQuestions='+quizzName;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						showDiv('quesans', 'mc', 'tf');
						document.getElementById("quesans_table").innerHTML = x.responseText;
						SyntaxHighlighter.highlight();
						document.getElementById("msg").innerHTML = "";
					}
				}
				x.send(vars);
				document.getElementById("msg").innerHTML = "sedang memproses...";
			}



			function edit_question(qzname){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'editaquestion='+qzname;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						showDiv('quesans', 'mc', 'tf');
						document.getElementById("quesans_table").innerHTML = x.responseText;
						SyntaxHighlighter.highlight();
						document.getElementById("msg").innerHTML = "";
					}
				}
				x.send(vars);
				document.getElementById("msg").innerHTML = "sedang memproses...";
			}


			function editQ_submit(){
				document.deleteedit.action = "admin.php";
	            document.getElementById('deleteedit').submit();
	        }


			function view_questions(qiizName){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'questionsQuiz='+qiizName;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						showDiv('quesans', 'mc', 'tf');
						document.getElementById("quesans_table").innerHTML = x.responseText;
						SyntaxHighlighter.highlight();
						document.getElementById("msg").innerHTML = "";
					}
				}
				x.send(vars);
				document.getElementById("msg").innerHTML = "sedang memproses...";
			}

			function default_quiz(qizName){
				var x = new XMLHttpRequest();
				var url = "admin.php";
				var vars = 'defaultQuiz='+qizName;
				x.open("POST", url, true);
				x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				x.onreadystatechange = function() {
					if(x.readyState == 4 && x.status == 200) {
						document.getElementById("resetBtnMsg").innerHTML = x.responseText;
					}
				}
				x.send(vars);
				document.getElementById("resetBtnMsg").innerHTML = "sedang memproses...";
			}


		//truncating the tables and resetting the quiz
			function delete_quiz(qzName){	
				if(confirm("Apakah anda benar-benar ingin menghapus latihan ini?!")) {
					var x = new XMLHttpRequest();
					var url = "admin.php";
					var vars = 'deleteQuiz='+qzName;
					x.open("POST", url, true);
					x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					x.onreadystatechange = function() {
						if(x.readyState == 4 && x.status == 200) {
							document.getElementById("resetBtnMsg").innerHTML = x.responseText;
						}
					}
					x.send(vars);
					document.getElementById("resetBtnMsg").innerHTML = "sedang memproses...";
				}
			}


		 //truncating the tables and resetting the quiz
			function resetQuiz(){	
				if(confirm("Apakah anda benar-benar ingin menghapus seluruh pertanyaan dari latihan ini?!")) {
					var x = new XMLHttpRequest();
					var url = "admin.php";
					var vars = 'reset=yes';
					x.open("POST", url, true);
					x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					x.onreadystatechange = function() {
						if(x.readyState == 4 && x.status == 200) {
							document.getElementById("resetBtnMsg").innerHTML = x.responseText;
						}
					}
					x.send(vars);
					document.getElementById("resetBtnMsg").innerHTML = "sedang memproses...";
				}
			}
		</script>

		<script type="text/javascript">
	 //updating metadata for a quiz
		function update_quiz(qname){
			open_overlay('regNewQuiz', 'regNewAdmin');
			document.newQuiz_name.action = "updateExistingQuiz.php";
			document.getElementById('quizName').value = qname;
			document.getElementById('quizName').readOnly = true;
			document.getElementById('quizTime').focus();
		}


		function change_pass(){
			open_overlay('regNewAdmin', 'regNewQuiz');
			document.reg_name.action = "changePassword.php";
			document.getElementById('login').value = '<?php echo $login_session; ?>';
			document.getElementById('login').readOnly = true;
			document.getElementById("password").focus();
		}

		</script>

		<script type="text/javascript">
		//overlays
			//hiding the overlay
			    function close_overlay(){
			        document.getElementById('register').style.display='none';
			        document.getElementById('fade').style.display='none';
			    }

			//showing the overlay
			    function open_overlay(ele1, ele2){

			    	document.getElementById(ele1).style.display = 'block';
					document.getElementById(ele2).style.display = 'none';

			        document.getElementById('register').style.display='block';
			        document.getElementById('fade').style.display='block';

			    	if(ele1=='regNewAdmin'){
			    		document.getElementById("register").style.height = '200px';
			    		document.getElementById("login").focus();
			    	}
			    	else{
			    		document.getElementById("register").style.height = '300px';
			    		document.getElementById("quizName").focus();
			    	}
			    }
		</script>

		<link rel="stylesheet" type="text/css" href="css/register.css">
		<link rel="stylesheet" type="text/css" href="css/addNewQuiz.css">

		<script type="text/javascript">

		function submit_admin(){
			var x=document.forms["reg_name"]["login"].value;
			var y=document.forms["reg_name"]["password"].value;
            if (x==null || x=="" || y==null || y==""){
                document.getElementById("required").innerHTML = "Enter Both Values";
                exit();
            }
			close_overlay();
            document.getElementById('reg_name').submit(); 
            return false;
		}

		</script>

		<script type="text/javascript">
			function quiz_submit(){
				document.deleteedit.action = "deleteSomeQues.php";
	            document.getElementById('deleteedit').submit(); 
	        }
		</script>

	</head>

	<body style="font-family: Arial;">
		
		<div id="admin_menu">
			<p style="color:#06F;" id="msg">
		   		<?php echo $msg; ?>
		   	</p>
		   	
			<ul>
				<span id="Hello">Pengatur Latihan 3DChem</span>

				<span id="Hello">Halo, <a href="admin.php"><span id="usr"><?php echo $login_session; ?>!</span></a></span>
			  	
			  	<li>Manajemen Soal
			  		<ul>
			  			<li>Buat Pertanyaan
			  				<ul>
			      				<a href="javascript:showDiv('tf', 'mc', 'quesans');">
			      					<li>Benar atau Salah</li>
			      				</a>
			      				<a href="javascript:showDiv('mc', 'tf', 'quesans');">
			      					<li>Pilihan Ganda</li>
			      				</a>
			    			</ul>
			  			</li>
			      		<a href="javascript:view_questions('allthequestions');">
			  				<li>Lihat Seluruh Pertanyaan</li>
			  			</a>
			  			<a href="javascript:edit_question('allthequestions');">
					  		<li>Ubah Pertanyaan</li>
						</a>
			  			<a href="javascript:delete_some_questions('allthequestions');">
					  		<li>Hapus Pertanyaan</li>
						</a>
			      		<a href="javascript:resetQuiz();">
			  				<li>Hapus Semua Pertanyaan</li>
			  			</a>
			  		</ul>
			    </li>
			  	<li>Manajemen Latihan
			  		<ul>
			  			<a href="javascript:open_overlay('regNewQuiz','regNewAdmin');">
			  				<li><span class="plus">+&nbsp;</span> Tambah Latihan Baru</li>
			  			</a>
			  			<?php echo $quizesMenu; ?>
			  		</ul>
			  	</li>
			  	
			  	<!--li>Pengaturan
			    	<ul>
			      		<a href="javascript:open_overlay('regNewAdmin','regNewQuiz');">
			      			<li>Daftarkan Seorang Admin</li>
			      		</a>
			      		<a href="javascript:change_pass();">
			      			<li>Ubah Password</li>
			      		</a>
			    		<a href="javascript:delete_account();">
			      			<li>Hapus Akun Anda</li>
			      		</a>
			      		<a href="javascript:reset_tables();">
			      			<li>Hapus Semua Tabel</li>
			      		</a>
			      		<a href="logout.php">
			      			<li>LogOut</li>
			      		</a>
			      		<a href="http://localhost/threejsbelajar_exp/modul/menus-admin.php">
			      			<li>Kembali ke Admin</li>
			      		</a>


			    	</ul>
			  	</li-->
			  	
			  	<a href="http://localhost/threejsbelajar-master/modul/menus-admin.php">Kembali ke Admin</a>


			</ul>

		    <br /><br />

		    <span id="resetBtnMsg"></span>
		</div>


		<div class="content" id="tf" style="margin-bottom: 100px;">
			<h2>Benar Atau Salah</h2>
    	
    		<form action="admin.php" name="addQuestion" method="POST">

    			<strong>Pilih Latihan yang akan ditambahkan soal</strong>
    			<select class="quizIDselect" name="quizID" id="quizIDtf">
    				<?php echo $quizSelect; ?>
    			</select>
    			<br />
    			<br />

    			<strong>Ketikkan Pertanyaan Baru Dibawah:</strong>
    			<br />

    			<textarea class="txt_area" id="tfDesc" name="desc"></textarea>
    			<br />
    			<br />


    			<strong>Pilih mana yang benar atau salah</strong>
    			<br />

            	<input type="text" class="tf_txt_box" id="answer1" name="answer1" value="Benar" readonly>&nbsp;
            	<label style="cursor:pointer; color:#555;">
            		<input type="radio" id="tfans1" name="iscorrect" value="answer1">Jawaban yang tepat?
            	</label>
    	  		<br />
   				<br />
            	<input type="text" class="tf_txt_box" id="answer2" name="answer2" value="Salah" readonly>&nbsp;
              	<label style="cursor:pointer; color:#555;">
            		<input type="radio" id="tfans2" name="iscorrect" value="answer2">Jawaban yang tepat?
            	</label>


    	  		<br />
    			<br />


    			<input type="hidden" value="tf" name="type">
     			<input type="hidden" value="<?php echo $gaq_question_id; ?>" name="questionID">
   				<input type="submit" class="add_to_quiz" id="addToQuizTF" value="Tambahkan ke Latihan">
    		</form>
 		</div>
 

 		<div class="content" id="mc" style="margin-bottom: 100px;">
  			<h2>Pilihan Ganda</h2>

    		<form action="admin.php" name="addMcQuestion" method="POST">

    			<strong>Pilih Latihan yang akan ditambahkan soal</strong>
    			<select class="quizIDselect" name="quizID" id="quizIDmc">
    				<?php echo $quizSelect; ?>
    			</select>
    			<br />
    			<br />

    			<strong>Ketikkan Pertanyaan Baru Dibawah:</strong>
        		<br />

        		<textarea class="txt_area" id="mcdesc" name="desc"></textarea>
        		<br />
      			<br />


    			<strong>Pilihan Pertama</strong>
    			<br />
        		<input type="text" class="mc_txt_box" id="mcanswer1" name="answer1">&nbsp;
          		<label style="cursor:pointer; color:#555;">
          			<input type="radio" id="mcans1" name="iscorrect" value="answer1">Jawaban yang benar?
        		</label>
      			<br />
    			<br />
    			<strong>Pilihan Kedua</strong>
    			<br />
        		<input type="text" class="mc_txt_box" id="mcanswer2" name="answer2">&nbsp;
          		<label style="cursor:pointer; color:#555;">
          			<input type="radio" id="mcans2" name="iscorrect" value="answer2">Jawaban yang benar?
        		</label>
      			<br />
    			<br />
    			<strong>Pilihan Ketiga</strong>
    			<br />
        		<input type="text" class="mc_txt_box" id="mcanswer3" name="answer3">&nbsp;
          		<label style="cursor:pointer; color:#555;">
          			<input type="radio"  id="mcans3" name="iscorrect" value="answer3">Jawaban yang benar?
        		</label>
      			<br />
    			<br />
    			<strong>Pilihan Keempat</strong>
    			<br />
        		<input type="text" class="mc_txt_box" id="mcanswer4" name="answer4">&nbsp;
          		<label style="cursor:pointer; color:#555;">
          			<input type="radio"  id="mcans4" name="iscorrect" value="answer4">Jawaban yang benar?
        		</label>
      			<br />
    			<br />
    			<input type="hidden" value="mc" name="type">
    			<input type="hidden" value="<?php echo $gaq_question_id; ?>" name="questionID">
    			<input type="submit" class="add_to_quiz" id="addToQuizMC" value="Tambahkan ke Latihan">
    		</form>
 		</div>


 		<div class="content" id="quesans"  style="margin-bottom: 100px;">
 			<form id="deleteedit" name="deleteedit" action="deleteSomeQues.php" method="POST">
	 			<table width="780px" align="center" id="quesans_table">
	 			</table>
 			</form>
 		</div>


 		<div id="register" class="white_content">

            <form action="register.php" class="login" method="POST" name="reg_name" id="regNewAdmin">
          		<p>
			      <label class="reg_label" for="login">Ketikkan Username:</label>
			      <input type="text" name="login" id="login" required="required">
			    </p>
			    <p>
			      <label class="reg_label" for="password">Ketikkan Password:</label>
			      <input type="password" name="password" id="password" required="required">
			    </p>
			    <p class="login-submit">
			      <button  onClick="submit_admin()" id="reg_button" class="login-button">Register</button>
			    </p>
			    <p id="required"></p>
			</form>

			<form action="addNewQuiz.php" class="newQuiz" method="POST" name="newQuiz_name" id="regNewQuiz">
				<p>
			      <label class="reg_label" for="quizName">Nama Latihan:</label><br>
			      <input type="text" name="quizName" id="quizName" required="required">
			    </p>
			    <p>
			      <label class="reg_label" for="quizTime">Alokasi Waktu:</label><br>
			      <input type="text" name="quizTime" id="quizTime" required="required">
			    </p>
			    <p>
			      <label class="reg_label" for="numQues">Jumlah Pertanyaan:</label><br>
			      <input type="text" name="numQues" id="numQues" required="required">
			    </p>
			    <p class="addQuiz-submit">
			      <button  onClick="submit()" id="addQuiz_button" class="addQuiz-button">Tambah Latihan</button>
			    </p>
			    <p id="required"></p>
			</form>

        </div>



        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>

        <br><BR><BR><BR><br><BR><BR><BR>


    <!-- Script for the codeMirror api -->
        <script type="text/javascript">

	        var tfeditor = CodeMirror.fromTextArea(document.getElementById("tfcodeDesc"), {
										lineNumbers: true,
								        matchBrackets: true,
								        indentUnit: 4,
								        indentWithTabs: true,
								        smartIndent: true,
								        styleActiveLine: true,
								        autoCloseBrackets: true,
								        autoCloseTags: true,
								        viewportMargin: Infinity,
								        fixedGutter: true
							});
			 var mceditor = CodeMirror.fromTextArea(document.getElementById("mccodeDesc"), {
										lineNumbers: true,
								        matchBrackets: true,
								        indentUnit: 4,
								        indentWithTabs: true,
								        smartIndent: true,
								        styleActiveLine: true,
								        autoCloseBrackets: true,
								        autoCloseTags: true,
								        viewportMargin: Infinity,
								        fixedGutter: true
							});



			 //JS for changing the textarea
				function lang_chosen(selectObj){
				 // get the index of the selected option 
					var idx = selectObj.selectedIndex;
				 // get the value of the selected option 
					var which = selectObj.options[idx].value;

					change_editor(which);
				}

				function change_editor(which){
					
					if(which=="cpp")
				   		var changedMode = "text/x-c++src";
				   	else if(which=="css")
					   var changedMode = "text/css";
					else if(which=="diff")
					   var changedMode = "text/x-diff";
					else if(which=="erlang")
					   var changedMode = "text/x-erlang";
					else if(which=="groovy")
					   var changedMode = "text/x-groovy";
					else if(which=="java" || which=="javafx")
					   var changedMode = "text/x-java";
					else if(which=="js")
					   var changedMode = "text/javascript";
					else if(which=="perl")
					   var changedMode = "text/x-perl";
					else if(which=="php")
					   var changedMode = "text/x-httpd-php";
					else if(which=="python")
					   var changedMode = "text/x-python";
					else if(which=="ruby")
					   var changedMode = "text/x-ruby";
					else if(which=="sass")
					   var changedMode = "text/x-sass";
					else if(which=="scala")
					   var changedMode = "text/x-scala";
					else if(which=="shell")
					   var changedMode = "text/x-sh";
					else if(which=="sql")
					   var changedMode = "text/x-sql";
					else if(which=="vbnet")
					   var changedMode = "text/x-vb";
					else if(which=="html")
					   var changedMode = "text/x-html";
					else if(which=="csharp")
					   var changedMode = "text/x-csharp";
					else if(which=="")
					   var changedMode = "text/plain";
					else
					   var changedMode = "text/plain";
					
					tfeditor.setOption("mode", changedMode);
					CodeMirror.autoLoadMode(tfeditor, changedMode);
					mceditor.setOption("mode", changedMode);
					CodeMirror.autoLoadMode(mceditor, changedMode);
				}


        </script>

        <?php echo $editQoutput; ?>

	</body>
</html>
