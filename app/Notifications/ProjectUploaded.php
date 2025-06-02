<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $courseName;
    protected $projectTitle;

    public function __construct($courseName, $projectTitle)
    {
        $this->courseName = $courseName;
        $this->projectTitle = $projectTitle;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📢 Project Baru di Kursus ' . $this->courseName)
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Instruktur kamu baru saja mengunggah project baru berjudul:')
            ->line('📌 "' . $this->projectTitle . '"')
            ->line('di kursus: **' . $this->courseName . '**')
            ->action('Lihat Project', url('/student/dashboard')) // atau arahkan ke /student/project jika ada
            ->line('Segera cek dan kerjakan ya, semangat 💪');
    }

    public function toArray($notifiable)
    {
        return [
            'course' => $this->courseName,
            'project' => $this->projectTitle,
        ];
    }
}
