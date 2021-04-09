********************************************************

1: Template and Styling Document
	Requirement : PHP >= 7.2
	a. Open your terminal and go to the directory "templater"
	b. Run the command "php artisan serve". A php server should start.
	c. Open your browser and go to the url "http://127.0.0.1:8000"
	d. Click on the pagination links to load other pages.

	Note : Since the provided link for avatar and article thumbnail were not loading properly, I've used another dummy image for both of them. However you may see the commented out line that consist of original links.


********************************************************


2. MAQE  Bot
	Requirement : PHP 7.3
	a. Open your terminal and go to the directory "MAQEBot/app"
	b. run the command "php input.php <COMMAND>"
		eg. php input.php RW15RW1
	c. Output obtained as "X: ** Y: ** Direction: ***"
		eg. X : 15 Y : -1 Direction: South

	Note : To run the tests, run the command " ./vendor/bin/phpunit tests" from the "MAQEBot" path.

********************************************************