@if($pagination)
    <div class="mb-4">
        {{ $tableData->links() }}
    </div>
@endif

<div class="flex">
    @if($search || $pagination)
        <form class="space-x-2" action="{{ $searchRoute }}" method="GET">
            @csrf
            @if($pagination)
            <label>Anzahl</label>
            <input type="text" name="perpage" value="{{ $perpage }}" class="form-input w-20">
            @endif

            @if($search)
            <label>Suchen</label>
            <input type="text" name="search" value="{{ request()->get("search") }}" class="form-input">
            @endif
            <button type="submit" class="form-button">Filtern</button>
            <a href="{{ $resetFilersRoute }}" class="form-button bg-purple-400"><i class="fa fa-close"></i></a>
        </form>
    @endif
</div>

<table class="{{ $cssClass }}">
    <thead>
        <tr>
            @foreach($fields as $field_name)
                <th>{{ $field_name }}</th>
            @endforeach
            @if($actions->count())
                <th>Aktionen</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($tableData as $data)
            <tr>
                @foreach($fields as $field_key => $field_value)
                    @isset($data->$field_key)
                        <td>{{ $data->$field_key }}</td>
                    @else
                        @if($data->$field_key())
                            <td>{{ $data->$field_key() }}</td>
                        @else
                            <td>no-data</td>
                        @endif
                    @endif
                @endforeach
                @if($actions->count())
                    <td class="options">
                        @foreach($actions as $action)
                            {!! $action->getLink($data) !!}
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@if($pagination)
    <div class="mt-4">
        {{ $tableData->links() }}
    </div>
@endif
