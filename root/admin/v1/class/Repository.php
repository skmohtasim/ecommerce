<?php

class Repository
{	
	private $conn; //connection variable
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Opens a connection and assigns errors by reference if exists
	parameter 1: connection name to which server should connect
	parameter 2: error variable
	Return type: None
	*/
	public function OpenConnection($connectionName,&$strError)
	{
		if($connectionName!="")
		{
			try
			{
				$this->SetConnectionString($connectionName);
				
			}
			catch(Exception $e)
			{
				
				$strError=$e;
			}
		}
	}
	
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Closes a connection and assigns errors by reference if exists
	Return type: None
	*/
	public function CloseConnection()
	{
		$this->conn->close();
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Executes a query and assigns errors by reference if exists. 
	parameter 1: Sql query
	parameter 2: error variable
	Return type: None
	*/
	public function ExecuteQuery($strSQL,&$strError)
	{
		if ($this->conn->query($strSQL) === TRUE) 
		{
			
		} 
		else 
		{
			$strError=$this->conn->error;
		}
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Execute query and returns data and assigns errors by reference if exists
	parameter 1: Sql query
	parameter 2: error variable
	Return type: Array
	*/
	public function RetriveData($strSQL,&$strError)
	{
		$dataArray=array();
		
		try
		{
			if($result = $this->conn->query($strSQL))
			{
				if($result->num_rows>0)
				{
					$i=0;
					while($row = mysqli_fetch_array($result, MYSQLI_NUM))
					{
						$dataArray[$i]=$row;
						$i++;
					}
				}
				else
				{
					$dataArray[0][0]="Nothing";
				}
				$result->close();
				
			}
			else
			{
				
				$strError=$this->conn->error;
				
				
			}

			return $dataArray;
		}
		catch(Exception $e)
		{
			echo("error2");
			$strError=$e;
		}
		
		return $dataArray;
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Starts a transaction and assigns errors by reference if exists
	parameter 1: error variable
	Return type: None
	*/
	public function BeginTransaction(&$strError)
	{
		try
		{
			mysqli_autocommit($this->conn,FALSE);
		}
		catch(Exception $e)
		{
			$strError=$e;
		}
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Commits transaction and assigns errors by reference if exists
	parameter 1: error variable
	Return type: None
	*/
	public function CommitTransaction(&$strError)
	{
		try
		{
			mysqli_commit($this->conn);
		}
		catch(Exception $e)
		{
			$strError=$e;
		}
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Rolls back an already started transaction and assigns errors by reference if exists
	parameter 1: error variable
	Return type: None
	*/
	public function Rollback(&$strError)
	{
		try
		{
			mysqli_rollback($this->conn);
		}
		catch(Exception $e)
		{
			$strError=$e;
		}
	}
	
	/*
	Author: Polin
	Creation Date: 11/30/2015
	Set which server to connect errors by reference if exists
	parameter 1: Connection name variable
	Return type: None
	*/
	private function SetConnectionString($connectionName)
	{	
		switch ($connectionName) 
		{

			case "ecommerce":
				$servername=""; //serverip
				$username=""; //server username
				$password="";//server password
				$databaseName=""; //initial database
				
				break;
			default:
			
		}
		
		
		if($servername!="")
		{

			$this->conn = new mysqli($servername, $username, $password,$databaseName);
			
		}
	}
}
?>
