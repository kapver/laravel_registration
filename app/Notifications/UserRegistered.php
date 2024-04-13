<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', SMSChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->markdown('notifications.user.registered.mail', $this->getData($notifiable));
    }

    /**
     * Get the SMS representation of the notification.
     *
     * @param User $notifiable
     * @return string
     */
    public function toSMS(User $notifiable): string
    {
        return view('notifications.user.registered.sms', $this->getData($notifiable));
    }

    /**
     *
     * @param $notifiable
     * @return array
     */
    private function getData($notifiable): array
    {
        return [
            'userName' => $notifiable->name,
            'companyName' => config('app.name'),
            'welcomeUrl' => route('welcome')
        ];
    }
}
