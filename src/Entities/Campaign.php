<?php

namespace Biologed\Revive\Entities;

/**
 *  The Campaign class extends the base Entity class and contains information about the campaign.
 */
class Campaign extends Entity
{
    /**
     * The campaignId variable is the unique ID for the campaign.
     */
    private int $campaignId;
    /**
     * The advertiserID variable is the ID of the advertiser associated with the campaign.
     */
    private int $advertiserId;
    /**
     * The campaignName variable is the name of the campaign.
     */
    private string $campaignName;
    /**
     * The startDate variable is the date the campaign will start.
     */
    private string $startDate;
    /**
     * The endDate variable is the date the campaign will end.
     */
    private string $endDate;
    /**
     * The impressions variable is the number of impressions booked for the campaign.
     */
    private int $impressions;
    /**
     * The clicks variable is the number of clicks booked for the campaign.
     */
    private int $clicks;
    /**
     * The priority variable is the priority level set for the campaign.
     */
    private int $priority;
    /**
     * The weight variable is the weight set for the campaign.
     */
    private int $weight;
    private int $targetImpressions;
    private int $targetClicks;
    private int $targetConversions;
    /**
     * Revenue amount, eg 1.55.
     */
    public float $revenue;
    /**
     * Revenue type (CPM, CPA, etc) as defined in constants.php.
     * Eg, define('MAX_FINANCE_CPM', 1);
     */
    private int $revenueType;
    /**
     * Frequency capping: total views per user.
     */
    private int $capping;
    /**
     * Frequency capping: total views per period.
     * (defined in seconds by "block").
     */
    private int $sessionCapping;
    /**
     * Frequency capping: reset period, in seconds.
     */
    private int $block;
    /**
     * This field provides any additional comments to be stored.
     */
    private string $comments;
    /**
     * Customized install for banner Limit, this will not harm non-customized installs
     */
    private string $bannerLimit;
    /**
     * This function sets all default values when adding new campaign.
     */
    public function setDefaultForAdd(): void
    {
        if (is_null($this->impressions)) {
            $this->impressions = -1;
        }
        if (is_null($this->clicks)) {
            $this->clicks = -1;
        }
        if (is_null($this->priority)) {
            $this->priority = 0;
        }
        if (is_null($this->weight)) {
            $this->weight = 1;
        }
        if (is_null($this->targetImpressions)) {
            $this->targetImpressions = 0;
        }
        if (is_null($this->targetClicks)) {
            $this->targetClicks = 0;
        }
        if (is_null($this->targetConversions)) {
            $this->targetConversions = 0;
        }
        if (is_null($this->bannerLimit)) {
            $this->bannerLimit = 0;
        }
        /*
        if (is_null($this->revenue)) {
            // Leave null
        }
        if (is_null($this->revenueType)) {
            // Leave null
        }
        if (is_null($this->capping)) {
            // Leave null
        }
        if (is_null($this->sessionCapping)) {
            // Leave null
        }
        if (is_null($this->block)) {
            // Leave null
        }
        */
    }
    /**
     * This method returns an array of fields with their corresponding types.
     */
    public function getFieldsTypes(): array
    {
        return [
            'campaignId' => 'integer',
            'advertiserId' => 'integer',
            'campaignName' => 'string',
            'startDate' => 'date',
            'endDate' => 'date',
            'impressions' => 'integer',
            'clicks' => 'integer',
            'priority' => 'integer',
            'weight' => 'integer',
            'targetImpressions' => 'integer',
            'targetClicks' => 'integer',
            'targetConversions' => 'integer',
            'revenue' => 'double',
            'revenueType' => 'integer',
            'capping' => 'integer',
            'sessionCapping' => 'integer',
            'block' => 'integer',
            'comments' => 'string',
        ];
    }
}
