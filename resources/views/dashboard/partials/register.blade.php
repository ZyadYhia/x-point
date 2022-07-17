<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 pb-3">
            <form id="add-new-user" action="{{ url('dashboard/add-user') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" class="form-control" name="first_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" name="user_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mobile:</label>
                            <input type="text" class="form-control" name="mobile">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password Confirmation:</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    @if (Route::is('dashboard_users'))
                        <input type="hidden" name="role_id" value="{{ $counter->id }}">
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
