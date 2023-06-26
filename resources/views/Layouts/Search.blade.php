@section('searchSection')
    <div class="searchSection">
        <form action="{{ route('message.search') }}" method="get">
            <div class="form1">
                <input maxlength='80' name="message" type="text" class="form-control d-inline" id="search_message"
                       placeholder="Поиск по сообщению...">
                <button type="submit" class="btn btn-primary button1">поиск</button>
            </div>
        </form>
    </div>
@endsection
