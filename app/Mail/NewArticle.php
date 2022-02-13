<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArticle extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $article;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['user'] = $this->user;
        $data['article'] = $this->article;
        return $this->view('mail.new_article', $data);
    }
}
