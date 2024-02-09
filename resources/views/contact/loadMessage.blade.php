<div class="bg-white">
    <table>
        <tr>
            <th scope="col">Pseudo</th>
            <th scope="col">Message</th>
        </tr>


        @foreach ($contact as $contacts )
            <tr>
                <td>{{$contacts->name}}</td>
                <td class="mess">{{$contacts->message}}</td>
            </tr>
        @endforeach


    </table>
</div>
