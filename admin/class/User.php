<?php
    class User {
        private $conn;
        private $email;
        private $password;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getEmail() {
            return $this->email;
        }
        public function getPassword() {
            return $this->password;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setPassword($password) {
            $this->password = $password;
        }

        public function login() {
            $query = 'select * from cms_user where email = :email';
            $data = [
                'email' => $this->email
            ];
            try {
                $stm = $this->conn->prepare($query);
                $stm->execute($data);
                $user = $stm->fetch();
                if ($user && password_verify($this->password, $user['password'])) {
                    return $user;
                }
                return [];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getUsers() {
            $query = "select * from cms_user order by id desc";

            try {
                $statement = $this -> conn-> prepare($query);
                $statement -> execute();
                $users = $statement -> fetchAll(PDO::FETCH_ASSOC);

                return $users;
            }
            catch (PDOException $e) {
                echo $e -> getMessage();
            }
        }

        public function addUser($first_name, $last_name, $email, $password, $typeUser, $statusUser) {
            if (!isset($_GET['id'])) {
                $hashPass = password_hash($password, PASSWORD_DEFAULT);

                $newTypeUser = 0;
                if ($typeUser == 'typeAdmin') $newTypeUser = 1;
                else if ($typeUser == 'typeAuthor') $newTypeUser = 2;
    
                $newStatusUser = 0;
                if ($statusUser == 'statusActive') $newStatusUser = 0;
                else if ($statusUser == 'statusInactive') $newStatusUser = 1;

                $insert = "Insert Into cms_user (first_name, last_name, email, password, type, deleted) Values(:first_name, :last_name, :email, :hashPass, :newTypeUser, :newStatusUser);";

                $data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'hashPass' => $hashPass,
                    'newTypeUser' => $newTypeUser,
                    'newStatusUser' => $newStatusUser,
                ];

                try {
                    $statement = $this->conn->prepare($insert);
                    $statement->execute($data);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            else return;
        }

        public function updateUser($first_name, $last_name, $email, $password, $typeUser, $statusUser) {
            if (isset($_GET['id'])) {
                $hashPass = password_hash($password, PASSWORD_DEFAULT);

                $newTypeUser = 0;
                if ($typeUser == 'typeAdmin') $newTypeUser = 1;
                else if ($typeUser == 'typeAuthor') $newTypeUser = 2;
    
                $newStatusUser = 0;
                if ($statusUser == 'statusActive') $newStatusUser = 0;
                else if ($statusUser == 'statusInactive') $newStatusUser = 1;
    
                $update = "UPDATE cms_user SET first_name=:first_name, last_name=:last_name, email=:email, password=:hashPass, type=:newTypeUser, deleted=:newStatusUser WHERE id=:id";
    
                $data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'hashPass' => $hashPass,
                    'newTypeUser' => $newTypeUser,
                    'newStatusUser' => $newStatusUser,
                    'id' => $_GET['id']
                ];
    
                try {
                    $statement = $this->conn->prepare($update);
                    $statement->execute($data);
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            else return;
        }

        public function deleteUser($id) {
            $delete = "Delete From cms_user Where id=:id";
            $data = [
                "id" => $id,
            ];
        
            try {
                $statement = $this->conn->prepare($delete);
                $statement->execute($data);
        
                $dataDeleted = $this->getUsers();
                return $dataDeleted;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function totalUsers() {
            $query = 'select count(*) as total from cms_user';
            try {
                $statement = $this->conn->prepare($query);
                $statement->execute();
                $data = $statement->fetch();
                // if ($data) {
                //     $_SESSION['total_users'] = $data['total'];
                // }
                return $data['total'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>