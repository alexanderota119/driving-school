<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserTypes;
use App\Events\LoginAttemptEvent;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function selectGuard()
    {
        /**
         * @get('/login')
         * @name('login')
         * @middlewares('web', 'tenant-web', 'guest')
         */
        return inertia('Auth/SelectGuard');
    }

    public function showLoginForm()
    {
        return inertia('Auth/Login');
    }

    public function loginGuarded($guard)
    {
        /**
         * @get('/login/{guard}')
         * @middlewares('web', 'tenant-web', 'guest')
         */
        return inertia('Auth/Login', ['url' => $guard]);
    }

    public function loginGuardedAttempt(Request $request)
    {
        /**
         * @post('/login/{guard}')
         * @middlewares('web', 'tenant-web', 'guest')
         */
        $validated = $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (! @Auth::attempt($validated, $request->get('remember', true))) {
            session()->flash('message', 'Bad Username/ password');

            return back()
                ->withInput($request->only('email', 'remember'));
        }

        $intended = 'home';

        $user = auth()->user();

        event(
            new LoginAttemptEvent(
                user: $user,
                was_successful: true,
                request: $request,
            )
        );

        $user_type_id = $user->user_type_id;
        switch ($user_type_id) {
            case UserTypes::INSTRUCTOR:
                $intended = 'search/student';
        }

        return redirect()->to("/{$intended}"); // instead of to this was intended

        session()->flash('message', 'Bad Username/ password');

        return back()
            ->withInput($request->only('email', 'remember'));
    }
}
