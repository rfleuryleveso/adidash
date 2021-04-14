<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Project;

class ProjectAwaitingConfiguration extends Notification
{
    use Queueable;

    /**
     * The project.
     *
     * @var App\Models\Project
     */
    public $project;

    /**
     * Create a new notification instance.
     *
     * @param App\Models\Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
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
                    ->line("Bonjour, {$notifiable->fullName}")
                    ->line("Votre projet, {$this->project->name} à été créer par le comité et doit maintenant être configuré.")
                    ->action('Configurer le projet', route('project-admin.home', ['project' => $this->project->id]));
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
