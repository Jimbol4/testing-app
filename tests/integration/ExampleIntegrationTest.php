<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Post;
use App\User;

class ExampleIntegrationTest extends TestCase {
    
    use DatabaseTransactions;
    
    public function setUp() {
        parent::setUp();
        
        $this->post = factory(Post::class)->create(['title' => 'Some Post']);
        
        $this->signIn();
    }
    
    /** @test */
    function it_loads_the_about_page() {
        $this->visit('about')
             ->see('About Me')
             ->click('Contact')
             ->see('Contact Info')
             ->seePageIs('contact');
    }
    
    /** @test */
    function it_searches_for_things() {
       $this->visit('search')
            ->type('integration testing', 'query')
            ->press('search')
            ->see('Search results for "integration testing"');
    }
    
    /** @test */
    function it_displays_all_posts() {
        $this->visit('posts')
             ->see('Some Post');
    }
    
    /** @test */
    function it_publishes_a_post() {
        $this->visit('posts/create')
             ->type('Some title', 'title')
             ->type('Some text', 'body')
             ->press('submit')
             ->seeInDatabase('posts', ['user_id' => $this->user->id, 
                                       'title' => 'Some title', 
                                        'body' => 'Some text'])
             ->seePageIs('posts');
    }
    
    /** @test */ 
    function it_rejects_invalid_posts() {
        $this->visit('posts/create')
             ->type('Without body', 'title')
             ->press('submit')
             ->notSeeInDatabase('posts', ['user_id' => $this->user->id, 
                                       'title' => 'Without body'])
             ->seePageIs('posts/create');
    }
}