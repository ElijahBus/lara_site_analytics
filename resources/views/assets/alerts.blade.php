
    <div id="alert" class="alert {{ session()->get('notificationStatus') }}">
        <span class="closebtn" onclick="closeAlert()">&times;</span>
        <strong>{{ session()->get('notificationStatus') . "! " }}</strong>
        {{ session()->get('notificationMessage') }}
    </div>
