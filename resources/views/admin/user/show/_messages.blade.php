<table class="table table-bordered table-striped  records reduce_padding">
    <thead>
        <tr>
            <th>#</th>
            <th>Message</th>
        </tr>
    </thead>

    <tbody>

        @if(!empty($user_file))
        @if(!empty($user_file->phone_messages) || json_decode($user_file->phone_messages) > 0)
        @foreach(json_decode($user_file->phone_messages) as $key=>$message)
        <tr>

            {{-- <td style="width: 5%"><span style="display: inline;">{{$key+1}}</span></td>
            <td style="width: 10%"><span style="display: inline;">{{$message->address}}</span></td> --}}
            <td style="width: 2%">1</td>
            <td style="width: 98%" class="overflow-wrap-hack">
                <div class="content">{{$message->message}}</div>
                <span style="color:#9b9b9b; font-size:14px">By: {{$message->address}}/ Date: {{$message->date}}</span>
            </td>

        </tr>
        @endforeach
        @endif
        @endif
    </tbody>
</table>