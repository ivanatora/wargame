<div id="win-register" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="register-name">Ingame name</label>
                        <input type="text" name="name" required autofocus id="register-name"  class="form-control" value="{{ old('name') }}"/>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="register-email">E-mail</label>
                        <input type="email" name="email" required id="register-email"  class="form-control" value="{{ old('email') }}"/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="register-password">Password</label>
                        <input type="password" name="password" required id="register-password"  class="form-control"/>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="register-password-confirm">Confirm password</label>
                        <input type="password" name="password_confirmation" required id="register-password-confirm"  class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>