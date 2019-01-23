<?php

namespace comero278\ObjectOrientedProject;

/**
 * Author profile
 *
 * This class shows data collected and stored for an author profile, including email, username, avatar, etc.
 *
 * @author Cassandra Romero cromero278@cnm.edu
 **/
class Author {
/**
 * Id for this author, this is the primary key
 **/
	private $authorID;
/**
 * URL for the author's avatar
 */
	private $authorAvatarURL;
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

/*
 * accessor method for profile id
 *
 * @return binary value of profile id
 */
	public function getAuthorId() {
		return($this->authorID);
	}
/*
 * accessor method for author avatar url
 *
 * @return var char URL for author avatar
 */
	public function getAuthorAvatarUrl() {
		return ($this->authorAvatarURL);
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
 * accessor method for author email address
 *
 * @returns unique var char email address
 */
	public function getAuthorEmail(){
		return($this->authorEmail);
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
 * accessor method for author username
 *
 * @returns unique var char for author username
 */
	public function getAuthorUsername(){
		return($this->authorUsername);
	}
}
