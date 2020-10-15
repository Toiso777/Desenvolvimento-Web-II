<?php
    namespace App\Http\Middleware;
    use Closure;
    use App;
    use Session;
    use Config;

    class LanguageSwitcher{
        public function handle($request, Closure $next){
            App::setLocale(Session::get('idioma', Config::get('app.locale')));
            return $next($request);
        }
    }