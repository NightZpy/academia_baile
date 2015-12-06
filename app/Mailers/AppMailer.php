<?php
namespace App\Mailers;
use App\AcademieParticipant;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
class AppMailer
{
    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;
    /**
     * The sender NAME of the email.
     *
     * @var string
     */
    protected $fromName;
    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $from;
    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;
    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;
    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
    protected $data = [];
    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->from = env('EMAIL_FROM', false);
        $this->fromName = env('EMAIL_FROM_NAME', false);
    }
    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.confirm';
        $this->data = compact('user');
        $this->deliver();
    }

    public function sendEmailBase(AcademieParticipant $academieParticipant)
    {
        $this->to = $academieParticipant->email;
        $this->view = 'emails.base';
        $this->data = compact('academieParticipant');
        $this->deliver();
    }
    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    {
        $to = $this->to;
        $from = $this->from;
        $fromName = $this->fromName;
        $this->mailer->send($this->view, $this->data, function ($message) use ($to, $from, $fromName) {
            $message->from('pluranza@alcompas.com.ve', $fromName)
                ->to($to);
        });
    }
}