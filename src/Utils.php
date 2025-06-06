<?php

namespace Biologed\Revive;

use Error;
use DateTime;
use Carbon\Carbon;
use PhpXmlRpc\Value;
use Carbon\CarbonImmutable;
use Biologed\Revive\Entities\Entity;

/**
 * The Utils class contains various XmlRpc methods.
 */
class Utils
{
    /**
     * This method converts the entity object into a Value and deletes null fields.
     */
    public static function getEntityWithNotNullFields(Entity|DateTime $entity): Value
    {
        $result = [];
        if ($entity instanceof DateTime) {
            $value = $entity->format('Ymd\TH:i:s');
            return new Value($value, 'dateTime.iso8601');
        }
        $data = $entity->toArray();
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                $result[$key] = self::getRPCTypeForField($entity->getFieldType($key), $value);
            }
        }
        return new Value($result, 'struct');
    }
    /**
     * This method sets the RPC type for variables.
     *
     * @param string $type
     * @param mixed $variable
     * @return Value or false
     */
    public static function getRPCTypeForField(string $type, mixed $variable): Value
    {
        switch ($type) {
            case 'integer':
                $type = 'int';
                return new Value($variable, $type);
            case 'string':
            case 'float':
            case 'double':
            case 'boolean':
                return new Value($variable, $type);
            case 'custom':
                return $variable;
        }
        throw new Error('Unsupported XML RPC type "' . $type . '"');
    }
    public static function compareDate(DateTime|Carbon|string $date): CarbonImmutable
    {
        if ($date instanceof Carbon) {
            return $date->toImmutable();
        }
        if ($date instanceof DateTime) {
            return CarbonImmutable::parse($date->format('d-m-Y'), $date->getTimezone());
        }
        if (is_string($date)) {
            return CarbonImmutable::parse($date);
        }
        return CarbonImmutable::today();
    }
    /**
     * key is the value needed for passing in request
     */
    public static array $logical = [
        'and' => 'AND',
        'or' => 'OR',
    ];
    /**
     * @var array for comparison option list
     */
    public static array $comparison = [
        '==' => 'is equal to',
        '!=' => 'is different from',
        '=~' => 'Contains',
        '!~' => 'Does not contain',
        '=x' => 'Regex match',
        '!x' => 'Regex does not match',
    ];
    /**
     * @var array for delivery type option list
     */
    public static array $type = [
        'deliveryLimitations:Client:Browser' => 'Client - Browser (Legacy)',
        'deliveryLimitations:Client:BrowserVersion' => 'Client - Browser Version',
        'deliveryLimitations:Client:Domain' => 'Client - Domain',
        'deliveryLimitations:Client:Ip' => 'Client - IP address',
        'deliveryLimitations:Client:Language' => 'Client - Language',
        'deliveryLimitations:Client:Os' => 'Client - Operating system (Legacy)',
        'deliveryLimitations:Client:OsVersion' => 'Client - Operating System Version',
        'deliveryLimitations:Client:Useragent' => 'Client - Useragent',
        'deliveryLimitations:Geo:Continent' => 'Geo - Continent',
        'deliveryLimitations:Geo:Country' => 'Geo - Country',
        'deliveryLimitations:Site:Hostnamelist' => 'Site - Hostname List',
        'deliveryLimitations:Site:Pageurl' => 'Site - Page URL',
        'deliveryLimitations:Site:Referingpage' => 'Site - Referring Page',
        'deliveryLimitations:Site:Registerabledomainlist' => 'Site - Registerable Domain List',
        'deliveryLimitations:Site:Source' => 'Site - Source',
        'deliveryLimitations:Site:Variable' => 'Site - Variable',
    ];
    public static array $continent = [
        'AF' => 'Africa',
        'AQ' => 'Antartica',
        'AS' => 'Asia',
        'CA' => 'Caribbean',
        'EU' => 'Europe',
        'NA' => 'North America',
        'OC' => 'Australia/Oceania',
        'SA' => 'South America',
        'AN' => 'AQ',
    ];
    public static array $country = [
        'AF' => 'Afghanistan',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia, Plurinational State of',
        'BQ' => 'Bonaire, Sint Eustatius and Saba',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'CV' => 'Cabo Verde',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, the Democratic Republic of the',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CW' => 'Curaçao',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'CI' => 'Côte d\'Ivoire',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KP' => 'Korea, Democratic People\'s Republic of',
        'KR' => 'Korea, Republic of',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia, the former Yugoslav Republic of',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States of',
        'MD' => 'Moldova, Republic of',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestine, State of',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'RE' => 'Réunion',
        'BL' => 'Saint Barthélemy',
        'SH' => 'Saint Helena, Ascension and Tristan da Cunha',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin (French part)',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SX' => 'Sint Maarten (Dutch part)',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'SS' => 'South Sudan',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan, Province of China',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania, United Republic of',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela, Bolivarian Republic of',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
        'AX' => 'Åland Islands',
        'A1' => 'Anonymous Proxy',
        'A2' => 'Satellite Provider',
        'O1' => 'Other',
    ];
    /**
     * get country key
     * returns the empty value if no match
     */
    public static function getCountry(string $data = ''): string|int
    {
        if (!empty(self::$country[$data])) {
            return $data;
        }
        if ($key = array_search($data, self::$country, true)) {
            return $key;
        }
        return '';
    }
    /**
     * get continent key
     * returns the empty value if no match
     */
    public static function getContinent(string $data = ''): string|int
    {
        if (! empty(self::$continent[$data])) {
            return $data;
        }
        if ($key = array_search($data, self::$continent, true)) {
            return $key;
        }
        return '';
    }
    /**
     * get comparison key
     * returns the default value if no match
     *
     * @param string $data
     * @return mixed|string|int
     */
    public static function getComparisonKey(string $data = ''): mixed
    {
        if (! empty(self::$comparison[$data])) {
            return $data;
        }
        if ($key = array_search($data, self::$comparison, true)) {
            return $key;
        }
        return current(self::$comparison);
    }
    /**
     * get logical key
     * returns the default value if no match
     */
    public static function getLogicalKey(string $data = ''): mixed
    {
        if (!empty(self::$logical[$data])) {
            return $data;
        }
        if ($key = array_search($data, self::$comparison, true)) {
            return $key;
        }
        return current(self::$logical);
    }
    /**
     * get site type key
     */
    public static function getDeliveryType(string $type, string $data): bool|string
    {
        if (!empty(self::$type['deliveryLimitations:' . $type . ':' . $data])) {
            return 'deliveryLimitations:' . $type . ':' . $data;
        }
        return false;
    }
    /**
     * get site type key
     */
    public static function getSiteType($data): bool|string
    {
        if (!empty(self::$type['deliveryLimitations:Site:' . $data])) {
            return 'deliveryLimitations:Site:' . $data;
        }
        return false;
    }
    /**
     * get client type key
     */
    public static function getClientType($data): bool|string
    {
        if (!empty(self::$type['deliveryLimitations:Client:' . $data])) {
            return 'deliveryLimitations:Client:' . $data;
        }
        return false;
    }
    /**
     * get geo type key
     */
    public static function getGeoType($data): bool|string
    {
        if (! empty(self::$type['deliveryLimitations:Geo:' . $data])) {
            return 'deliveryLimitations:Geo:' . $data;
        }
        return false;
    }
}
