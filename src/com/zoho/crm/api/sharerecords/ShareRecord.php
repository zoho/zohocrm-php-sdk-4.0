<?php 
namespace com\zoho\crm\api\sharerecords;

use com\zoho\crm\api\users\User;
use com\zoho\crm\api\util\Choice;
use com\zoho\crm\api\util\Model;

class ShareRecord implements Model
{

	private  $sharedWith;
	private  $shareRelatedRecords;
	private  $sharedThrough;
	private  $permission;
	private  $type;
	private  $sharedBy;
	private  $sharedTime;
	private  $user;
	private  $keyModified=array();

	/**
	 * The method to get the sharedWith
	 * @return User An instance of User
	 */
	public  function getSharedWith()
	{
		return $this->sharedWith; 

	}

	/**
	 * The method to set the value to sharedWith
	 * @param User $sharedWith An instance of User
	 */
	public  function setSharedWith(User $sharedWith)
	{
		$this->sharedWith=$sharedWith; 
		$this->keyModified['shared_with'] = 1; 

	}

	/**
	 * The method to get the shareRelatedRecords
	 * @return bool A bool representing the shareRelatedRecords
	 */
	public  function getShareRelatedRecords()
	{
		return $this->shareRelatedRecords; 

	}

	/**
	 * The method to set the value to shareRelatedRecords
	 * @param bool $shareRelatedRecords A bool
	 */
	public  function setShareRelatedRecords(bool $shareRelatedRecords)
	{
		$this->shareRelatedRecords=$shareRelatedRecords; 
		$this->keyModified['share_related_records'] = 1; 

	}

	/**
	 * The method to get the sharedThrough
	 * @return SharedThrough An instance of SharedThrough
	 */
	public  function getSharedThrough()
	{
		return $this->sharedThrough; 

	}

	/**
	 * The method to set the value to sharedThrough
	 * @param SharedThrough $sharedThrough An instance of SharedThrough
	 */
	public  function setSharedThrough(SharedThrough $sharedThrough)
	{
		$this->sharedThrough=$sharedThrough; 
		$this->keyModified['shared_through'] = 1; 

	}

	/**
	 * The method to get the permission
	 * @return Choice An instance of Choice
	 */
	public  function getPermission()
	{
		return $this->permission; 

	}

	/**
	 * The method to set the value to permission
	 * @param Choice $permission An instance of Choice
	 */
	public  function setPermission(Choice $permission)
	{
		$this->permission=$permission; 
		$this->keyModified['permission'] = 1; 

	}

	/**
	 * The method to get the type
	 * @return Choice An instance of Choice
	 */
	public  function getType()
	{
		return $this->type; 

	}

	/**
	 * The method to set the value to type
	 * @param Choice $type An instance of Choice
	 */
	public  function setType(Choice $type)
	{
		$this->type=$type; 
		$this->keyModified['type'] = 1; 

	}

	/**
	 * The method to get the sharedBy
	 * @return User An instance of User
	 */
	public  function getSharedBy()
	{
		return $this->sharedBy; 

	}

	/**
	 * The method to set the value to sharedBy
	 * @param User $sharedBy An instance of User
	 */
	public  function setSharedBy(User $sharedBy)
	{
		$this->sharedBy=$sharedBy; 
		$this->keyModified['shared_by'] = 1; 

	}

	/**
	 * The method to get the sharedTime
	 * @return \DateTime An instance of \DateTime
	 */
	public  function getSharedTime()
	{
		return $this->sharedTime; 

	}

	/**
	 * The method to set the value to sharedTime
	 * @param \DateTime $sharedTime An instance of \DateTime
	 */
	public  function setSharedTime(\DateTime $sharedTime)
	{
		$this->sharedTime=$sharedTime; 
		$this->keyModified['shared_time'] = 1; 

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
