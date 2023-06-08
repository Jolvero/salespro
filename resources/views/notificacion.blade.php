<!DOCTYPE html>
<head>
  <title>Laravel Tiempo Real Codea.APP</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>
   var pusher = new Pusher('1b9067e6b34e34c55dcb', {
      cluster: 'us2',
      encrypted: true
    });

    var channel = pusher.subscribe('nuevo-prospecto');
    channel.bind('App\\Events\\ProspectosNuevosEvent', function(data) {
      alert(data.message);
      mensaje.textContent= data.message
    });
    console.log(channel)

  </script>
  <body>
    <h1>APP EN TIEMPO REAL</h1>
    <p id="mensaje"></p>

  </body>
</head>
