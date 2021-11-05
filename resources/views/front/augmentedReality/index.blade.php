@extends('front.layouts.app')
@section('styles')
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
    <script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-detector.js">
    </script>
    <script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-handler.js">
    </script>
    <script>
        AFRAME.registerComponent('vidhandler', {
            // define a variable in which we will keep the video element
            schema: {
                video: {
                    type: 'selector'
                },
            },
            init: function() {
                // use the video from the schema
                this.toggle = false;
                this.video = this.data.video
                this.video.pause()
            },
            tick: function() {
                if (this.el.object3D.visible == true) {
                    if (!this.toggle) {
                        this.toggle = true;
                        this.video.play()
                    }
                } else {
                    this.toggle = false;
                    this.video.pause()
                }
            }
        })
    </script>
@endsection
@section('contents')

    <body style="margin: 0; overflow: hidden;">
        <a-scene vr-mode-ui="enabled: false;" loading-screen="enabled: false;"
            arjs="trackingMethod: best; sourceType: webcam; debugUIEnabled: false;" id="scene" isMobile gesture-detector>

            @foreach ($augmentedReality as $itemAr)
                @if (pathinfo($itemAr->content_file, PATHINFO_EXTENSION) == 'mp4')
                    <a-assets>
                        <video preload="auto" id="vid{{ $loop->index }}" response-type="arraybuffer" loop="false"
                            crossorigin webkit-playsinline playsinline controls>
                            <source src="{{ $itemAr->content_file }}">
                        </video>
                    </a-assets>

                    <a-marker id="{{ $itemAr->marker_id }}" type="pattern" preset="custom"
                        url="{{ $itemAr->marker_file }}" raycaster="objects: .clickable" emitevents="true"
                        cursor="fuse: false; rayOrigin: mouse;" preset="hiro"
                        vidhandler="video: #vid{{ $loop->index }}">
                        <a-plane position='0 0.1 0' gesture-handler class="clickable" scale="3 3 3 3"
                            rotation="-90ma 0 0" material='transparent:true; src:#vid{{ $loop->index }}' controls>
                        </a-plane>
                    </a-marker>
                @endif
                @if (pathinfo($itemAr->content_file, PATHINFO_EXTENSION) != 'mp4')
                    <a-marker id="{{ $itemAr->marker_id }}" type="pattern" preset="custom"
                        url="{{ $itemAr->marker_file }}" raycaster="objects: .clickable" emitevents="true"
                        cursor="fuse: false; rayOrigin: mouse;" preset="hiro"
                        vidhandler="video: #vid{{ $loop->index }}">
                        <a-image src="{{ $itemAr->content_file }}" scale="3 3 3 3" class="clickable"
                            rotation="-90ma 0 0" gesture-handler></a-image>
                    </a-marker>

                @endif
            @endforeach


            <a-entity camera></a-entity>
        </a-scene>
    </body>
@endsection
