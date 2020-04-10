<html>
<?php require 'dbconfig.php';
session_start(); ?>

<head>
	<title>My Quiz</title>
	<style>
		body {
			background: url("bg2.jpg");
			background-size: 100%;
			background-repeat: no-repeat;
			position: relative;
			background-attachment: fixed;
		}

		/* button */
		.button {
			display: inline-block;
			border-radius: 4px;
			background-color: #f4511e;
			border: none;
			color: #FFFFFF;
			text-align: center;
			font-size: 28px;
			padding: 20px;
			width: 500px;
			transition: all 0.5s;
			cursor: pointer;
			margin: 5px;
		}

		.button span {
			cursor: pointer;
			display: inline-block;
			position: relative;
			transition: 0.5s;
		}

		.button span:after {
			content: '\00bb';
			position: absolute;
			opacity: 0;
			top: 0;
			right: -20px;
			transition: 0.5s;
		}

		.button:hover span {
			padding-right: 25px;
		}

		.button:hover span:after {
			opacity: 1;
			right: 0;
		}

		.title {
			background-color: #ccc11e;
			font-size: 28px;
			padding: 20px;

		}

		.button3 {
			border: none;
			color: white;
			padding: 10px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			-webkit-transition-duration: 0.4s;
			/* Safari */
			transition-duration: 0.4s;
			cursor: pointer;
		}

		.button3 {
			background-color: white;
			color: black;
			border: 2px solid #f4e542;
		}

		.button3:hover {
			background-color: #f4e542;
			color: Black;
		}

		.username-div {
			margin-bottom: 10px
		}

		.username {
			font-size: 20px;
			padding-right: 20px;
		}

		.input-name {
			height: 30px;
		}
	</style>
</head>

<body>
	<center>
		<div class="title">My Quiz</div>
		<?php
		if (isset($_POST['click']) || isset($_GET['start'])) {
			@$_SESSION['clicks'] += 1;
			$_SESSION['loose'] = 0;
			if (!empty($_GET['username'])) {
				$_SESSION['username'] = $_GET['username'];
			} else {
				$_SESSION['username'] = '';
			}
			//	$answer = "SELECT `ans` FROM `quiz`;";
			//$aaa=mysqli_query($con,$answer);
			$c = $_SESSION['clicks'];
			//$u=1;
			//$r = mysqli_fetch_array($aaa, MYSQLI_ASSOC);
			//$fet="SELECT `ans` FROM `quiz` WHERE id=$c-1";
			//$res = mysqli_query($con,$fet);
			//while($row = mysqli_fetch_assoc($res)) {
			//print_r($row);
			//$nu=mysqli_fetch_array($resul,MYSQLI_ASSOC);
			//if (isset($_POST['userans'])){
			//if($r[0]['ans']!=$_POST['userans']){
			//exit("You Lose");
			//}
			//}

			if (isset($_POST['userans'])) {
				$_SESSION['loose'] = 0;
				$userselected = $_POST['userans'];
				//while($row = mysqli_fetch_assoc($res)) {
				//if ($userselected!=$row)
				//{
				//	print("loose");
				//}
				//}
				//print_r($row);
				// $selectRightAns = "SELECT `ans` from `quiz` WHERE `id`=$c-1";
				// $r1 = mysqli_query($con, $q1);
				// while ($rrow = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
				// 	if()
				// }


				$fetchqry2 = "UPDATE `quiz` SET `userans`=`$userselected` WHERE `id`=$c-1";



				$result2 = mysqli_query($con, $fetchqry2);
			}

			$id = $c - 1;
			// $u+=1;
			$q1 = "SELECT `ans`, `userans` FROM `quiz` where `id`=$id";
			$r1 = mysqli_query($con, $q1);
			while ($rrow = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
				if ($rrow['ans'] != $_POST['userans']) {
					$_SESSION['loose'] = 1;
					// header("Location: http://localhost/quiz/quiz1.php");
					// exit;
				}
			}
		} else {
			$_SESSION['username'] = '';
			$_SESSION['clicks'] = 0;
			$_SESSION['loose'] = 0;
		}

		//echo($_SESSION['clicks']);
		?>
		<div class="bump"><br>
			<form><?php if ($_SESSION['clicks'] == 0) { ?> <div class="username-div"><label class="username">Username</label><input class="input-name" type="text" placeholder="Ented your name" name="username"></div> <button class="button" name="start" float="left"><span>START QUIZ</span></button> <?php }
																																																																										if ($_SESSION['loose'] == 1) { ?>
					<p> You loose </p>
					<button> <a href="http://localhost/quiz2/quiz1.php"> Go to home page </a> </p>
					<?php } ?>
			</form>
		</div>
		<?php if ($_SESSION['loose'] == 0 && !empty($_SESSION['username'])) { ?>
			<form action="" method="post">
				<table><?php if (isset($c)) {
							$fetchqry = "SELECT * FROM `quiz` where id='$c'";
							$result = mysqli_query($con, $fetchqry);
							$num = mysqli_num_rows($result);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						}
						?>
					<tr>
						<td>
							<h3><br><?php echo @$row['que']; ?></h3>
						</td>
					</tr> <?php if ($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 6) { ?>
						<tr>
							<td><input required type="radio" name="userans" value="<?php echo $row['option 1']; ?>">&nbsp;<?php echo $row['option 1']; ?><br>
						<tr>
							<td><input required type="radio" name="userans" value="<?php echo $row['option 2']; ?>">&nbsp;<?php echo $row['option 2']; ?></td>
						</tr>
						<tr>
							<td><input required type="radio" name="userans" value="<?php echo $row['option 3']; ?>">&nbsp;<?php echo $row['option 3']; ?></td>
						</tr>
						<tr>
							<td><input required type="radio" name="userans" value="<?php echo $row['option 4']; ?>">&nbsp;<?php echo $row['option 4']; ?><br><br><br></td>
						</tr>
						<tr>
							<td><button class="button3" name="click">Next</button></td>
						</tr> <?php }
								?>
					<form>
					<?php }else if($_SESSION['username'] == '' && $_SESSION['clicks'] > 0){?> <p> Please enter your name. </p> <button> <a href="http://localhost/quiz2/quiz1.php"> Go to home page </a> </p> <?php }
				if ($_SESSION['clicks'] > 5 && $_SESSION['loose'] == 0) {
					$qry3 = "SELECT `ans`, `userans` FROM `quiz`;"; //q1 = "SELECT `ans`, `userans` FROM `quiz` where `id`=$c-1;"
					$result3 = mysqli_query($con, $qry3); //r1 = mysqli_query($con,$q1)
					$storeArray = array();
					while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) { //while ($rrow= mysqli_fetch_array(r1, MYSQLI_ASSOC))
						if ($row3['ans'] == $row3['userans']) {
							@$_SESSION['score'] += 1;
						}
					}

					?>


						<h2>Result</h2>
						<span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score'];
															?></span><br>
						<span>Your Score:&nbsp<?php echo $no * 2;
												$name = $_SESSION['username'];
												$insertWinner = "INSERT INTO `winner` (`name`) VALUES ('$name') ";
												$result2 = mysqli_query($con, $insertWinner);
												?> <p><h2><?php echo $_SESSION['username'] ?> is winner</h2></p></span>
												<button> <a href="http://localhost/quiz2/quiz1.php"> Go to home page </a> </p>
					<?php  session_unset(); } ?>
						<!-- <script type="text/javascript">
    function radioValidation(){
		/* var useransj = document.getElementById('rd').value;
        //document.cookie = "username = " + userans;
		alert(useransj); */
		var uans = document.getElementsByName('userans');
		var tok;
		for(var i = 0; i < uans.length; i++){
			if(uans[i].checked){
				tok = uans[i].value;
				alert(tok);
			}
		}
    }
</script> -->
	</center>
</body>

</html>