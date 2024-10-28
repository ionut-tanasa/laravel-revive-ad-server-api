<?php

namespace Biologed\Revive\Entities;

/**
 *  The Advertiser class extends the base Entity class and contains information about advertisers.
 */
class Advertiser extends Entity
{
    /**
     * The advertiserID variable is the unique ID for the advertiser.
     * @see https://documentation.revive-adserver.com/display/DOCS/Advertisers
     */
    private int $advertiserId;
    /**
     * This field contains the ID of the agency account.
     */
    private int $accountId;
    /**
     * The agencyID variable is the ID of the agency to which the advertiser is associated.
     */
    private int $agencyId;
    /**
     * The advertiserName variable is the name of the advertiser.
     */
    private string $advertiserName;
    /**
     * The contactName variable is the name of the contact.
     */
    private string $contactName;

    /**
     * The emailAddress variable is the email address for the contact.
     */
    private string $emailAddress;
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
            'advertiserId' => 'integer',
            'accountId' => 'integer',
            'agencyId' => 'integer',
            'advertiserName' => 'string',
            'contactName' => 'string',
            'emailAddress' => 'string',
            'comments' => 'string',
        ];
    }
}
