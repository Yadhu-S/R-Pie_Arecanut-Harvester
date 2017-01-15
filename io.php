<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Arecanut Harvester IO</title>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
 
    <body style="background-color: #F5F5F5;">
		<?php
			$i="";
			for ( $i= 0; $i<32; $i++) {
				//set the pin's mode to output
				system("gpio mode ".$i." out");
			}
			$engage="";
			$en2=0;
			function step1($h,$k,$l,$r){
				system("gpio write ".$h." 0");
				system("gpio write ".$k." 0");
				system("gpio write ".$l." 0");
				system("gpio write ".$r." 1");
			}
			function step2($h,$k,$l,$r){
				system("gpio write ".$h." 0");
				system("gpio write ".$k." 1");
				system("gpio write ".$l." 0");
				system("gpio write ".$r." 0");
			}
			function step3($h,$k,$l,$r){
				system("gpio write ".$h." 0");
				system("gpio write ".$k." 0");
				system("gpio write ".$l." 1");
				system("gpio write ".$r." 0");
			}
			function step4($h,$k,$l,$r){
				system("gpio write ".$h." 1");
				system("gpio write ".$k." 0");
				system("gpio write ".$l." 0");
				system("gpio write ".$r." 0");
			}
			function clockwise($h,$k,$l,$r){
				step1($h,$k,$l,$r);
				usleep(100);
				step2($h,$k,$l,$r);
				usleep(100);
				step3($h,$k,$l,$r);
				usleep(100);
				step4($h,$k,$l,$r);
				usleep(100);
			}
			function cclockwise($h,$k,$l,$r){
				step4($h,$k,$l,$r);
				usleep(100);
				step3($h,$k,$l,$r);
				usleep(100);
				step2($h,$k,$l,$r);
				usleep(100);
				step1($h,$k,$l,$r);
				usleep(100);

			}
			if(isset($_POST['masterc'])){
				$masterrot=$_POST["rotatemaster"];
				while($masterrot!=0){
					clockwise("8","9","7","0");
					clockwise("2","3","12","13");
					clockwise("14","30","21","22");
					clockwise("15","16","1","4");
					clockwise("5","6","10","11");
					clockwise("31","26","27","28");
					$masterrot--;
				}
			}
			if(isset($_POST['mastercc'])){
				$masterrot=$_POST["rotatemaster"];
				while($masterrot!=0){
					cclockwise("8","9","7","0");
					cclockwise("2","3","12","13");
					cclockwise("14","30","21","22");
					cclockwise("15","16","1","4");
					cclockwise("5","6","10","11");
					cclockwise("31","26","27","28");
					$masterrot--;
				}
			}
			$lo="";
			for($lo=0;$lo<7;$lo++){
				if (isset($_POST["clock".$lo])) {
					$rot=$_POST["roatate".$lo];
					if($lo==1){
						while($rot!=0){
							echo $lo;
							clockwise("8","9","7","0");
							$rot--;
						}
					}
					elseif($lo==2){
						while($rot!=0){
							echo $lo;
							clockwise("2","3","12","13");
							$rot--;
						}
					}
					elseif($lo==3){
						while($rot!=0){
							echo $lo;
							clockwise("14","30","21","22");
							$rot--;
						}
					}
					elseif($lo==4){
						while($rot!=0){
							echo $lo;
							clockwise("15","16","1","4");
							$rot--;
						}
					}
					elseif($lo==5){
						while($rot!=0){
							echo $lo;
							clockwise("5","6","10","11");
							$rot--;
						}
					}
					elseif($lo==6){
						while($rot!=0){
							echo $lo;
							clockwise("31","26","27","28");
							$rot--;
						}
					}

				}
			}
			for($lo=0;$lo<7;$lo++){
				if (isset($_POST["cclock".$lo])) {
					$rot=$_POST["roatate".$lo];
					if($lo==1){
						while($rot!=0){
							echo $lo;
							cclockwise("8","9","7","0");
							$rot--;
						}
					}
					elseif($lo==2){
						while($rot!=0){
							echo $lo;
							cclockwise("2","3","12","13");
							$rot--;
						}
					}
					elseif($lo==3){
						while($rot!=0){
							echo $lo;
							cclockwise("14","30","21","22");
							$rot--;
						}
					}
					elseif($lo==4){
						while($rot!=0){
							echo $lo;
							cclockwise("15","16","1","4");
							$rot--;
						}
					}
					elseif($lo==5){
						while($rot!=0){
							echo $lo;
							cclockwise("5","6","10","11");
							$rot--;
						}
					}
					elseif($lo==6){
						while($rot!=0){
							echo $lo;
							cclockwise("31","26","27","28");
							$rot--;
						}
					}
				}
			}
		?>
		<div class="container">
			  <div class="jumbotron">
				<h1>Arecanut Harvester V 1.2</h1> 
		</div>
		<?php 
		$a='';
		$b='';
		$c=1;
		for($b=0;$b!=2;$b++){ 
			?>
				<div class="row">	
					<?php 
					for($a=1;$a!=4;$a++){ 			
					?>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-heading"><strong>Stepper <?php echo($c); ?></strong></div>
								<div class="panel-body">
									<div class="alert alert-info">
									  <strong>Output pins</strong>
									  <?php
									  	 if($c==1){
						
												echo ("8,9,7,0");
										}
										elseif($c==2){
												echo ("2,3,12,13");
										}
										elseif($c==3){
											echo("14,30,21,22");
										}
										elseif($c==4){
												echo("15,16,1,4");	
										}
										elseif($c==5){
												echo("5,6,10,11");
										}
										elseif($c==6){
												echo("31,26,27,28");
										} 
									   ?>
									</div>
									<form role="form" name="userForm" action="io.php" method="post">
									  <div class="form-group">
									    <label for="rot">Rotations</label>
									    <input type="number" class="form-control" name="roatate<?=$c?>" id="rot">
									  </div>
									  <button type="submit" class="btn btn-primary" name="clock<?=$c?>">ClockWise</button>
									  <button type="submit" class="btn btn-primary" name="cclock<?=$c?>">Coutner-ClockWise</button>
									</form>
								</div>
							</div>
						</div>
					<?php
					$c++;
					}
					?> 
				</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel-heading"><strong><u>Master Control</u></strong></div>
						<div class="panel-body">
							<div class="alert alert-warning">
								Engages all motors 
							</div>
								<form role="form" name="userForm" action="io.php" method="post">
								<div class="form-group">
									    <label for="rot">Rotations</label>
									    <input type="number" class="form-control" name="rotatemaster" id="rot">
								</div>
								<button type="submit" class="btn btn-danger" name="masterc">ClockWise</button>
								<button type="submit" class="btn btn-danger" name="mastercc">Counter-ClockWise</button>
								</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
