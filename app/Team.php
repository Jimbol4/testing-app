<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];
    
    public function add($user) {
       
       $this->guardAgainstTooManyMembers();
       
       if ($user instanceof User) {
       return $this->members()->save($user);
       }
       
       $this->members()->saveMany($user);
       
    }
    
    public function members() {
        return $this->hasMany('App\User');
    }
    
    public function count() {
        return $this->members()->count();
    }
    
    private function guardAgainstTooManyMembers() {
        if ($this->count() >= $this->size) throw new \Exception;
    }
}
