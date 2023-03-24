<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    public $user;
    public $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
//        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

        return [
            'message' => 'New Article updated from LarBlog',
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_url' => route('page.detail', $this->post->slug),
        ];
    }

    public function toArray($notifiable)
    {

        return [
            'message' => 'New Article updated from LarBlog',
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_url' => route('page.detail', $this->post->slug),
        ];
    }
}
