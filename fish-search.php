<?php

     if(isset($_POST['searchQuery']))
     {
     	  require_once('config.inc.php');
	      $search_query=$_POST['searchQuery'];
          $sql = 'SELECT * from escola where MATCH(nm_escola,endereco,tell) AGAINST(:search_query)';
          $statement = $connection->prepare($sql);
	      $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
          $statement->execute();
          if($statement->rowCount())
          {
            $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
            header('Content-type: application/json');
            echo json_encode($row_all);
          }  
          elseif(!$statement->rowCount())
          {
	        echo "no rows";
          }
     }
		  
?>