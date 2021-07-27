<?php


namespace App\Model;

use Core\AbstractModel;
use Core\Db;

class User extends AbstractModel
{
    const GENDER_FEMALE = 2;
    const GENDER_MALE = 1;

    private $id;
    private $name;
    private $password;
    private $createdAt;
    private $gender;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO users (`name`, `password`, `gender`) VALUES (
            :name, 
            :password, 
            :gender
        )";
        $db->exec($insert, __METHOD__, [
            ":name" => $this->name,
            ":password" => $this->password,
            ":gender" => $this->gender
        ]);

        return $db->lastInsertId();
    }

}