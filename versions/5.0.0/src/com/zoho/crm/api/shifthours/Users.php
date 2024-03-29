<?php 
namespace com\zoho\crm\api\shifthours;

use com\zoho\crm\api\util\Model;

class Users implements Model
{

	private  $id;
	private  $name;
	private  $effectiveFrom;
	private  $role;
	private  $email;
	private  $zuid;
	private  $keyModified=array();

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
	 * The method to get the name
	 * @return string A string representing the name
	 */
	public  function getName()
	{
		return $this->name; 

	}

	/**
	 * The method to set the value to name
	 * @param string $name A string
	 */
	public  function setName(string $name)
	{
		$this->name=$name; 
		$this->keyModified['name'] = 1; 

	}

	/**
	 * The method to get the effectiveFrom
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getEffectiveFrom()
	{
		return $this->effectiveFrom; 

	}

	/**
	 * The method to set the value to effectiveFrom
	 * @param \DateTime $effectiveFrom An instance of \DateTime
	 */
	public  function setEffectiveFrom(\DateTime $effectiveFrom)
	{
		$this->effectiveFrom=$effectiveFrom; 
		$this->keyModified['effective_from'] = 1; 

	}

	/**
	 * The method to get the role
	 * @return Role An instance of Role
	 */
	public  function getRole()
	{
		return $this->role; 

	}

	/**
	 * The method to set the value to role
	 * @param Role $role An instance of Role
	 */
	public  function setRole(Role $role)
	{
		$this->role=$role; 
		$this->keyModified['role'] = 1; 

	}

	/**
	 * The method to get the email
	 * @return string A string representing the email
	 */
	public  function getEmail()
	{
		return $this->email; 

	}

	/**
	 * The method to set the value to email
	 * @param string $email A string
	 */
	public  function setEmail(string $email)
	{
		$this->email=$email; 
		$this->keyModified['email'] = 1; 

	}

	/**
	 * The method to get the zuid
	 * @return string A string representing the zuid
	 */
	public  function getZuid()
	{
		return $this->zuid; 

	}

	/**
	 * The method to set the value to zuid
	 * @param string $zuid A string
	 */
	public  function setZuid(string $zuid)
	{
		$this->zuid=$zuid; 
		$this->keyModified['zuid'] = 1; 

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
