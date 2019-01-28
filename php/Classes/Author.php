<?php

namespace cromero278\oop;

require_once(dirname(__DIR__, 1) . "/Classes/autoload.php");
require_once("autoload.php");
require_once ("ValidateUuid.php");

use Ramsey\Uuid\Uuid;
/**
 * Author profile
 *
 * This class shows data collected and stored for an author profile, including email, username, avatar, etc.

 * @author Cassandra Romero cromero278@cnm.edu
 **/
class Author {
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
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
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
		return ($this->authorId);
	}

	/*
 * mutator method for author id
 *
 * @param Uuid | string $newAuthorId value of new author id
 * @throws \RangeException if $newAuthorId is > 16
 * @throws \TypeError if $newAuthorId is not binary
 */
	public function setAuthorId($newAuthorId) {
		try {
			//$uuid=$newAuthorId;
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
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) {
		if(empty($newAuthorAvatarUrl) === true) {
			throw (new \InvalidArgumentException("profile avatar URL is empty"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/*
 * accessor method for author activation token
	 *
 * @returns characters in author activation token
 */
	public function getAuthorActivationToken() {
		return ($this->authorActivationToken);
	}

	/*
	 * mutator method for author activation token
	 * @param string $newAuthorActivationToken
	 * @throws \RageException if activation token is not 32 characters
	 */
	public function setAuthorActivationToken(string $newAuthorActivationToken) {
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
	public function getAuthorEmail() {
		return ($this->authorEmail);
	}

	/*
	 * mutator method for author email
	 *
	 * @param string $newAuthorEmail
	 * @throws \RangeException if string length is greater than 128 characters
	 */
	public function setAuthorEmail(string $newAuthorEmail) {
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
	public function getAuthorHash() {
		return ($this->authorHash);
	}

	/*
	 * mutator method for author hash
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if hash is empty
	 * @throws \RangeException if hash is not 97 characters
	 */
	public function setAuthorHash(string $newAuthorHash) {

		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("hash is empty"));
		}
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("hash must be 97 characters"));
		}
		$this->authorHash = $newAuthorHash;
	}

	/*
	 * accessor method for author username
	 *
	 * @returns unique var char for author username
	 */
	public function getAuthorUsername() {
		return ($this->authorUsername);
	}

	/*
	 * mutator method for author username
	 *
	 * @param string authorUsername is $newAuthorUsername
	 * @throws \InvalidArgumentException if the username is empty
	 */
	public function setAuthorUsername($newAuthorUsername) {

		$newAuthorUsername = trim($newAuthorUsername);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("username is empty"));
		}
		$this->authorUsername = $newAuthorUsername;
	}

	/**
	 * inserts new author into MySQL
	 * @param \PDO $pdo
	 * @throws \PDOException for MySQL related errors
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo): void {

		$query = "INSERT INTO author (authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername)
VALUES ( :authorId, :authorAvatarUrl, :authorActivationToken, :authorEmail, :authorHash, :authorUsername)";

		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken,
			"authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * updates Author in MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update(\PDO $pdo): void {

		$query = "UPDATE author SET authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername";

		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorAvatarUrl" => $this->authorAvatarUrl, "authorActivationToken" => $this->authorActivationToken,
			"authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];

		$statement->execute($parameters);
	}

	/**
	 * deletes Author from MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {

		$query = "DELETE FROM author WHERE authorAvatarUrl = :authorAvatarUrl";

		$statement = $pdo->prepare($query);

		$parameters = ["authorAvatarUrl" => $this->authorAvatarUrl];
		$statement->execute($parameters);
	}
	/**
	 * gets author username by author id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return string stating author username
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?Author {
		try {
			$authorId = self:: validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);
		$parameters = ["authorId" => $authorId->getBytes()];

		$statement->execute($parameters);

		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($author);
	}

	/**
	 * gets all authors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Authors found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllAuthors(\PDO $pdo): \SplFixedArray {

		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		$author = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try{
			$author = new Author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			$authors[$authors->key()] = $author;
			$authors->next();
		}
	catch
		(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		}
			return($author);
}}