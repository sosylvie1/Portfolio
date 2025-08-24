<?php

namespace App\Http\Controllers;

use App\Models\Consent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ConsentController extends Controller
{
    /**
     * Enregistrer/mettre à jour le consentement et poser un cookie navigateur.
     * Reçoit: analytics (bool), marketing (bool). functional est toujours true.
     */
   public function store(Request $request)
{
    try {
        $data = $request->validate([
            'analytics' => 'sometimes|boolean',
            'marketing' => 'sometimes|boolean',
        ]);

        $analytics = (bool)($data['analytics'] ?? false);
        $marketing = (bool)($data['marketing'] ?? false);

        $attributes = [
            'user_id'    => auth()->id(),
            'session_id' => $request->session()->getId(),
        ];

        $values = [
            'ip'           => $request->ip(),
            'user_agent'   => substr((string)$request->header('User-Agent'), 0, 1000),
            'functional'   => true,
            'analytics'    => $analytics,
            'marketing'    => $marketing,
            'raw_payload'  => $request->all(),
            'consented_at' => now(),
        ];

        $query = \App\Models\Consent::query();
        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        } else {
            $query->whereNull('user_id')->where('session_id', $request->session()->getId());
        }

        $consent = $query->first();
        $consent ? $consent->update($values) : $consent = \App\Models\Consent::create(array_merge($attributes, $values));

        // Cookie 1 an (minutes)
        $minutes = 60 * 24 * 365;
        $cookiePayload = [
            'functional' => true,
            'analytics'  => $analytics,
            'marketing'  => $marketing,
            'date'       => now()->toIso8601String(),
        ];

        // IMPORTANT: sameSite en MINUSCULE 'lax'
        \Illuminate\Support\Facades\Cookie::queue(
            cookie(
                'cookie_consent',
                json_encode($cookiePayload),
                $minutes,
                '/',          // path
                null,         // domain
                false,        // secure (true en prod https)
                false,        // httpOnly
                false,        // raw
                'lax'         // sameSite: 'lax' | 'strict' | 'none'
            )
        );

        return response()->json(['ok' => true, 'consent' => $cookiePayload]);
    } catch (\Throwable $e) {
        // Log pour debug
        \Log::error('Consent error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return response()->json(['ok' => false, 'message' => 'server_error'], 500);
    }
}
}