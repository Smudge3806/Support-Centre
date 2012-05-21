<?php
	class Map
	{
		function __construct($input = false)
		{
			require_once('node.php');
			global $currentNode;
			global $activeNode;
			global $nodes = array();
			include('dbconnection.php');
			public $input_src = $input;
			public $input_type;
			public $input_filter;
			
			drawMap();
			
			if($input)
			{
				filterInput();
				if($input_type == "GOOD")
				{
					getActiveNode(getKey(strtolower($input_filter)));
				}
			}
		}
		/**
		** Creates the Map.
		*/
		private function drawMap()
		{
			$result = $mysqli->query('SELECT * FROM map_nodes');
			if($result->num_rows != 0)
			{
				while($row = $result->fetch_object())
				{
					$node = drawNode($row->node_id)
					addToMap($node);
				}
			}
		}
		/**
		Creates a instance of a Node
		
		@param id
		@returns a node object
		*/
		private function drawNode($id)
		{
			$node = new Node("\I", $id);
			return $node;
		}
		
		/**
		Gets the current node's URL.
		
		@returns String (http://www.barnsley-ltu.co.uk/([A-Za-z0-9]"/"+)
		*/
		public function getCurrentLocation()
		{
			return $currentNode->getLocation();
		}
		
		/**
		Gets a node from the map.
		If there is no input then gets the currentNode
		@param String key [Default = false] - The Key of the Node
		@returns Node Object (returns null if no node found) 		
		*/		
		public function getNode($input = false)
		{
			if(!$input)
			{
				$node = $currentNode;
			}
			else
			{
				try
				{
					$node = $nodes[$input];
				}
				catch($err1)
				{
					$node = NULL;
				}
			}
			return $node;
		}
		
		/**
		Filters the Map Input to determine the state of the request
		*/
		public function filterInput()
		{
			if(strpos($input_src, "http://")
			{
				$input = explode("http://www.barnsley-ltu.co.uk/", $input_src);
				if(strpos($input, "/"))
				{
					$input_type = "BAD - Embedded Link";
					input = explode('/');
					$input_filter = $input[1];
				}
				else
				{
					$input_type = "GOOD";
					$input_filter = $input;
				}
			}
			else
			{
				//assume its a normal link
				$input_type = "GOOD";
				$input_filter = $input;
			}
		}
		
		/**
		Gets the active Node that the map is looking at
		@param String key
		*/
		public function getActiveNode($key)
		{
			$x = 0;
			try
			{
				$node = $this->nodes[$key];
			}
			catch($e)
			{
				// try a more "traditional" method
				$y = count($this->nodes);
				while($x != $y)
				{
					$node = $this->nodes[$x];
					if($node->getKey() == $key)
					{
						$x = $y;
					}
					else
					{
						$x++;
					}
				}
			}
			if(isset($node))
			{
				setActiveNode($node);
			}
		}
		
		public function setActiveNode($node)
		{
			$this->activeNode = $node;
		}
		
		public function addToMap($node)
		{
			$this->nodes[$node->getKey()] = $node;
		}
		
		public function createNode()
		{
			if(isset($input_type, $input_src, $input_filter))
			{
				$node = new Node("\C", NULL, $input_src, $input_filter);
				addToMap($node);
			}
			else
			{
				exit("Can Not Create Node!");
			}
			return $node;
		}
		
		public function getKey($value)
		{
			$result = $mysqli->query('SELECT * FROM map_nodes WHERE value = '.$value);
			if($result->num_rows == 1)
			{
				$raw = $result->fetch_object();
				$key = $raw->node_key;
			}
			elseif($result->num_rows == 0)
			{
				$node = createNode();
				$key = $node->getKey();
			}
			elseif($result->num_rows >= 2)
			{
				$key = "null";
			}
			
			return $key;
		}
	}
?>