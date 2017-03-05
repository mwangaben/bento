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
    use DatabaseTransactions, DatabaseMigrations;
    
    
    /** @test **/
    public function it_create_role_name()
    {
        $role = factory(Role::class)->make();
        $user = factory(User::class)->create();
        
        $user->makeRole($role);
        $user->beThe($role->id);
        
        $this->assertDatabaseHas('role_user',['user_id' => $user->id, 'role_id' => $role->id]);
    }
    
    /** @test **/
    public function it_can_delete_the_role(){
        $role = factory(Role::class)->make();
        $user = factory(User::class)->create();
        
        $user->makeRole($role);
        $user->beThe($role->id);
        $user->noMore($role->id);
        
        $this->assertDatabaseMissing('role_user',['role_id' => $role->id, 'user_id' => $user->id]);
    }
    
    /** @test **/
    public function it_can_edit_the_role(){
        $role = factory(Role::class)->make(['name' => 'Admin']);
        $role2 = factory(Role::class)->make(['name' => 'Author']);
        
        $user = factory(User::class)->create();
        
        $user->makeRole($role);
        $user->makeRole($role2);
        $user->beThe($role->id);
        $user->thenBe([$role2->id]);
        
        $this->assertDatabaseHas('role_user',['user_id' => $user->id, 'role_id' => $role2->id]);
    }
        
    
   
}
