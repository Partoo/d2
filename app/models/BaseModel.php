<?php
class BaseModel extends Eloquent{
    public function validate()
    {
        $validation = Validator::make($this->attributes,static::$rules);
    }
}