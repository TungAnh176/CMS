<?php

class Post {	
	private $postTable = 'cms_posts';
	private $categoryTable = 'cms_category';
	private $userTable = 'cms_user';	
	private $conn;
	
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getContent(){
		try{
			$sql="select cms_posts.id,title,name,CONCAT(first_name,last_name)as user,status,created,updated from cms_posts inner join cms_category on cms_category.id=cms_posts.category_id inner join cms_user on cms_posts.userid=cms_user.id order by cms_posts.id desc";
			$select=$this->conn-> prepare($sql);
			$select->execute();
			$data=$select->fetchAll(PDO::FETCH_ASSOC);
			$content="";
			foreach($data as $item){
				if($item['status']=='published'){
					$content .= "
					<tr>
						<td>{$item['title']}</td>
						<td>{$item['name']}</td>
						<td>{$item['user']}</td>
						<td><span class='label label-success'>{$item['status']}</span></td>
						<td>{$item['created']}</td>
						<td>{$item['updated']}</td>
						<td><a href='add_post.php?id={$item['id']}' class='btn btn-warning btn-xs update' previewlistener='true'>Edit</a></td>
						<td>
						
						<!-- Button trigger modal -->
						
						<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#a{$item['id']}'>
						  DELETE
						</button>
						
						<!-- Modal -->
						<div class='moda' id='a{$item['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
						  <div class='modal-dialog'>
							<div class='modal-content'>
							  <div class='modal-header'>
								<h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
								<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							  </div>
							  <div class='modal-body'>
								...
							  </div>
							  <div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
								<a  name='delete' id='{$item['id']}' class='btn btn-primary delete 'data-dismiss='modal'>Ok</a>
							  </div>
							</div>
						  </div>
						</div>
						</td>
					</tr>
				";
				}
				if($item['status']=='draft'){
					$content .= "
					<tr>
						<td>{$item['title']}</td>
						<td>{$item['name']}</td>
						<td>{$item['user']}</td>
						<td><span class='label label-warning'>{$item['status']}</span></td>
						<td>{$item['created']}</td>
						<td>{$item['updated']}</td>
						<td><a href='add_post.php?id={$item['id']}' class='btn btn-warning btn-xs update' previewlistener='true'>Edit</a></td>
						<td>

						<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#a{$item['id']}'>
						  DELETE
						</button>
						
						<!-- Modal -->
						<div class='modal' id='a{$item['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
						  <div class='modal-dialog'>
							<div class='modal-content'>
							  <div class='modal-header'>
								<h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
								<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							  </div>
							  <div class='modal-body'>
								...
							  </div>
							  <div class='modal-footer'>
								<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
								<a  name='delete' id='{$item['id']}' class='btn btn-primary delete 'data-dismiss='modal'>Ok</a>
							  </div>
							</div>
						  </div>
						</div>
					</td>
					</tr>
				";
				}
				if($item['status']=='archived'){
					$content .= "
					<tr>
						<td>{$item['title']}</td>
						<td>{$item['name']}</td>
						<td>{$item['user']}</td>
						<td><span class='label label-danger'>{$item['status']}</span></td>
						<td>{$item['created']}</td>
						<td>{$item['updated']}</td>
						<td><a href='add_post.php?id={$item['id']}' class='btn btn-warning btn-xs update' previewlistener='true'>Edit</a></td>
						<td>

						<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#a{$item['id']}'>
						DELETE
					  </button>
					  
					  <!-- Modal -->
					  <div class='modal' id='a{$item['id']}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
						<div class='modal-dialog'>
						  <div class='modal-content'>
							<div class='modal-header'>
							  <h1 class='modal-title fs-5' id='exampleModalLabel'>Modal title</h1>
							  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							</div>
							<div class='modal-body'>
							  ...
							</div>
							<div class='modal-footer'>
							  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
							  <a  name='delete' id='{$item['id']}' class='btn btn-primary delete 'data-dismiss='modal'>Ok</a>
							</div>
						  </div>
						</div>
					  </div>
						</td>
					</tr>
				";
				}
				
			
			}
			return $content;
		}
		catch(PDOException $ex){

			echo $ex->getMessage();
	
		}
		}
	public function updateInsert(){
		try{
			
			$sql="select id from cms_category where name= :name";
			$select=$this->conn->prepare($sql);
			$data=[
				'name'=>$_POST['category']
			];
			$select->execute($data);
			$idCategory=$select->fetch(PDO::FETCH_ASSOC);
			$id=$_GET['id'] ?? null;
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$currentDateTime = new DateTime();
			$time = $currentDateTime->format('Y-m-d H:i:s');
			if(!empty($id)){
				$sql="update cms_posts set title=:title, message=:message,category_id=:category_id,status=:status,updated=:updated where id=:id";
				$data=[
					'id'=>$id,
					'title'=>$_POST['title'],
					'message'=>$_POST['message'],
					'status'=>$_POST['status'],
					'category_id'=>$idCategory['id'],
					'updated'=>$time
				];
			}else{

				$sql="insert into cms_posts(title,message,category_id,status,userid,created) values(:title,:message,:category_id,:status,:user_id,:created)";
				$data=[
					'title'=>$_POST['title'],
					'message'=>$_POST['message'],
					'status'=>$_POST['status'],
					'category_id'=>$idCategory['id'],
					'user_id'=>$_SESSION['user_id'],
					'created'=>$time
				];
	
			}
			
			$update=$this->conn->prepare($sql);
			$update->execute($data);
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}
	public function getPosts(){
		try{
			$sql="select * from cms_posts inner join cms_category on cms_category.id=cms_posts.category_id where cms_posts.id=:id";
			$select=$this->conn->prepare($sql);
			$data=[
				'id'=>$_GET['id']?? null
			];
			$select->execute($data);
			$data=$select->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		catch(PDOException $ex){
			echo $ex->getMessage();

		}
	}
	public function getCategory(){
		try{
			$sql="select * from cms_category";
			$select=$this->conn->prepare($sql);
			$select->execute();
			$data=$select->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}
		catch(PDOException $ex){
			echo $ex->getMessage();

		}
	}
	public function postDelete($id=0){
		try{
			$sql="delete from cms_posts where id=:id";
			$delete=$this->conn->prepare($sql);
			$data=[
				'id'=>$id
			];
			$delete->execute($data);
		}
		catch(PDOException $ex){
			echo $ex->getMessage();

		}
	}
	
	public function totalPost(){		
		$sqlQuery = "SELECT count(*) as total FROM ".$this->postTable;			
		$stmt = $this->conn->prepare($sqlQuery);			
		$stmt->execute();
		$result = $stmt->fetch();
		// if ($result) {
		// 	$_SESSION['total_posts'] = $result['total'];
		// }	
		return $result['total'];
	}	
}
?>