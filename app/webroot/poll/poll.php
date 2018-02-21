<?php
include('../config/db.php');
date_default_timezone_set('Asia/Calcutta');

// save others option
if($_POST['otherTxt'] != ''){
	if(check_exists($_POST['otherTxt'])){
		$sql="INSERT INTO poll_options(ques_id, value) VALUES('".$_GET["pollid"]."', '".$_POST["otherTxt"]."')";
		$query = mysql_query($sql);
		$id = mysql_insert_id();	
		//display question
		echo  $id;	
		return;
	}
}

function check_exists($option){
	$sql = "SELECT id FROM poll_options where value = '".$option."'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);	
	if(!empty($rows['id'])){
		echo  $rows['id'];	
		return 0;
	}else{
		return 1;
	}
}

// for poll result
if($_GET['pollid'] != ''){
	$sql = "SELECT ques FROM poll_questions where id = '".$_GET['pollid']."'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);	
	//display question
	echo "<p class=\"pollques\" ><b>".$rows['ques']."</b></p>";
	showresults($_GET['pollid']);
	
	die;
}

if(!$_POST['poll'] || !$_POST['pollid']){
	$user_id = $_GET['id'];
	$sql = "select pq.id,ques from poll_questions pq where pq.id not in (SELECT po.ques_id FROM poll_votes pv left join poll_options po on (po.id = pv.option_id) where pv.user_id = '$user_id' group by po.ques_id) and pq.status = '1' and pq.is_deleted = 'N' limit 1;";
	$query = mysql_query($sql);
	// if all polls voted.
		if(!mysql_num_rows($query)){
			$sql = "select pq.id,ques from poll_questions pq where pq.status = '1' and pq.is_deleted = 'N' order by pq.created_on desc limit 1";
			$query = mysql_query($sql);
		}
	
		if(mysql_num_rows($query)){
			
		$rows = mysql_fetch_assoc($query);			
		
			//display question
			echo "<p class=\"pollques\" >".$rows['ques']."</p>";
		
			$poll_id = $rows['id'];
	
			$check_query = "SELECT pq.id, ques,po.value FROM poll_questions pq inner join poll_options po on (pq.id = po.ques_id) inner join poll_votes pv on (pv.option_id = po.id  and pv.user_id = '$user_id') and is_deleted = 'N' and status = '1'  and pq.id = '$poll_id' group by pq.id ORDER BY created_on DESC";
			$result = mysql_query($check_query);
			
			if(!mysql_num_rows($result)){
				//display poll_options with radio buttons
				$query = mysql_query("SELECT id, value FROM poll_options WHERE ques_id = '$poll_id' and value != 'Others'");
				if(mysql_num_rows($query)){
					echo '<div id="formcontainer" ><form method="post" id="pollform" action="'.$_SERVER['PHP_SELF'].'" >';
					echo '<input type="hidden" name="pollid" id="pollID" value="'.$poll_id.'" />';
					while($row = mysql_fetch_assoc($query)){
						//$cls = $row['value'] == 'Others' ? 'otherCls' : '';
						echo '<p><input type="radio"  val="'.$row['value'].'" name="poll" class="otherCls" value="'.$row['id'].'" id="option-'.$row['id'].'" /> 
						<label for="option-'.$row['id'].'" >'.ucwords($row['value']).'</label></p>';						
					}
					//echo '<p><input type="hidden" id="hdnOther" /></p><input type="button" class="pollBtn"  value="Submit" /></p></form>';
					//echo '<p><a href="'.$_SERVER['PHP_SELF'].'?result=1" id="viewresult">View result</a></p></div>';
				}
				$query = mysql_query("SELECT id, value FROM poll_options WHERE ques_id = '$poll_id' and value = 'Others'");
				if(mysql_num_rows($query)){
					while($row = mysql_fetch_assoc($query)){
						//$cls = $row['value'] == 'Others' ? 'otherCls' : '';
						echo '<p><input type="radio"  val="'.$row['value'].'" name="poll" class="otherCls" value="'.$row['id'].'" id="option-'.$row['id'].'" /> 
						<label for="option-'.$row['id'].'" >'.ucwords($row['value']).'</label></p>';
						if($row['value'] == 'Others'){
							echo '<p><input type="text" name="otherTxt" id="otherTxt" style="display:none;margin-bottom:10px;"/></p>';
						}
					}
					
					//echo '<p><a href="'.$_SERVER['PHP_SELF'].'?result=1" id="viewresult">View result</a></p></div>';
				}
				echo '<p><input type="hidden" id="hdnOther" /></p><input type="button" class="pollBtn"  value="Submit" /></p></form>';
				
			}else{
				showresults($poll_id);
			}
		}
		
	
}else{
 
	
		
		//Check if selected option value is there in database?
		$query=mysql_query("SELECT * FROM poll_options WHERE id='".intval($_POST["poll"])."'");
		if(mysql_num_rows($query)){
			if($_GET['other_id'] != ''){
				$option_id = $_GET['other_id'];
			}else{
				$option_id = $_POST["poll"];
			}
			$query="INSERT INTO poll_votes(option_id, voted_on, ip, user_id) VALUES('".$option_id."', '".date('Y-m-d H:i:s')."', '".$_SERVER['REMOTE_ADDR']."', '".$_GET['id']."')";
			if(mysql_query($query))
			{
				//Vote added to database
						
			}
			else
				echo "There was some error processing the query: ".mysql_error();
		}
	
	
	
	showresults(intval($_POST['pollid']));
}
function showresults($poll_id){
	global $conn;
	$query=mysql_query("SELECT COUNT(*) as totalvotes FROM poll_votes WHERE option_id IN(SELECT id FROM poll_options WHERE ques_id='$poll_id')");
	while($row=mysql_fetch_assoc($query))
		$total=$row['totalvotes'];
	$query=mysql_query("SELECT poll_options.id, answer, poll_options.value, COUNT(*) as poll_votes FROM poll_votes, poll_options WHERE poll_votes.option_id=poll_options.id AND poll_votes.option_id IN(SELECT id FROM poll_options WHERE ques_id='$poll_id') GROUP BY poll_votes.option_id");
	while($row=mysql_fetch_assoc($query)){
		$percent=round(($row['poll_votes']*100)/$total);
		echo '<div class="option" ><p>'.ucwords($row['value']).' (<em>'.$percent.'%, '.$row['poll_votes'].' votes</em>)</p>';
		echo '<div class="bar ';
		if($_POST['poll']==$row['id']) echo ' yourvote';
		echo '" style="width: '.$percent.'%; " ></div></div>';
		
	}
	echo '<p>Total Votes: '.$total.'</p>';
	
	
	$query=mysql_query("SELECT answer,value from poll_options where ques_id='$poll_id'");
	while($row=mysql_fetch_assoc($query)){
		// get correct ans.
		if($row['answer'] == 1){	
			$correct_ans = $row['value'];
		}
	}
	if(!empty($correct_ans)){
		echo '<p>Correct Answer: '.$correct_ans.'</p>';
	}
}