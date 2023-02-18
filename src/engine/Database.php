<?php

	namespace Src\Engine;


	/**
	 * Database Class
	 */
	class Database
	{
		/**
		 * MySQLi Connection
		 * @var \mysqli
		 */
		private $conn;
		private $hostname;
		private $username;
		private $password;
		private $database;
		private $port;

		public function __construct()
		{
			$this->hostname = defined('DB_HOST') ? DB_HOST : '';
			$this->username = defined('DB_USERNAME') ?  DB_USERNAME : '';
			$this->password = defined('DB_PASSWORD') ?  DB_PASSWORD : '';
			$this->database = defined('DB_DATABASE') ?  DB_DATABASE : '';
			$this->port = defined('DB_PORT') ?  DB_PORT : '3306';

			$this->connect();
		}

		public function query(string $sql) {
			$query = $this->conn->query($sql);

			if (!$this->conn->errno) {
				if ($query instanceof \mysqli_result) {
					$data = [];

					while ($row = $query->fetch_assoc()) {
						$data[] = $row;
					}

					$result = new \stdClass();
					$result->num_rows = $query->num_rows;
					$result->row = isset($data[0]) ? $data[0] : [];
					$result->rows = $data;

					$query->close();

					unset($data);

					return $result;
				} else {
					return true;
				}
			} else {
				throw new \Exception('Error: ' . $this->conn->error  . '<br />Error No: ' . $this->conn->errno . '<br />' . $sql);
			}
		}

		public function escape(string $string){
			return $this->conn->real_escape_string($string);
		}


		private function connect(){
			try {
				$mysqli = new \MySQLi($this->hostname, $this->username, $this->password, $this->database, $this->port);
			} catch (mysqli_sql_exception $e) {
				throw new \Exception('Error: Could not make a database link using ' . $this->username . '@' . $this->hostname . '!');
			}

			if (!$mysqli->connect_errno) {
				$this->conn = $mysqli;
				$this->conn->set_charset('utf8');
				$this->conn->query("SET SESSION sql_mode = 'NO_ZERO_IN_DATE,NO_ENGINE_SUBSTITUTION'");
			} else {
				throw new \Exception('Error: Could not make a database link using ' . $this->username . '@' . $this->hostname . '!');
			}
		}

	}