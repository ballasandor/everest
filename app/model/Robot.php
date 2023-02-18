<?php

	namespace App\Model;

	use Src\Engine\Model;

	class Robot extends Model
	{
		/**
		 * Table name
		 * @var string
		 */
		private $table = 'robots';

		/**
		 * Get Robot
		 * @param $id
		 * @return null
		 * @throws \Exception
		 */
		public  function getRobot($id)
		{
			$sql = "SELECT * FROM {$this->table} WHERE id='" . (int)$id . "'";
			$query = $this->db->query($sql);

			return $query->num_rows > 0 ? $query->row : null;
		}

		/**
		 * Get all robots from table
		 * @return mixed
		 * @throws \Exception
		 */
		public function getRobots()
		{
			$query = $this->db->query("SELECT * FROM {$this->table}");

			return $query->num_rows > 0 ? $query->rows : null;
		}

		/**
		 * Add new Robot to Database
		 * @param $data
		 * @throws \Exception
		 */
		public  function addRobot($data)
		{
			$sql = "INSERT INTO {$this->table} SET name='" . $this->db->escape($data['name']) . "', type='" . $this->db->escape($data['type']) . "', power='" . $data['power'] . "', created_at=NOW() ";
			$this->db->query($sql);
		}

		/**
		 * Edit Robot
		 * @param $id
		 * @param $data
		 * @throws \Exception
		 */
		public  function editRobot($id,$data){
			$sql = "UPDATE {$this->table} SET name='" .$this->db->escape($data['name']) . "', type='" . $this->db->escape($data['type']) . "', power='" . (int)$data['power'] . "' WHERE id='" . (int)$id . "' ";
			$this->db->query($sql);
		}

		/**
		 * Delete Robot
		 * @param $id
		 * @throws \Exception
		 */
		public  function deleteRobot($id){
			$sql = "DELETE FROM {$this->table} WHERE id='".$id."' ";
			$this->db->query($sql);
		}
	}