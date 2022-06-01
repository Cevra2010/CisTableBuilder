
<table class="{{ $cssClass }}">
    <thead>
        <tr>
            @foreach($fields as $field_name)
                <th>{{ $field_name }}</th>
            @endforeach
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
            </tr>
        @endforeach
    </tbody>
</table>
