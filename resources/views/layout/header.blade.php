<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{('Billetterie')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand m-1" href="{{__('http://billetterie.test/dashboard')}}"> 💬 {{('Messagerie')}}</a>
        <div class="me-3 space-y-1">
            <div class="d-flex">
                <div class="font-medium text-base text-primary me-4 mt-2">
                    {{('Bonjour')}} {{ Auth::user()->name }} !
                </div>
                <form method="POST" action="{{ route('logout') }}" class="me-2">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')
</body>


</html>
