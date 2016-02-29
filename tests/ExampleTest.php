<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    
    use MailTracking;
     
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {   
        Mail::raw('Hello world', function($message){
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
        });
        
        $this->seeEmailWasSent();
        
        Mail::raw('Hello world', function($message){
            $message->to('foo@bar.com');
            $message->from('bar@foo.com');
            $message->subject('Bleh');
        });
        
        $this->seeEmailsSent(2)
             ->seeEmailTo('foo@bar.com')
             ->seeEmailFrom('bar@foo.com')
             ->seeEmailSubjectIs('Bleh');
        
    }
    
    /**
     * Another basic functional test example
     * 
     * @return void
     */
    public function testRedirectExample() {
        $this->visit('/')
             ->click('Click Me')
             ->see('You\'ve been clicked, punk.')
             ->seePageIs('/feedback');
    }
    

}