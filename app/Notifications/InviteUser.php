<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;

class InviteUser extends Notification
{
    use Queueable;

    protected $user; // the user who is invited.

    protected $manager; // the user who sends the invitation.

    protected $password; // the password for the new user.

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, User $manager, $password = null, $token = null)
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->password = $password;
        $this->token = $token;
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
        if ($this->password != null)
            return (new MailMessage)
                        ->subject(config('app.name') . ' - ' . 'Invitation')
                        ->line($this->manager->name . ' (' . $this->manager->email . ') ' . 'is sending this invitation email to you. Please join us with the following details.')
                        ->line('Your login email: ' . $this->user->email)
                        ->line('Password: ' . $this->password)
                        ->line('Name for your account: ' . $this->user->name)
                        ->action('Login', url('/login'))
                        ->line('Thank you for using our application!');
        elseif ($this->token != null) {
            return (new MailMessage)
                        ->subject(config('app.name') . ' - ' . 'Invitation')
                        ->line($this->manager->name . ' (' . $this->manager->email . ') ' . 'is sending this invitation email to you. Please join us with the following details.')
                        ->line('Your login email: ' . $this->user->email)
                        ->line('Name for your account: ' . $this->user->name)
                        ->action('Reset Password', url('/password/reset/' . $this->token))
                        ->line('Thank you for using our application!');
        }
        else
            return (new MailMessage)
                        ->subject(config('app.name') . ' - ' . 'Invitation')
                        ->line($this->manager->name . ' (' . $this->manager->email . ') ' . 'is sending this invitation email to you. Please join us with the following details.')
                        ->line('Your login email: ' . $this->user->email)
                        ->line('Name for your account: ' . $this->user->name)
                        ->action('Reset Password', url('/password/reset'))
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
