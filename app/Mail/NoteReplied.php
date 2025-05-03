<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Note;

class NoteReplied extends Mailable
{
    use Queueable, SerializesModels;

    public $note;
    public $replyContent;

    public function __construct(Note $note, string $replyContent)
    {
        $this->note = $note;
        $this->replyContent = $replyContent;
    }

    public function build()
    {
        return $this->subject('Réponse à votre message')
                    ->markdown('mails.replied')
                    ->with(['note' => $this->note, 'replyContent' => $this->replyContent]);
    }
}