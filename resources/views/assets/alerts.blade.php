
    <div id="alert" class="alert {{ session()->get('notificationStatus') }}">
        <span class="closebtn" onclick="closeAlert()">&times;</span>
        <strong>{{ session()->get('notificationStatus') . "! " }}</strong>
        {{ session()->get('notificationMessage') }}
    </div>


{{-- <div id="alert" class="alert success">
    <span class="closebtn">&times;</span>
    <strong>Success!</strong> Indicates a successful or positive action.
</div>

<div id="alert" class="alert info">
    <span class="closebtn">&times;</span>
    <strong>Info!</strong> Indicates a neutral informative change or action.
</div>

<div id="alert" class="alert warning">
    <span class="closebtn">&times;</span>
    <strong>Warning!</strong> Indicates a warning that might need attention.
</div> --}}
