<?php

namespace App\Mail;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArticleUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $article;
    protected $title;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Article $article
     */
    public function __construct(User $user, Article $article)
    {
        $this->user = $user;
        $this->article = $article;
        $this->title = $article->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.article-uploaded',[
            'title' => $this->title
        ])->subject('Article Uploaded Notification');
    }
}
