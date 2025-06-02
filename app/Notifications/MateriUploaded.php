<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MateriUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $courseName;
    protected $materiTitle;

    public function __construct($courseName, $materiTitle)
    {
        $this->courseName = $courseName;
        $this->materiTitle = $materiTitle;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📚 Materi Baru di Kursus ' . $this->courseName)
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Instruktur kamu baru saja mengunggah materi baru berjudul:')
            ->line('📘 "' . $this->materiTitle . '"')
            ->line('di kursus: **' . $this->courseName . '**')
            ->action('Lihat Materi', url('/student/dashboard'))
            ->line('Yuk langsung pelajari materi ini sekarang!');
    }

    public function toArray($notifiable)
    {
        return [
            'course' => $this->courseName,
            'materi' => $this->materiTitle,
        ];
    }
}
