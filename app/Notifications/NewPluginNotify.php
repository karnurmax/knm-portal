<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPluginNotify extends Notification implements ShouldQueue
{
    use Queueable;

   public $plugin;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Plugin Available')
                    ->greeting('Hello,Subscriber')
                    ->line('There is a new plugin. We hope you will like it')
                    ->line('Plugin Title:'.$this->plugin->title)
                    ->action('View Plugin', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
