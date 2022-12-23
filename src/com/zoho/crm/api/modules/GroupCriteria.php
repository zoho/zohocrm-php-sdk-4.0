<?php 
namespace com\zoho\crm\api\modules;

use com\zoho\crm\api\util\Model;

class GroupCriteria implements Model, Criteria
{

	private  $groupOperator;
	private  $group;
	private  $keyModified=array();

	/**
	 * The method to get the groupOperator
	 * @return string A string representing the groupOperator
	 */
	public  function getGroupOperator()
	{
		return $this->groupOperator; 

	}

	/**
	 * The method to set the value to groupOperator
	 * @param string $groupOperator A string
	 */
	public  function setGroupOperator(string $groupOperator)
	{
		$this->groupOperator=$groupOperator; 
		$this->keyModified['group_operator'] = 1; 

	}

	/**
	 * The method to get the group
	 * @return array A array representing the group
	 */
	public  function getGroup()
	{
		return $this->group; 

	}

	/**
	 * The method to set the value to group
	 * @param array $group A array
	 */
	public  function setGroup(array $group)
	{
		$this->group=$group; 
		$this->keyModified['group'] = 1; 

	}

	/**
	 * The method to check if the user has modified the given key
	 * @param string $key A string
	 * @return int A int representing the modification
	 */
	public  function isKeyModified(string $key)
	{
		if(((array_key_exists($key, $this->keyModified))))
		{
			return $this->keyModified[$key]; 

		}
		return null; 

	}

	/**
	 * The method to mark the given key as modified
	 * @param string $key A string
	 * @param int $modification A int
	 */
	public  function setKeyModified(string $key, int $modification)
	{
		$this->keyModified[$key] = $modification; 

	}
} 
