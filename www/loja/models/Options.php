<?php
class Options extends model {

	public function getName($id) {
		$sql = "SELECT name FROM options WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['name'];
		}
	}

}
