@extends('layout.header')
@section('content')
    <!-- Inclure la feuille de style de Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Inclure la bibliothèque Quill et son thème -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.snow.js"></script>
    <!-- Inclure le module de couleur de Quill -->
<script src="https://cdn.quilljs.com/1.3.6/quill.color-picker.min.js"></script>


    <!-- Styles supplémentaires pour la mise en forme -->
    <style>
        input,
        textarea {
            margin-bottom: 10px;
        }

        #htmlContent {
            height: 65vh;
            overflow-y: auto;
            border: 1px solid #ddd;
        }
    </style>

    <!-- Contenu principal de la page -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-4">
                <!-- Conteneur pour afficher le contenu HTML -->
                <div id="htmlContent" class="bg-white p-4 rounded"></div>
            </div>
            <!-- Formulaire d'envoi avec le champ 'name', l'éditeur Quill et le bouton 'Envoyer' -->
            <form action="{{ route('contact.store') }}" method="post" id="monFormulaire" class="form-inline">
                @csrf
                <!-- Éditeur Quill -->
                <div id="editor" style="height: 200px;"></div>
                <!-- Champ caché pour stocker le contenu de l'éditeur -->
                <input type="hidden" id="message" name="message">
                <!-- Bouton d'envoi -->
                <button type="submit" class="btn btn-info mb-3">{{ __('Envoyer') }}</button>
            </form>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        // Fonction pour charger le contenu HTML

        function loadHTML() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("htmlContent").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "http://messagerie.test/api", true);
            xhttp.send();
        }

        // Charger le contenu HTML au chargement de la page et toutes les 500 millisecondes
        loadHTML();
        setInterval(() => {
            loadHTML();
        }, 500);

        // Gérer la soumission du formulaire côté client
        let monFormulaire = document.getElementById("monFormulaire");

        monFormulaire.addEventListener('submit', function(e) {
            // Récupérer les éléments 'name' et 'message'
            let name = document.getElementById("name");
            let message = document.getElementById("message");

            // Vérifier si le champ 'name' est vide
            if (name.value.trim() == "") {
                e.preventDefault();
            }

            // Vérifier si le champ 'message' (éditeur Quill) est vide
            if (message.value.trim() == "") {
                e.preventDefault();
            }
        });
        var toolbarOptions = ['bold', 'italic', 'underline', 'strike',{'color':[]},'link', 'image',];
        // Initialiser l'éditeur Quill
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {toolbar:toolbarOptions}
        });

        // Gérer la soumission du formulaire avec le contenu de l'éditeur Quill
        document.getElementById('monFormulaire').addEventListener('submit', function(event) {
            event.preventDefault();
            var editorContent = quill.root.innerHTML;
            document.getElementById('message').value = editorContent;
            this.submit();
        });

    </script>
@endsection
