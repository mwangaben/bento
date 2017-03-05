<?php
namespace App\Traits;


use App\Role;


trait Roling {
    
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    
    public function roled(){
        return $this->hasMany(Role::class);
    }
    
    public function makeRole($data){
        return $this->roled()->save($data);
    }
    
    
    public function beThe($roleId){
        return $this->roles()->attach($roleId);
    }
    
    public function thenBe($roleId){
        return $this->roles()->sync($roleId);
    }
    
    public function noMore($roleId){
        return $this->roles()->detach($roleId);
    }
}
?>