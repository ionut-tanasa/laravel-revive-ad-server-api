<?php

namespace Biologed\Revive\Entities;

use Carbon\CarbonImmutable;

/**
 * @package OpenXDll
 * The Entity class is the base class for all entities classes.
 */
abstract class Entity
{
    /**
     * get field type definition
     * @see Utils::getRPCTypeForField
     */
    abstract public function getFieldsTypes(): array;
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->readDataFromArray($data);
        }
    }
    /**
     * create/build $this from array data
     * @see Entity::getFieldType;
     */
    public function readDataFromArray(array $data): void
    {
        $fieldsTypes = $this->getFieldsTypes();
        foreach ($fieldsTypes as $fieldName => $fieldType) {
            if (!array_key_exists($fieldName, $data)) {
                trigger_error('Field name is not allowed', E_USER_WARNING);
                continue;
            }
            $this->$fieldName = ($fieldType === 'date') ? CarbonImmutable::parse($data[$fieldName]) : $data[$fieldName];
        }
    }
    /**
     * get RPCdataType for field
     */
    public function getFieldType($fieldName): mixed
    {
        $fieldsTypes = $this->getFieldsTypes();
        if (!isset($fieldsTypes)) {
            trigger_error('Please provide field types array for Entity object creation', E_USER_WARNING);
        }
        if (!array_key_exists($fieldName, $fieldsTypes)) {
            trigger_error('Unknown type for field "' . $fieldName . '"', E_USER_WARNING);
        }
        return $fieldsTypes[$fieldName];
    }
    public function toArray(): array
    {
        return (array)$this;
    }
    public function setValue($param, $value): void
    {
        $this->$param = $value;
    }
}
