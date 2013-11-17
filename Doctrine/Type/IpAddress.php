<?php

namespace Spomky\IpFilterBundle\Doctrine\Type;
 
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
 
/**
* Type that maps an Ip Address SQL to php objects
* @author Florent Morselli
*/
class IpAddress extends Type
{
    const IPADDRESS = 'ipaddress';
     
    public function getName()
    {
        return self::IPADDRESS;
    }
     
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getDoctrineTypeMapping('VARBINARY');
    }
     
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return ($value === null) ? null : inet_ntop($value);
    }
     
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ($value === null) ? null : inet_pton($value);
    }
}
