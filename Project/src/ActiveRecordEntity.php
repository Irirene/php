<?php

namespace src;
use Servieces\Db;


abstract class ActiveRecordEntity{

    protected $id;

    public function __set($name, $value){
        $propertyName = $this->underscoreToCamelcase($name);
        $this->$propertyName = $value;
    }

    public function mapPropertiesToDbFormat(){
        $propertiesName = [];
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        foreach($properties as $property){
            $propertyNameToDbFormart = $this->camelcaseToUnderscore($property->getName());
            $propertyName = $property->getName();
            $propertiesName[$propertyNameToDbFormart] = $this->$propertyName;
        }
        //var_dump($propertiesName);
        return $propertiesName;

    }

    public function underscoreToCamelcase(string $name):string
    {
        return lcfirst(str_replace('_', '', ucwords($name, '_')));
    }

    public function camelcaseToUnderscore(string $name):string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
    }

    public function getId(){
        return $this->id;
    }

    public static function  findAll():array
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'` ORDER BY `id` DESC';
        $article = $db->query($sql, [], static::class);
        return $article;
    }

    public static function getById(int $id):static
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `'.static::getTableName().'` WHERE `id` =:id;';
        $article = $db->query($sql, [':id'=>$id], static::class);
        return $article[0];
    }

    public function save(){
        $mapped = $this->mapPropertiesToDbFormat();
        if($mapped['id'] === null) $this->insert($mapped);
        else $this->update($mapped);
    }

    public function update(array $mappedProperties){
        $db = Db::getInstance();
        $key2param = [];
        $param2value = [];
        foreach($mappedProperties as $key=>$value){
            $column = '`'.$key.'`';
            $param = ':'.$key;
            $key2param[] = $column.' = '.$param;
            $param2value[$param] = $value;
        }
        $sql = 'UPDATE `'.static::getTableName().'` SET'.implode(',', $key2param).' WHERE `id`='.$this->id;
        $db->query($sql, $param2value);
    }

    public function insert(array $mappedProperties){
        $filterMappedProperties = array_filter($mappedProperties);
        $db = Db::getInstance();
        $columns = [];
        $paramsName = [];
        $params2Values = [];
        foreach($filterMappedProperties as $key=>$value){
            $columns[] = '`'.$key.'`';
            $paramName = ':'.$key;
            $paramsName[] = $paramName;
            $params2Values[$paramName] = $value;
        }
        $columnWithS = implode(',', $columns);
        $paramsWithS = implode(',', $paramsName);
        $sql = 'INSERT INTO `'.static::getTableName().'`('.$columnWithS.') VALUES ('.$paramsWithS.')';
        $db->query($sql, $params2Values);       
    }

    public function delete(){
        $db = Db::getInstance();
        $sql = 'DELETE FROM `'.static::getTableName().'` WHERE `id`=:id';
        $db->query($sql, [':id'=>$this->id]);
    }

    abstract public static function getTableName():string;

}