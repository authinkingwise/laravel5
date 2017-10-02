<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Mail\EmailMarkdown;
use App\Mail\EmailSentWithView;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

class EmailMarkdownTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testEmailMarkdown(){
        $this->assertTrue(true);
        Mail::to('agencylinking@gmail.com')
            ->send(new EmailMarkdown());
        //Mail::to('agencylinking@gmail.com')->send(new EmailSentWithView());
    }
}
