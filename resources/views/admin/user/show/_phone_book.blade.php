<table class="table table-bordered table-striped display nowrap records reduce_padding">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Telephone</th>
        </tr>
    </thead>

    <tbody>

        @if(!empty($user_file))
        @if(!empty($user_file->phone_contacts) || json_decode($user_file->phone_contacts) > 0)
        @foreach(json_decode($user_file->phone_contacts) as $key=>$contact)
        <tr>

            <td>{{$key+1}}</td>
            <td>{{$contact->name}}</td>
            <td>{{$contact->phone}}</td>

        </tr>
        @endforeach
        @endif
        @endif
    </tbody>
</table>