<?php 
namespace com\zoho\crm\api\usersunavailability;

use com\zoho\crm\api\util\Model;

class UsersUnavailability implements Model
{

	private  $comments;
	private  $from;
	private  $to;
	private  $user;
	private  $id;
	private  $keyModified=array();

	/**
	 * The method to get the comments
	 * @return string A string representing the comments
	 */
	public  function getComments()
	{
		return $this->comments; 

	}

	/**
	 * The method to set the value to comments
	 * @param string $comments A string
	 */
	public  function setComments(string $comments)
	{
		$this->comments=$comments; 
		$this->keyModified['comments'] = 1; 

	}

	/**
	 * The method to get the from
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getFrom()
	{
		return $this->from; 

	}

	/**
	 * The method to set the value to from
	 * @param \DateTime $from An instance of \DateTime
	 */
	public  function setFrom(\DateTime $from)
	{
		$this->from=$from; 
		$this->keyModified['from'] = 1; 

	}

	/**
	 * The method to get the to
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getTo()
	{
		return $this->to; 

	}

	/**
	 * The method to set the value to to
	 * @param \DateTime $to An instance of \DateTime
	 */
	public  function setTo(\DateTime $to)
	{
		$this->to=$to; 
		$this->keyModified['to'] = 1; 

	}

	/**
	 * The method to get the user
	 * @return User An instance of User
	 */
	public  function getUser()
	{
		return $this->user; 

	}

	/**
	 * The method to set the value to user
	 * @param User $user An instance of User
	 */
	public  function setUser(User $user)
	{
		$this->user=$user; 
		$this->keyModified['user'] = 1; 

	}

	/**
	 * The method to get the id
	 * @return string A string representing the id
	 */
	public  function getId()
	{
		return $this->id; 

	}

	/**
	 * The method to set the value to id
	 * @param string $id A string
	 */
	public  function setId(string $id)
	{
		$this->id=$id; 
		$this->keyModified['id'] = 1; 

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
