@extends('front.layouts.app')
@section('styles')
<script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-detector.js"></script>
<script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-handler.js"></script>
@endsection
@section('contents')
<body style="margin: 0; overflow: hidden;">
    <a-scene
        vr-mode-ui="enabled: false;"
        loading-screen="enabled: false;"
        arjs="trackingMethod: best; sourceType: webcam; debugUIEnabled: false;"
        id="scene"
        isMobile
        gesture-detector
    >
    @foreach ($augmentedReality as $itemAr)

        <a-marker
            id="{{ $itemAr->maerker_id }}"
            type="pattern"
            preset="custom"
            url="{{ $itemAr->marker_file }}"
            raycaster="objects: .clickable"
            emitevents="true"
            cursor="fuse: false; rayOrigin: mouse;"
        >
            <a-image
                src="{{ $itemAr->content_file }}"
                scale="1 1 1"
                class="clickable"
                rotation="-90ma 0 0"
                gesture-handler
            ></a-image>
        </a-marker>
                
        @endforeach
        

        <a-entity camera></a-entity>
    </a-scene>
</body>
@endsection
   

