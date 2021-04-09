<?php

use PHPUnit\Framework\TestCase;
require ("app/maqeBot.php");

class maqeBotTest extends TestCase {

	public $testWrongCommand = "asdfasdf";//"RW15RW1";
	public $testCorrectCommand = "RW15RW1";

	public function testFinalResult(){
		$bot = new maqeBot($this->testWrongCommand);
		$loc = $bot->getCurrentLocation();
		$this->assertStringContainsString('Invalid Command', $loc, "Invalid Command Input");
		
		$bot = new maqeBot($this->testCorrectCommand);
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : 15 Y : -1 Direction: South", $loc);

		$bot = new maqeBot("W5RW5RW2RW1R");
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : 4 Y : 3 Direction: North", $loc);

		$bot = new maqeBot("RRW11RLLW19RRW12LW1");
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : 7 Y : -12 Direction: South", $loc);

		$bot = new maqeBot("LLW100W50RW200W10");
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : -210 Y : -150 Direction: West", $loc);

		$bot = new maqeBot("LLLLLW99RRRRRW88LLLRL");
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : -99 Y : 88 Direction: East", $loc);

		$bot = new maqeBot("W55555RW555555W444444W1");
		$loc = $bot->getCurrentLocation();
		$this->assertEquals("X : 1000000 Y : 55555 Direction: East", $loc);
	}
}


?>