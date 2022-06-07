<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp():void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }


    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 27
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
