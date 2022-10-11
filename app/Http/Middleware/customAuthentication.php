<?php

namespace App\Http\Middleware;
use App\Helpers\ApiResponseHandler;
use App\Helpers\Constant;
//use App\Models\AccessToken;
//use App\Models\Customer;
//use App\Models\CustomerAppSession;
//use App\Models\CustomerCart;
//use App\Models\Otp;
//use App\Models\OtpBlocklist;
//use App\Models\RequestResponseLog;
use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\UploadedFileFactory;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Http\Middleware\CheckCredentials;
use Laravel\Passport\Token;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use App\Helpers\AppException;

class customAuthentication
{
    public function handle($request, Closure $next, ...$scopes)
    {
        try
        {
            $psr = (new PsrHttpFactory(
                new ServerRequestFactory,
                new StreamFactory,
                new UploadedFileFactory,
                new ResponseFactory
            ))->createRequest($request);

            $psr = $this->server->validateAuthenticatedRequest($psr);

            if( $psr->getAttribute('oauth_client_id') == env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID') )
            {

                $tokenId = $psr->getAttribute('oauth_access_token_id');

                $customerAccessToken = Token::getById( $tokenId );
                $userId = $customerAccessToken->name;


                $request->request->set('user_id', $userId);
            }
            else
            {
                throw new \Exception("unauthenticated");
            }

            $this->validate($psr, $scopes);
        }
        catch ( \Exception $e)
        {

        }

        return $next($request);
    }
    /**
     * Validate token credentials.
     *
     * @param  Token  $token
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function validateCredentials($token)
    {
        if (! $token) {
            throw new AuthenticationException;
        }
    }

    /**
     * Validate token credentials.
     *
     * @param  Token  $token
     * @param  array  $scopes
     * @return void
     *
     * @throws MissingScopeException
     */
    protected function validateScopes($token, $scopes)
    {
        if (in_array('*', $token->scopes)) {
            return;
        }

        foreach ($scopes as $scope) {
            if ($token->cant($scope)) {
                throw new MissingScopeException($scope);
            }
        }
    }
}
