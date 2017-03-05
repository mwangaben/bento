<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    /** @test **/
    public function it_create_role_name()
    {
        $role = factory(Role::class)->make(['name' => 'Admin']);
        $user = factory(User::class)->create();
        
        $user->beThe($role);
        
        $this->assertDatabaseHas('roles',['name' => 'Admin']);
    }
    
    /** @test **/
    public function it_can_delete_the_role(){
        $role = factory(Role::class)->make(['name' => 'Admin']);
        $user = factory(User::class)->create();
        
        $user->beThe($role);
        $user->noMore($role->id);
        
        $this->assertDatabaseMissing('roles',['name' => 'Admin']);
    }
    
    /** @test **/
    public function it_can_edit_the_role(){
        $role = factory(Role::class)->make(['name' => 'Admin']);
        $user = factory(User::class)->create();
        
        $user->beThe($role);
        $data = ['name' => 'Author'];
        $user->thenBe($role->id, $data);
        
        $this->assertDatabaseHas('roles',['name' => $data['name']]);
    }
        
    
   
}
