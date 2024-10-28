<?php

namespace Biologed\Revive\Entities;

/**
 * The User class extends the base Entity class and contains information about the user.
 */
class User extends Entity
{
    /**
     * This fields provides the ID of the user
     */
    private int $userId;
    /**
     * This option provides the name of the contact for the user.
     */
    private string $contactName;
    /**
     * This field provides the email address of the user.
     */
    private string $emailAddress;
    /**
     * This option provides the username of the user.
     */
    private string $username;
    /**
     * This field provides the password of the user.
     */
    private string $password;
    /**
     * This field provides the default account ID of the user.
     */
    private int $defaultAccountId;
    /**
     * This field provides the status of the user.
     */
    private int $active;
    /**
     * This method returns an array of fields with their corresponding types.
     */
    public function getFieldsTypes(): array
    {
        return [
            'userId' => 'integer',
            'contactName' => 'string',
            'emailAddress' => 'string',
            'username' => 'string',
            'password' => 'string',
            'defaultAccountId' => 'integer',
            'active' => 'integer',
        ];
    }
}
