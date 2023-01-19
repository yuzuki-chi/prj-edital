<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>デジタルノート</title>
        <script src="https://takaya.hattori-lab.cs.teu.ac.jp/js/app.js" defer="defer"></script>
    </head>
    <body>
        <div id="app">
            <draw-tool />
        </div>
    </body>
</html>