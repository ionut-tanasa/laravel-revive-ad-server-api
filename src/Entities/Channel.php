<?php

namespace Biologed\Revive\Entities;

/**
 *  The Channel class extends the base Entity class and contains information about the channel.
 */
class Channel extends Entity
{
    /**
     * The channelID variable is the unique ID for the channel.
     */
    private int $channelId;
    /**
     * This field contains the ID of the agency account.
     */
    private int $agencyId;
    /**
     * This field contains the ID of the publisher.
     */
    private int $websiteId;
    /**
     * The channelName variable is the name of the channel.
     */
    private string $channelName;
    /**
     * The description variable is the description for the channel.
     */
    private string $description;
    /**
     * The comments variable is the comment for the channel.
     */
    private string $comments;
    /**
     * This method returns an array of fields with their corresponding types.
     */
    public function getFieldsTypes(): array
    {
        return [
            'channelId' => 'integer',
            'agencyId' => 'integer',
            'websiteId' => 'integer',
            'channelName' => 'string',
            'description' => 'string',
            'comments' => 'string',
        ];
    }
}
