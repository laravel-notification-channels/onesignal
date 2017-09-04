<?php

namespace NotificationChannels\OneSignal\Test;

use Illuminate\Support\Arr;
use NotificationChannels\OneSignal\OneSignalButton;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;

class MessageTest extends \PHPUnit\Framework\TestCase
{
    /** @var \NotificationChannels\OneSignal\OneSignalMessage */
    protected $message;

    public function setUp()
    {
        parent::setUp();
        $this->message = new OneSignalMessage();
    }

    /** @test */
    public function it_can_accept_a_message_when_constructing_a_message()
    {
        $message = new OneSignalMessage('Message body');

        $this->assertEquals('Message body', Arr::get($message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_provides_a_create_method()
    {
        $message = OneSignalMessage::create('Message body');

        $this->assertEquals('Message body', Arr::get($message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_can_set_the_body()
    {
        $this->message->body('myBody');

        $this->assertEquals('myBody', Arr::get($this->message->toArray(), 'contents.en'));
    }

    /** @test */
    public function it_can_set_the_subject()
    {
        $this->message->subject('mySubject');

        $this->assertEquals('mySubject', Arr::get($this->message->toArray(), 'headings.en'));
    }

    /** @test */
    public function it_can_set_the_url()
    {
        $this->message->url('myURL');

        $this->assertEquals('myURL', Arr::get($this->message->toArray(), 'url'));
    }

    /** @test */
    public function it_can_set_additional_data()
    {
        $this->message->setData('key_one', 'value_one');
        $this->message->setData('key_two', 'value_two');

        $this->assertEquals('value_one', Arr::get($this->message->toArray(), 'data.key_one'));
        $this->assertEquals('value_two', Arr::get($this->message->toArray(), 'data.key_two'));
    }

    /** @test */
    public function it_can_set_the_icon()
    {
        $this->message->icon('myIcon');

        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'chrome_web_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'chrome_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'adm_small_icon'));
        $this->assertEquals('myIcon', Arr::get($this->message->toArray(), 'small_icon'));
    }

    /** @test */
    public function it_can_set_a_web_button()
    {
        $this->message->webButton(
            OneSignalWebButton::create('buttonID')
                ->text('buttonText')
                ->url('buttonURL')
                ->icon('buttonIcon')
        );

        $this->assertEquals('buttonID', Arr::get($this->message->toArray(), 'web_buttons.0.id'));
        $this->assertEquals('buttonText', Arr::get($this->message->toArray(), 'web_buttons.0.text'));
        $this->assertEquals('buttonURL', Arr::get($this->message->toArray(), 'web_buttons.0.url'));
        $this->assertEquals('buttonIcon', Arr::get($this->message->toArray(), 'web_buttons.0.icon'));
    }

    /** @test */
    public function it_can_set_a_button()
    {
        $this->message->button(
            OneSignalButton::create('buttonID')
                ->text('buttonText')
                ->icon('buttonIcon')
        );

        $this->assertEquals('buttonID', Arr::get($this->message->toArray(), 'buttons.0.id'));
        $this->assertEquals('buttonText', Arr::get($this->message->toArray(), 'buttons.0.text'));
        $this->assertEquals('buttonIcon', Arr::get($this->message->toArray(), 'buttons.0.icon'));
    }
}
