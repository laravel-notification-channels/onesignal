<?php

namespace NotificationChannels\OneSignal\Test;

use Mockery;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Berkayk\OneSignal\OneSignalClient;
use Psr\Http\Message\ResponseInterface;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\Exceptions\CouldNotSendNotification;

class ChannelTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $oneSignal;

    /** @var \NotificationChannels\OneSignal\OneSignalChannel */
    protected $channel;

    public function setUp()
    {
        parent::setUp();
        $this->oneSignal = Mockery::mock(OneSignalClient::class);

        $this->channel = new OneSignalChannel($this->oneSignal);
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_send_a_notification()
    {
        $response = new Response(200);

        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->once()
            ->with([
                'contents' => ['en' => 'Body'],
                'headings' => ['en' => 'Subject'],
                'url' => 'URL',
                'buttons' => [],
                'web_buttons' => [],
                'chrome_web_icon' => 'Icon',
                'chrome_icon' => 'Icon',
                'adm_small_icon' => 'Icon',
                'small_icon' => 'Icon',
                'include_player_ids' => collect('player_id'),
            ])
            ->andReturn($response);

        $channel_response = $this->channel->send(new Notifiable(), new TestNotification());

        $this->assertInstanceOf(ResponseInterface::class, $channel_response);
    }

    /** @test */
    public function it_throws_an_exception_when_it_could_not_send_the_notification()
    {
        $response = new Response(500, [], 'ResponseBody');

        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->once()
            ->with([
                'contents' => ['en' => 'Body'],
                'headings' => ['en' => 'Subject'],
                'url' => 'URL',
                'buttons' => [],
                'web_buttons' => [],
                'chrome_web_icon' => 'Icon',
                'chrome_icon' => 'Icon',
                'adm_small_icon' => 'Icon',
                'small_icon' => 'Icon',
                'include_player_ids' => collect('player_id'),
            ])
            ->andReturn($response);

        $this->expectException(CouldNotSendNotification::class);

        $this->channel->send(new Notifiable(), new TestNotification());
    }

    /**
     * @test
     */
    public function it_can_send_a_notification_with_array()
    {
        $response = new Response(200);

        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->once()
            ->with([
                'contents' => ['en' => 'Body'],
                'headings' => ['en' => 'Subject'],
                'url' => 'URL',
                'buttons' => [],
                'web_buttons' => [],
                'chrome_web_icon' => 'Icon',
                'chrome_icon' => 'Icon',
                'adm_small_icon' => 'Icon',
                'small_icon' => 'Icon',
                'include_player_ids' => collect(['player_id_1', 'player_id_2']),
            ])
            ->andReturn($response);

        $channel_response = $this->channel->send(new NotifiableArray(), new TestNotification());

        $this->assertInstanceOf(ResponseInterface::class, $channel_response);
    }

    /**
     * @test
     */
    public function it_can_send_a_notification_with_email()
    {
        $response = new Response(200);

        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->once()
            ->with([
                'contents' => ['en' => 'Body'],
                'headings' => ['en' => 'Subject'],
                'url' => 'URL',
                'buttons' => [],
                'web_buttons' => [],
                'chrome_web_icon' => 'Icon',
                'chrome_icon' => 'Icon',
                'adm_small_icon' => 'Icon',
                'small_icon' => 'Icon',
                'filters' => collect([['field' => 'email', 'value' => 'test@example.com']]),
            ])
            ->andReturn($response);

        $channel_response = $this->channel->send(new NotifiableEmail(), new TestNotification());

        $this->assertInstanceOf(ResponseInterface::class, $channel_response);
    }

    /** @test */
    public function it_can_send_a_notification_with_tags()
    {
        $response = new Response(200);

        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->once()
            ->with([
                'contents' => ['en' => 'Body'],
                'headings' => ['en' => 'Subject'],
                'url' => 'URL',
                'buttons' => [],
                'web_buttons' => [],
                'chrome_web_icon' => 'Icon',
                'chrome_icon' => 'Icon',
                'adm_small_icon' => 'Icon',
                'small_icon' => 'Icon',
                'tags' => collect([['key' => 'device_uuid', 'relation' => '=', 'value' => '123e4567-e89b-12d3-a456-426655440000']]),
            ])
            ->andReturn($response);

        $channel_response = $this->channel->send(new NotifiableTags(), new TestNotification());

        $this->assertInstanceOf(ResponseInterface::class, $channel_response);
    }

    /** @test */
    public function it_sends_nothing_and_returns_null_when_player_id_empty()
    {
        $this->oneSignal->shouldReceive('sendNotificationCustom')
            ->never();

        $channel_response = $this->channel->send(new EmptyNotifiable(), new TestNotification());
        $this->assertNull($channel_response);
    }
}
