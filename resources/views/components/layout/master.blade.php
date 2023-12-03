<!DOCTYPE html>
<html lang="es" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <!-- <link rel="shortcut icon" href="./images/favicon.png"> -->
    <!-- Page Title  -->
    <title>{{ $title }} | FinzApp</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" rel="stylesheet" href="{{ url('assets/css/dashlite.css?ver=2.7.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ url('assets/css/skins/theme-egyptian.css?ver=2.7.0') }}">
    <!-- Custom StyleSheets -->
    {{ $customCSS }}
</head>

<body @class([
    'nk-body',
    'bg-white',
    'npc-default',
    'apps-only',
    'dark-mode',
])>
    <div @class(['nk-app-root'])>
        <!-- main @s -->
        <div @class(['nk-main'])>
            <!-- wrap @s -->
            <div @class(['nk-wrap'])>
                <x-layout.header></x-layout.header>
                <!-- main header @e -->
                <!-- content @s -->
                <div @class(['nk-content'])>
                    <div @class(['container', 'wide-xl'])>
                        <div @class(['nk-content-inner'])>
                            <x-layout.asidebar></x-layout.asidebar>
                            <div @class(['nk-content-body'])>
                                {{ $slot }}
                                <x-layout.footer />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ url('assets/js/bundle.js?ver=2.7.0') }}"></script>
    <script src="{{ url('assets/js/scripts.js?ver=2.7.0') }}"></script>
    <!-- Custom JS -->
    {{ $customJS }}
</body>

</html>
