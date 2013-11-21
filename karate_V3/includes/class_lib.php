<!--Tyrone Overby
	New Karate site project
	version 3
	-->
<?php
	require ('includes/connector.php');
	require ('includes/getrecords.php');


?>

<?php
	class main
	{
		var $name;	

			function __construct($persons_name) {
		
					$this->name = $persons_name;
							}
	
	
			public function get_name() {
		
						return $this->name;
	
									}
	
	//protected methods and properties restrict access to those elements.
			protected function set_name($New_name) {
	
				if (name != "name") {
						$this->name = strtoupper($new_name);
											}
		
													}//end if 	
	

	}//end class main


?>
