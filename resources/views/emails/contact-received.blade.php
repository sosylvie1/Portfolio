{{-- resources/views/emails/contact-received.blade.php --}}
<p><strong>De :</strong> {{ $data['company_name'] }} ({{ $data['email'] }})</p>
<p><strong>De :</strong> {{ $data['name'] }} ({{ $data['email'] }})</p>
<p><strong>Sujet :</strong> {{ $data['subject'] ?? '—' }}</p>
<p><strong>Message :</strong></p>
<p style="white-space: pre-line">{{ $data['message'] }}</p>
