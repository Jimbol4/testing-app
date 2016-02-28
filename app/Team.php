<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];
    
    public function add($users) {
       
       $this->guardAgainstTooManyMembers($users);
       
       if ($users instanceof User) {
       return $this->members()->save($users);
       }
       
       $this->members()->saveMany($users);
       
    }
    
    public function remove($users = null) {
        if ($users instanceof User) {
          return $users->leaveTeam();  
        }
        
        return $this->removeMany($users);
    }
    
    public function removeMany($users) {
        return $this->members()
                    ->whereIn('id', $users->pluck('id'))
                    ->update(['team_id' => null]);
    }
    
    public function clear() {
        foreach($this->members as $member) {
            $member->leaveTeam();
        }
    }
    
    public function members() {
        return $this->hasMany('App\User');
    }
    
    public function count() {
        return $this->members()->count();
    }
    
    public function maximumSize() {
        return $this->size;
    }
    
    private function guardAgainstTooManyMembers($users) {
        
        $numUsersToAdd = ($users instanceof User) ? 1 : $users->count();
        
        $newTeamCount = $this->count() + $numUsersToAdd;
        
        if ($newTeamCount > $this->maximumSize()) throw new \Exception;
    }
}
