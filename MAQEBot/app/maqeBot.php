<?php 
/**
 * robot Object Defination
 */
class maqeBot
{
	private $botLocation = array();
	private $botDirection;
	private $directionsReference;
	private $botCommands;
	private $isValidCommand;

	function __construct($cmd)
	{
		$this->botCommands = $cmd;
		$this->botLocation = array(0,0);
		$this->botDirection = 90;
		$this->directionsReference = array("90"=>"North", "0"=>"East", "180"=>"West", "270"=>"South");
		$this->isValidCommand = 1;
		$this->main();
	}

	private function main(){
		$this->botCommands = strtolower($this->botCommands);
		$this->executeCommand();
	}

	private function executeCommand(){
		$commandBlock = $this->parseCommand();
		foreach ($commandBlock as $cmd) {
			$cmd = explode("w", $cmd);
			$this->updateDirection($cmd[0]);
			$this->updatePosition($cmd[1]);
		}
	}

	private function updateDirection($dir){
		switch ($dir) {
			case 'r':
				$this->botDirection -= 90;
				break;
			case 'l':
				$this->botDirection += 90;
				break;
		}
		if ($this->botDirection == 360) {
			$this->botDirection = 0;
		}
		if ($this->botDirection < 0) {
			$this->botDirection = 360 + $this->botDirection;
		}
	}

	private function updatePosition($pos){
		$dir = $this->getCurrentDirection();
		if ($dir == "North" || $dir == "South") {
			if ($dir == "North") {
				$this->botLocation[1] += $pos;
			} else if ($dir == "South") {
				$this->botLocation[1] -= $pos;
			}
		} else if ($dir == "East" || $dir == "West"){
			if ($dir == "East") {
				$this->botLocation[0] += $pos;
			} else if ($dir == "West") {
				$this->botLocation[0] -= $pos;
			}
		}
	}

	public function getCurrentDirection(){
		return $this->directionsReference[$this->botDirection];
	}

	public function getCurrentPosition(){
		return "X : ".$this->botLocation[0]." Y : ".$this->botLocation[1];
	}

	public function getCurrentLocation(){
		if ($this->isValidCommand) {
			return $this->getCurrentPosition()." Direction: ".$this->directionsReference[$this->botDirection];
		} else {
			return "Invalid Command";
		}
	}

	private function parseCommand(){
		if (stripos($this->botCommands, "w") === 0) {
			$this->botCommands = "lr".$this->botCommands;	
		}

		$cmd = str_ireplace("r", "--r", $this->botCommands);
		$cmd = str_ireplace("l", "--l", $cmd);
		$cmd = array_filter(explode("--", $cmd));
		$normalizedCommand = array();
		$this->isValidCommand = 1;
		$normalizedCommand = $this->normalizeCommand($cmd);
		return $normalizedCommand;
	}

	private function normalizeCommand($cmd){
		foreach ($cmd as $com) {
			if (substr_count($com, "w") >= 2) {
				$comm = explode("w", $com);
				$dir = "";
				$steps = 0;
				foreach ($comm as $value) {
					if (is_numeric($value)) {
						$steps += $value;
					} else if (is_string($value)) {
						$dir = $value;
					}
				}
				$com = $dir."w".$steps;
			}

			if (stripos($com, "w") === false) {
				$cmdVar = $com."w0";
				$normalizedCommand[] = $cmdVar;
				$this->isValidCommand = preg_match("/lw\d*|rw\d*/", strtolower($cmdVar));		
			} else {
				$normalizedCommand[] = $com;
				$this->isValidCommand = preg_match("/lw\d*|rw\d*/", strtolower($com));
			}


			if (!$this->isValidCommand) {
				print_r("\n********************************\n");
				// echo "\nInvalid Command near -> ...$com...\n";
				echo "\nInvalid Command.\n";
				echo "\nErrors in the command provided. Please check the command and run again.\n";
				print_r("\n********************************\n");
				return [];
			}
		}
		return $normalizedCommand;
	}
}

?>