<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use App\User;

class LikesTest extends TestCase
{
    
    use DatabaseTransactions;
    
    protected $post;
    
    public function setUp() {
        parent::setUp();
        
        $this->post = factory(Post::class)->create();
        
        $this->signIn();
    }
    
    /** @test */
    public function a_user_can_like_a_post() {
       
       $this->post->like();
        
        $this->seeInDatabase('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
        
        $this->assertTrue($this->post->isLiked());
    }
    
    /** @test */
    public function a_user_can_unlike_a_post() {
        
        $this->post->like();
        $this->post->unlike();
        
        $this->notSeeInDatabase('likes', [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
        
        $this->assertFalse($this->post->isLiked());
    }
    
    /** @test */
    public function a_user_may_toggle_a_like_on_a_post() {
        
        $this->post->toggleLike();
        
        $this->assertTrue($this->post->isLiked());
        
        $this->post->toggleLike();
        
        $this->assertFalse($this->post->isLiked());
    }
    
    public function a_post_knows_how_many_likes_it_has() {
        
        $this->post->toggleLike(); 
        
        $this->assertEquals(1, $this->post->likesCount);
    }
}
