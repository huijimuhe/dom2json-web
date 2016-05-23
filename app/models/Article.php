<?php

class Article extends Eloquent {

    protected $fillable = ['title', 'text', 'author'];

    public function works() {
        return $this->hasMany('Work');
    }
}
