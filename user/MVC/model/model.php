  <?php
  class model {
    protected $pdo;
    protected $table;

    public function __construct($server, $database, $user, $password)
    {
      //connexion

      $this-> pdo = null;
      try{
        $this-> pdo = new PDO("mysql:host=".$server.";dbname=".$database, $user, $password);
      }
      catch (Exception $exp)
      {
        echo "Error connexion to " . $server . "/" . $database;
      }
    }

    //method for init a table in database
    public function inform($table) {
      //init table
      $this-> table = $table;
    }

    //method for select several results
    public function selectAll() {
      if($this->pdo != null) {
        $request = "select * from ".$this->table.";";
        $select = $this-> pdo-> prepare($request);
        $select-> execute();
        $results = $select -> fetchAll();
        return $result;
        } else {
        return null;
      }
    }

    //method select with a where for an only one result
    public function selectWhere($fields, $where) {
      $stringFields = implode(",", $fields); 
      $clause = array(); 
      $data = array();

      foreach ($where as $key => $value) {
        $clause[] = $key."= :".$key; 
        $data[":".$key] = $value;
      }

      $stringClause = implode(" and ", $clause);
      $request = "select ".$stringFields." from  ".$this->table."  where  ".$stringClause.";";
      $select = $this ->pdo->prepare($request);
      $select ->execute($data);
      $oneResult = $select->fetch();
      return $oneResult;
    }

    //method insert in database
    public function insert($tab)
    {
      $fields = array();
      $data = array();
      $values = array();

      foreach ($tab as $key => $value) {
        $fields[] = $key;
        $values[]= ":".$key;
        $data[":".$key] = $value;
      }

      $listFields = implode(",", $fields);
      $stringFields = implode(",", $values);

      $request = "insert into ".$this->table."(".$listFields.") values(".$stringFields.");";
      $insert = $this->pdo->prepare($request);
      $insert->execute($data);

    }

    //method update in database
    public function update($tab, $where) {
      $fields = array();
      $data = array();
      $clause = array();

      foreach ($tab as $key => $value) {

        $fields[] = $key ."=:".$key;
        $data[":".$key] = $value;
      }
      $stringFields = implode(" , ", $fields);
  
      foreach ($where as $key => $value) {
        $clause[] = $key."= :".$key;
        $data[":".$key] = $value;
      }
      $stringClause = implode(" and ", $clause);

      $request = "update ". $this->table ." set ".$stringFields." where ".$stringClause.";";
      $update = $this->pdo->prepare($request);
      $update->execute($data);
    }

    //method delete in database
    public function delete($where) {
      $fields = array();
      $data = array();
      foreach ($where as $key => $value) {
        $clause[] = $key."= :".$key;
        $data[":".$key] = $value;
      }
      $stringClause = implode("  and  ", $clause);

      $request = "delete from ". $this->table ." where ".$stringClause.";";
      $delete = $this->pdo->prepare($request);
      $delete ->execute($data);
    }

    //method disconnect of the session
    public function disconnectSession() {
      $_SESSION = array();
      session_destroy();
      unset($_SESSION);
    }

    //méthod for upload a Pictures
    public function uploadPictures($index, $destination)
    {
      //checked user is select good
      $tmp_file = $_FILES[$index]['tmp_name'];

      if(!is_uploaded_file($tmp_file) )
      {
          exit("file not found");
      }

      //checked extension
      $type_file = $_FILES[$index]['type'];

      if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png') && !strstr($type_file, 'gif') )
      {
          exit("the file is not a pictures");
      }

      //copy file in destination folder
      $name_file = $_FILES[$index]['name'];
      if(!move_uploaded_file($tmp_file, $destination . $name_file) )
      {
          exit("impossible copy the file to $destination");
      }
    }
  }
?>
