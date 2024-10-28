<?php

namespace Biologed\Revive\Entities;

/**
 *  The Agency class extends the base Entity class and contains information about the agency.
 */
class Agency extends Entity
{
    /**
     * The agencyID variable is the unique ID for the agency.
     */
    private int $agencyId;
    /**
     * This field contains the ID of the agency account.
     */
    private int $accountId;
    /**
     * The agencyName variable is the name of the agency.
     */
    private string $agencyName;
    /**
     * The password variable is the password for the agency.
     */
    private string $password;
    /**
     * The contactName variable is the name of the contact for the agency.
     */
    private string $contactName;
    /**
     * The emailAddress variable is the email address for the agency contact.
     */
    private string $emailAddress;
    /**
     * This method returns an array of fields with their corresponding types.
     */
    public function getFieldsTypes(): array
    {
        return [
            'agencyId' => 'integer',
            'accountId' => 'integer',
            'agencyName' => 'string',
            'contactName' => 'string',
            'password' => 'string',
            'emailAddress' => 'string',
        ];
    }
}
