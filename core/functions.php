<?php
/*
General functions

Created: February 2014
*/


require_once(dirname(__FILE__) . '/database.php');


function getObject($pageName) {
	
	global $database;
	
	if($pageName == 'home') {
		return NULL;
	}
	elseif ($pageName == 'competition') {
		if(isset($_GET['competition'])) {
			$competitionId = intval(htmlspecialchars($_GET['competition']));
			return $database->getCompetitionById($competitionId);
		}
	}
	elseif ($pageName == 'tournament') {
		if(isset($_GET['tournament'])) {
			$tournamentId = intval(htmlspecialchars($_GET['tournament']));
			return $database->getTournamentById($tournamentId);
		}
	}
	elseif ($pageName == 'match') {
		if(isset($_GET['match'])) {
			$matchId = intval(htmlspecialchars($_GET['match']));
			return $database->getMatchById($matchId);
		}
	}
	elseif ($pageName == 'player') {
		if(isset($_GET['player'])) {
			$playerId = intval(htmlspecialchars($_GET['player']));
			return $database->getPlayerById($playerId);
		}
	}
	elseif ($pageName == 'coach') {
		if(isset($_GET['coach'])) {
			$coachId = intval(htmlspecialchars($_GET['coach']));
			return $database->getCoachById($coachId);
		}
	}
	elseif ($pageName == 'referee') {
		if(isset($_GET['referee'])) {
			$refereeId = intval(htmlspecialchars($_GET['referee']));
			return $database->getRefereeById($refereeId);
		}
	}
}


/**
Hash a password with a given salt
*/
function hashPassword($password,$salt) {
	return hash('sha256', $password . $salt);
}




/**
Check if logged in
*/
function loggedIn() {
	//Check for active session
	global $database;
	
	if( isset($_SESSION['userID']) and $database->doesUserExist($_SESSION['userID'])) {
		return true;
	}
	else {
		return false;
	}
}



function user() {

	//Check for active session
	global $database;
	
	if( isset($_SESSION['userID']) and $database->doesUserExist($_SESSION['userID'])) {
		$user = new User($_SESSION['userID']);
		return $user;
	}
	else {
		throw new exception('User is not logged in, or the user does not exist');
	}
}

function requireMinCount($array, $min) {
	if(count($array) < $min) {
		throw new exception('Array does not have the required minimum length of ' . $min);
	}
}

function requireMaxCount($array, $max) {
	if(count($array) > $max) {
		throw new exception('Array length is bigger than the maximum ' . $max);
	}
}

function requireEqCount($array, $eq) {
	if(count($array) != $eq) {
		throw new exception('Array length is not ' . $eq);
	}
}




function getLatestYear() {
	
	$months = array();
	
	for($i = 0; $i < 13; $i++) {
	
		$month = date("Y-m-1", strtotime("-$i months"));
		$months[] = array(
		
			'name' => date("M Y", strtotime("-$i months")),
			'timestamp' => strtotime(date("Y-m-1", strtotime("-$i months")))
		
		);
		
	}
	
	return array_reverse($months);
	
			
}



function generateChart($input, $id = 0, $type = 'Bar') {
	?>

	<div id="<?php echo $id; ?>" style="width: 100%; height: 300px;">

	</div>

	<script>
		var plotData = [];
		<?php
			$smallestX = 0;
			$smallestY = 0;
			$largestX = 0;
			$largestY = 0;
			foreach($input as $label => $data) {
		?>
				
				plotData['<?php echo $label; ?>'] = [
					<?php
						$i = 0;
						foreach($data as $x => $y) {
							$x *=  1000;
							if($i == 0) {
								$smallestX = $x;
								$smallestY = $y;
								$largestX = $x;
								$largestY = $y;
							}

							$smallestX = min($x, $smallestX);
							$smallestY = min($y, $smallestY);
							$largestX = max($x, $largestX);
							$largestY = max($y, $largestY);

							echo "[$x, $y]";

							if(next($data) !== false) {
								echo ',';
							}

							$i++;
						}
					?>
				];

		<?php
			}
		?>
	
		var plot = [];

		for(var i in plotData) {
			plot.push({
				data: plotData[i],
				label: i,
				bars: {show: true, barWidth: 60 * 60 * 24 * 27 * 1000},
			});
		}

		$.plot($('#<?php echo $id; ?>'), plot, {
			xaxis: {
				zoomRange: [<?php echo 0; ?>, <?php echo $largestX - $smallestX; ?>],
				panRange: [<?php echo $smallestX ?>, <?php echo $largestX ?>],
				mode: 'time',
				timeformat: "%b-%Y",
			},
			yaxis: {
				zoomRange: false,
				panRange: false,
			},
			zoom: {
				interactive: true
			},
			pan: {
				interactive: true
			},

		});
	</script>

	<?php
}





function getAllMonths($begin, $end = NULL) {
	
	
	if($end == NULL) {
		$end = time();
	}
	
	$month = strtotime(date('Y-m-1',strtotime("-1 month", $begin)));
	$months = array();
	
	while($month <= $end) {
		 $months[date('M Y', strtotime("+1 month", $month))] = $month = strtotime(date('Y-m-1',strtotime("+1 month", $month)));
	}
	
	return $months;
}




?>
