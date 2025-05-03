<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Note;

class NoteUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function build()
    {
        return $this->subject('Reponse de votre message')
                    ->markdown('mails.updated')
                    ->with('note', $this->note);
    }
}