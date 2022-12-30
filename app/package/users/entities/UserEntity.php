<?php

namespace CMW\Entity\Users;

use CMW\Controller\Core\CoreController;

class UserEntity
{

    private int $userId;
    private string $userMail;
    private string $userUsername;
    private string $userFirstName;
    private string $userLastName;
    private int $userState;
    private string $userKey;
    private string $userLastConnection;
    /** @var \CMW\Entity\Users\RoleEntity|\CMW\Entity\Users\RoleEntity[] $userRoles */
    private array $userRoles;
    private ?RoleEntity $userHighestRole;
    private string $userCreated;
    private string $userUpdated;
    private ?UserPictureEntity $userPicture;


    /**
     * @param int $userId
     * @param string $userMail
     * @param string $userUsername
     * @param string $userFirstName
     * @param string $userLastName
     * @param int $userState
     * @param string $userKey
     * @param string $userLastConnection
     * @param \CMW\Entity\Users\RoleEntity[] $userRoles
     * @param ?\CMW\Entity\Users\RoleEntity $userHighestRole
     * @param string $userCreated
     * @param string $userUpdated
     * @param \CMW\Entity\Users\UserPictureEntity|null $userPicture
     */
    public function __construct(int $userId, string $userMail, string $userUsername, string $userFirstName, string $userLastName, int $userState, string $userKey, string $userLastConnection, array $userRoles, ?RoleEntity $userHighestRole, string $userCreated, string $userUpdated, ?UserPictureEntity $userPicture)
    {
        $this->userId = $userId;
        $this->userMail = $userMail;
        $this->userUsername = $userUsername;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->userState = $userState;
        $this->userKey = $userKey;
        $this->userLastConnection = $userLastConnection;
        $this->userRoles = $userRoles;
        $this->userHighestRole = $userHighestRole;
        $this->userCreated = $userCreated;
        $this->userUpdated = $userUpdated;
        $this->userPicture = $userPicture;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->userMail;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->userUsername;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->userFirstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->userLastName;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->userState;
    }

    /**
     * @return string
     */
    public function getUserKey(): string
    {
        return $this->userKey;
    }

    /**
     * @return string
     * @Desc date
     */
    public function getLastConnection(): string
    {
        return CoreController::formatDate($this->userLastConnection);
    }

    /**
     * @return \CMW\Entity\Users\RoleEntity[]
     */
    public function getRoles(): array
    {
        return $this->userRoles;
    }

    /**
     * @return ?\CMW\Entity\Users\RoleEntity
     */
    public function getHighestRole(): ?RoleEntity
    {
        return $this->userHighestRole;
    }

    /**
     * @return string
     * @desc date
     */
    public function getCreated(): string
    {
        return CoreController::formatDate($this->userCreated);
    }

    /**
     * @return string
     * @desc date
     */
    public function getUpdated(): string
    {
        return CoreController::formatDate($this->userUpdated);
    }

    /**
     * @return \CMW\Entity\Users\UserPictureEntity | null
     */
    public function getUserPicture(): ?UserPictureEntity
    {
        return $this->userPicture;
    }

}