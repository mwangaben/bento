<?php
namespace App\Traits;


use App\Role;


trait Roling {
    
    public function roles(){
        return $this->hasMany(Role::class);
    }
    
    public function beThe($role){
        return $this->roles()->save($role);
    }
    
    public function thenBe($id, $data){
        return $this->roles()->where('id', $id)->update($data);
    }
    
    public function noMore($id){
        return $this->roles()->where('id',$id)->delete();
    }
}
?>