<?php
/*
 * CREATE TABLE `users` (
 *  `id`               INT(11)      NOT NULL AUTO_INCREMENT,
 *  `username`         VARCHAR(100) NOT NULL,
 *  `auth_profile_id`  VARCHAR(36)  NOT NULL,
 *  PRIMARY KEY (`id`),
 *  INDEX (`username`)
 * );
 */

class Model {
	private $db_hostname = "localhost";
	private $db_database = "autharmor";
	private $db_user = "autharmoruser";
	private $db_password = "autharmorpassword";
	
	public function setAuthProfileIdForUsername(string $username, string $auth_profile_id) : void {
		$conn = new mysqli($this->db_hostname, $this->db_user, $this->db_password, $this->db_database);
		$stmt = $conn->prepare("INSERT INTO users (username, auth_profile_id) VALUES (?,?)");
		$stmt->bind_param("ss", $username, $auth_profile_id);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}
	
	public function getAuthProfileIdForUsername(string $username) : string {
		$conn = new mysqli($this->db_hostname, $this->db_user, $this->db_password, $this->db_database);
		$stmt = $conn->prepare("SELECT auth_profile_id FROM users WHERE username=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($auth_profile_id);
		$stmt->fetch();
		$stmt->close();
		$conn->close();
		return $auth_profile_id;
	}
}