<h2>📩 Nouveau message reçu via le portfolio</h2>

<p><strong>Nom :</strong> {{ $messageData->name }}</p>
<p><strong>Email :</strong> {{ $messageData->email }}</p>
@if($messageData->subject)
<p><strong>Sujet :</strong> {{ $messageData->subject }}</p>
@endif

<p><strong>Message :</strong></p>
<p>{{ $messageData->message }}</p>
