<?php

namespace Biologed\Revive\Entities;

/**
 *  The Publisher class extends the base Entity class and contains information about the publisher.
 */
class Publisher extends Entity
{
    /**
     * The publisherId variable is the unique ID for the publisher.
     */
    private int $publisherId;
    /**
     * This field contains the ID of the agency account.
     */
    private int $accountId;
    /**
     * The agencyID variable is the ID of the agency associated with the publisher.
     */
    private int $agencyId;
    /**
     * The publisherName variable is the name of the publisher.
     */
    private string $publisherName;
    /**
     * The contactName variable is the name of the contact for the publisher.
     */
    private string $contactName;
    /**
     * The emailAddress variable is the email address for the contact.
     */
    private string $emailAddress;
    /**
     * The website variable is the website address of the publisher.
     */
    private string $website;
    /**
     * This field provides any additional comments to be stored.
     */
    private string $comments;
    /**
     * This method returns an array of fields with their corresponding types.
     */
    public function getFieldsTypes(): array
    {
        return [
            'publisherId' => 'integer',
            'accountId' => 'integer',
            'agencyId' => 'integer',
            'publisherName' => 'string',
            'contactName' => 'string',
            'emailAddress' => 'string',
            'website' => 'string',
            'comments' => 'string',
        ];
    }
}
