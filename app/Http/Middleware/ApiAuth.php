<?php namespace App\Http\Middleware;
use Closure;
use Auth;
use App\Models\ParentFrontpage as Application;
//use App\User;

class ApiAuth {

    public function __construct()
    {
        
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $application = Application::find($request->get('application_id'));
        $time        = $request->get('time',0);
        $key         = $request->get('key');
        if ($time < time() - API_TOKEN_EXPIRATION_TIME)
        {
            $response = [
                'response' => 'FAILED',
                'statusCode' => 403,
                'message' => 'Request token expired',
                'time' => time()
            ];
            return response()->json($response);
        }
        if (!$application)
        {
            $response = [
                'response' => 'FAILED',
                'statusCode' => 403,
                'message' => 'Unauthorized access: Unknown application_id'
            ];
            return response()->json($response);
        }
        if (hash('sha256', APP_API_KEY . $application->private_key . $time) != $key)
        {
            $response = [
                'response' => 'FAILED',
                'statusCode' => 403,
                //'secret' => $application->private_key,
                //'message' => 'Unauthorized access'. hash('sha256', APP_API_KEY . $application->private_key . $time) //debug key
                'message' => 'Unauthorized access'
            ];
            return response()->json($response);
        }

        return $next($request);
    }

}
