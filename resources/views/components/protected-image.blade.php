@props([
    'src',
    'alt' => '',
    'maxWidth' => '400px',
    'watermark' => true, {{-- ✅ option pour activer/désactiver le watermark --}}
    'title' => '',
    'class' => ''
])

<div class="photo-container" style="max-width: {{ $maxWidth }}">
    <img src="{{ $src }}" 
         alt="{{ $alt }}" 
         title="{{ $title }}"
         class="{{ $class }}"
         draggable="false" {{-- empêche le glisser-déposer --}}
         oncontextmenu="return false;"> {{-- bloque clic droit --}}

    {{-- ✅ watermark affiché seulement si activé --}}
    @if($watermark)
        <div class="watermark">© Sylvie Seguinaud</div>
    @endif
</div>

@once
    @push('styles')
    <style>
        .photo-container {
            position: relative;
            display: inline-block;
            margin: 5px;
            overflow: hidden;
        }
        .photo-container img {
            display: block;
            width: 100%;
            height: auto;
            user-select: none; /* empêche la sélection */
        }
        .watermark {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0,0,0,0.5);
            color: white;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            pointer-events: none; /* watermark cliquable désactivé */
        }
    </style>
    @endpush
@endonce
@props([
    'src',
    'alt' => '',
    'maxWidth' => '400px',
    'watermark' => true, {{-- ✅ option pour activer/désactiver le watermark --}}
    'title' => '',
    'class' => ''
])

<div class="photo-container" style="max-width: {{ $maxWidth }}">
    <img src="{{ $src }}" 
         alt="{{ $alt }}" 
         title="{{ $title }}"
         class="protected-image {{ $class }}"
         draggable="false" {{-- empêche le glisser-déposer --}}
         oncontextmenu="return false;"> {{-- bloque clic droit --}}

    {{-- ✅ watermark affiché seulement si activé --}}
    @if($watermark)
        <div class="watermark">© Sylvie Seguinaud</div>
    @endif
</div>

@once
    @push('styles')
    <style>
        .photo-container {
            position: relative;
            display: inline-block;
            margin: 5px;
            overflow: hidden;
        }
        .protected-image {
            display: block;
            width: 100%;
            height: auto;
            user-select: none; /* empêche la sélection */
            pointer-events: none; /* empêche clic droit drag sur l’image */
        }
        /* ✅ Nouveau filigrane diagonal */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            color: rgba(255, 255, 255, 0.25); /* semi-transparent */
            font-size: 2rem;
            font-weight: bold;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
        }
    </style>
    @endpush
@endonce
