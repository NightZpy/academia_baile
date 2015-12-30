<?php
namespace App\Mailers;
use App\AcademieParticipant;
use App\Pluranza\Academy;
use App\Pluranza\Payment;
use App\Pluranza\Dancer;
use App\Pluranza\Competitor;
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
        $this->from = env('EMAIL_FROM', null);
        $this->fromName = env('EMAIL_FROM_NAME', null);
    }
    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user, $view = null, $attach = null)
    {
        $this->config($user->email, $view);
        $this->data = compact('user');
        $this->deliver('Pluranza 2016: Confirma tu cuenta!', $attach);
    }

    public function sendEmailBase(Academy $academyParticipant)
    {
        // app_path() . '/resources/assets/misc/reglas.pdf'
        $this->config($academyParticipant->email, 'emails.base');
        $this->data = compact('academieParticipant');
        $this->deliver();
    }

    public function sendPaymentUpdateStatus(Payment $payment, $view = null, $subject = null, $attach = null)
    {
        $this->config($payment->academy->user->email, $view);
        $this->data = compact('payment');
        $this->deliver($subject);
    }

    public function sendEmailNewPaymentToAdmin(Payment $payment, User $admin, $view = null, $subject = null, $attach = null) {
        $this->config($admin->email, $view);
        $this->data = compact('payment');
        if ($subject == null) {
            $subject = "PLURANZA 2016: " . $payment->academy->name . " ha realizado un pago.";
        }
        \Debugbar::info('Subject: ' . $subject);
        $this->deliver($subject);
    }

    public function sendEmailUpdatePaymentToAdmin(Payment $payment, User $admin, $view = null, $subject = null, $attach = null) {
        $subject = (!$subject ? "PLURANZA 2016: " . $payment->academy->name . " ha actualizado un pago rechazado." : $subject );
        $this->sendEmailNewPaymentToAdmin($payment, $admin, $view, $subject);
    }

    public function sendEmailToDancer(Dancer $dancer, $view = null)
    {
        $this->config($dancer->email, $view);
        $this->data = compact('dancer');
        $this->deliver('Pluranza 2016: Has sido invitado!');
    }

    public function sendEmailToCompetitor(Competitor $competitor, $view = null) {
        foreach ($competitor->dancers as $dancer) {
            if ($dancer->email) {
                $this->config($dancer->email, $view);
                $this->data = compact('dancer', 'competitor');
                $this->deliver('Pluranza 2016: Has sido invitado!');
            }
        }
    }

    public function config($email, $view)
    {
        $this->to = $email;
        $this->view = $view;
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver($subject = null, $attach = null)
    {
        $to = $this->to;
        $from = $this->from;
        $fromName = $this->fromName;
        $this->mailer->send($this->view, $this->data, function ($message) use ($to, $from, $fromName, $subject, $attach) {
            $message->from(env('MAIL_FROM', null), env('MAIL_FROM_NAME', null))->to($to);
            if($subject)
                $message->subject($subject);
            else
                $message->subject('Pluranza 2016!');

            if($attach)
                $message->attach($attach);
        });
    }
}