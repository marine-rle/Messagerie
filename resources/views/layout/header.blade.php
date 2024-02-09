<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{('Messagerie')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-dark-custom {
            background-color: #343a40 !important; /* Couleur de fond foncée */
            color: #ffffff !important; /* Couleur de texte blanche */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-dark-custom">
        <div class="container-fluid">
            <div class="navbar-brand"> 💬 {{('Messagerie')}}</div>
            <div class="d-flex justify-content-center align-items-center flex-grow-1">
                <div class="text-center">
                    <div class="font-medium text-base text-white">
                        {{('Bonjour')}} {{ Auth::user()->name }} !
                    </div>
                </div>
            </div>
            <div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-danger">{{ __('Déconnexion') }}</button>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')
</body>

</html>
