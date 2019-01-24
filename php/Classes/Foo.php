<?php

namespace comero278\oop;

use cromero278\oop\ValidateUuid;
use cromero278\oop\ValidateDate;

/**
 * Author profile
 *
 * This class shows data collected and stored for an author profile, including email, username, avatar, etc.
 *
 * @author Cassandra Romero cromero278@cnm.edu
 **/
class Author {
	use ValidateDate;
	use ValidateUuid;
/**
 * Id for this author, this is the primary key
 **/
	private $authorId;
/**
 * URL for the author's avatar
 */
	private $authorAvatarUrl;
/**
 * One-time activation token used for author account creation
 */
	private $authorActivationToken;
/*
 * Author email address, this email must be unique
 */
	private $authorEmail;
/*
 * Author's encrypted password
 */
	private $authorHash;
/*
 * Author's unique username
 */
private $authorUsername;

	/**
	 * constructor for author
	 *
	 * @param string|`Uuid $newAuthorId id of this author
	 * @param string $newAuthorAvatarUrl string containing url of author avatar
	 * @param string $newAuthorActivationToken string containing activation token for account creation
	 * @param string $newAuthorEmail unique string containing unique author email address
	 * @param string $newAuthorHash string containing hashed author password
	 * @param string $newAuthorUsername string containing unique author username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	**/

	public function __construct($newAuthorId, $newAuthorAvatarUrl, $newAuthorActivationToken, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl ($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

/*
 * accessor method for profile id
 *
 * @return binary value of profile id
 */
	public function getAuthorId() {
		return($this->authorId);
	}
	/*
 * mutator method for author id
 *
 * @param Uuid | string $newAuthorId value of new author id
 * @throws \RangeException if $newAuthorId is > 16
 * @throws \TypeError if $newAuthorId is not binary
 */
	private function setAuthorId($newAuthorId) : void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the author id
		$this->authorId = $uuid;
	}
/*
 * accessor method for author avatar url
 *
 * @return var char URL for author avatar
 */
	public function getAuthorAvatarUrl() {
		return ($this->authorAvatarUrl);
	}
/*
 * mutator method for author avatar url
 * @param string $newAuthorAvatarUrl
 * @throws\InvalidArgumentException if empty
 */
	private function setAuthorAvatarUrl (string $newAuthorAvatarUrl){
		if(empty($newAuthorAvatarUrl)===true) {
			throw (new \InvalidArgumentException("profile avatar URL is empty"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	/*
 * accessor method for author activation token
	 *
 * @returns characters in author activation token
 */
	public function getAuthorActivationToken(){
		return($this->authorActivationToken);
		}
/*
 * mutator method for author activation token
 * @param string $newAuthorActivationToken
 * @throws \RageException if activation token is not 32 characters
 */
		private function setAuthorActivationToken (string $newAuthorActivationToken){
			if(strlen($newAuthorActivationToken) !== 32) {
				throw(new\RangeException("user activation token has to be 32"));
			}
		$this->authorActivationToken = $newAuthorActivationToken;
		}
/*
 * accessor method for author email address
 *
 * @returns unique var char email address
 */
	public function getAuthorEmail(){
		return($this->authorEmail);
		}

		/*
		 * mutator method for author email
		 *
		 * @param string $newAuthorEmail
		 * @throws \RangeException if string length is greater than 128 characters
		 */
	private function setAuthorEmail (string $newAuthorEmail) {
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException(" email is too long"));
		}
		$this->authorEmail = $newAuthorEmail;
	}

		/*
		 * accessor method for author hash
		 *
		 * @returns characters for hashed user password
		 */
	public function getAuthorHash(){
		return($this->authorHash);
	}
/*
 * mutator method for author hash
 *
 * @param string $newAuthorHash
 * @throws \InvalidArgumentException if hash is empty
 * @throws \RangeException if hash is not 97 characters
 */
	private function setAuthorHash(string $newAuthorHash){

		if (empty($newAuthorHash)===true){
			throw(new \InvalidArgumentException("hash is empty"));
		}
		if (strlen($newAuthorHash) !== 97){
			throw(new \RangeException("hash must be 97 characters"));
		}
		$this->authorHash = $newAuthorHash;
	}
/*
 * accessor method for author username
 *
 * @returns unique var char for author username
 */
	public function getAuthorUsername(){
		return($this->authorUsername);
	}
/*
 * mutator method for author username
 *
 * @param string authorUsername is $newAuthorUsername
 * @throws \InvalidArgumentException if the username is empty
 */
	private function setAuthorUsername($newAuthorUsername){

		$newAuthorUsername = trim($newAuthorUsername);
		if(empty($newAuthorUsername)===true){
			throw(new \InvalidArgumentException("username is empty"));
		}
		$this->authorUsername = $newAuthorUsername;
	}
}