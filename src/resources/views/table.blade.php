
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
