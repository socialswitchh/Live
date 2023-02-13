<?php

class Post {	
    
	private $postTable = 'gt_posts';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getPost(){		
		$sqlQuery = "SELECT * FROM ".$this->postTable." ORDER BY id DESC LIMIT 3";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();			
		return $result;	
	}

	public function getPostNotes(){		
		$sqlQuery = "SELECT * FROM gt_posts WHERE is_diary='Yes' AND (user_id='".$_SESSION['id']."' OR user_id='".$rows['id']."') ORDER BY id DESC";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();			
		return $result;	
	}
	
	public function insert(){
		
		if($this->title) {

			$stmt = $this->conn->prepare("INSERT INTO ".$this->postTable."(`user_id`, `title`, `description`, `is_diary`, `created_at`)
				VALUES(?, ?, ?, ? ,?)");
						
			$stmt->bind_param("sssss", $this->user_id, $this->title, $this->description, $this->is_diary, $this->created_at);
			$stmt->execute();
			/*if($stmt->execute()){	
				$lastPid = $stmt->insert_id;
				$sqlQuery = "
					SELECT id, message, user, DATE_FORMAT(created,'%d %M %Y %H:%i:%s') AS post_date
					FROM ".$this->postTable." WHERE id = '$lastPid'";
				$stmt2 = $this->conn->prepare($sqlQuery);				
				$stmt2->execute();
				$result = $stmt2->get_result();
				$record = $result->fetch_assoc();
				echo json_encode($record);
			}*/	
		}
	}

	public function update(){
		
		if($this->id && $this->description) { 
			$stmt = $this->conn->prepare("UPDATE ".$this->postTable." SET description = ? WHERE id = ?");
						
			$stmt->bind_param("si", $this->description, $this->id);
			
			if($stmt->execute()){					
				$sqlQuery = "
					SELECT id, title, description FROM ".$this->postTable." WHERE id = '".$this->id."'";
				$stmt2 = $this->conn->prepare($sqlQuery);				
				$stmt2->execute();
				$result = $stmt2->get_result();
				$record = $result->fetch_assoc();
				echo json_encode($record);
			}		
		}
	}
}
?>