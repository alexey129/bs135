<?php
class loginModel{
	public function model(){
		global $dbconn;
		$sql = 'SELECT name, password, isauth FROM users';
		$result = pg_query($dbconn, $sql);
		$resultAuth = '';
		while ($row = pg_fetch_row($result)) {
			if($row[2] == 't'){
				$resultAuth = $row[0];
			}
		}
		return $resultAuth;
	}
}
?>
