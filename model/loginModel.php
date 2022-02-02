<?php
class loginModel{
	public function model(){
		global $dbconn;
		$result = mysqli_query($dbconn, "SELECT name, password, isauth FROM users");
		$resultAuth = "";
		while ($row = mysqli_fetch_array($result)) {
			if($row["isauth"] == 1){
				$resultAuth = $row["name"];
			}
		}
		return $resultAuth;
	}
}
?>
