<table class="table table-responsive" id="accountHistories-table">
    <thead>
        <tr>
            <th>User</th>
            <th>Account Id</th>
            <th>Message</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($accountHistories as $accountHistory)
        <tr>
            <td>{!! $accountHistory->user['name'] !!}</td>
            <td>{!! $accountHistory->account_id !!}</td>
            <td>{!! $accountHistory->message !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>