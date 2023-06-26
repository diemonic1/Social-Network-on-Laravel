@section('messages')
    @if(isset($dialogue))
        <h4>{{ $companion->name }} | гендер: {{$companion->gender}}</h4>
        <div id="app">
            <dialogue-messages v-bind:data="['{{ auth()->user()->id }}', '{{ $dialogue->id }}', '{{ $companion->id }}']"></dialogue-messages>
            <dialogue-form dialogue_id="{{ $dialogue->id }}"></dialogue-form>
        </div>

        <script type="text/javascript">
            @if($messageToShow == null)
                window.onload = function(){
                    setTimeout(() => {
                        let block = document.getElementById("allMessages");
                        block.scrollTop = block.scrollHeight;
                    }, 1000);
                }
            @else
                window.onload = function(){
                    setTimeout(() => {
                        let message = document.getElementById({{ $messageToShow->id }});
                        message.scrollIntoView();
                    }, 1000);
                }
            @endif
        </script>
    @endif
@endsection
