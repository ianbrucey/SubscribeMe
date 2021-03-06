<?php

namespace App\Http\Controllers\Auth;

use App\Email;
use App\Mail\ConfirmAccount;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Stripe\Stripe;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    private $secret = "6LdhMW4UAAAAAGFcIO72FqWsyIThtH9MNpc6vCP9";
    private $reCapUrl = "https://www.google.com/recaptcha/api/siteverify";
    protected $hasApiKey   = false;
    protected $portalRouteExtension = '';
    protected $loginRoute;
    protected $registerRoute;
    protected $viewServiceRoute;
    protected $confirmAccountRoute;


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/confirmAccount';

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request = null)
    {
        $this->middleware('guest');

        if(!empty($request) && $request->has('apiKey')) {

            $businessId = $request->get('businessId');
            $stripeId   = $request->get('stripeId');
            $apiKey     = $request->get('apiKey');
            $this->portalRouteExtension = sprintf("/%s/%s/%s",$businessId,$stripeId,$apiKey);
            $this->loginRoute = sprintf("/portal/login%s",$this->portalRouteExtension);
            $this->registerRoute = sprintf("/portal/register%s",$this->portalRouteExtension);
            $this->viewServiceRoute = sprintf("/portal/viewService%s",$this->portalRouteExtension);
            $this->confirmAccountRoute = sprintf("/portal/confirmAccount%s",$this->portalRouteExtension);
            $this->hasApiKey = true;
            $paramsAreValid = validatePortalParams($businessId,$stripeId,$apiKey);
            if($paramsAreValid) {
                $this->redirectTo = sprintf("/portal/viewService%s",$this->portalRouteExtension);
            }
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                'confirmed'
            ],
            'g-recaptcha-response' => 'required|min:10'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @param Request $request
     * @return User
     */
    protected function create(array $data, Request $request)
    {

        $stripeSecretKey = config('services.stripe.secret');

        Stripe::setApiKey($stripeSecretKey);

        // Create the Stripe Customer
        $stripeCustomer = \Stripe\Customer::create([
            'email' => $data['email'],
            'description' => sprintf("account for %s %s | %s",$data['first'],$data['last'],$data['email']),
        ]);

        // if we have a provider, we don't need to verify the user as a bot or not
        $recapResponse = null;
        if(!issetAndTrue($data,'provider')) {
            $recapResponse = $this->postRecaptchaResponse($request);
        }

        $activationToken = generateValidationToken();

        $user = (new User())->create([
            'first' => $data['first'],
            'last' => $data['last'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'stripe_id' => $stripeCustomer->id,
            'activated' => ( issetAndTrue($data,'provider') || $recapResponse->success == true ) ? "1" : "0",
            'activation_token' => $activationToken,
            'provider' => issetAndTrue($data,'provider'),
            'provider_id' => issetAndTrue($data,'provider_id')
        ]);

        if($user->activated != 1) {
            Email::sendConfirmAccountEmail($user, $activationToken);
        }

        return $user;
    }

    private function postRecaptchaResponse(Request $request)
    {
        $postQueryString = sprintf("secret=%s&response=%s", $this->secret, $request->get("g-recaptcha-response"));
        $ch = curl_init($this->reCapUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postQueryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return \GuzzleHttp\json_decode($response); // returns std class obj
    }
}
