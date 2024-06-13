<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="col-form-label">Current Password:</label>
            <input id="update_password_current_password" type="password" name="current_password" autocomplete="current-password" class="form-control rounded">
            <div class="mt-2">
                <?php echo $errors->updatePassword->first('current_password'); ?>
            </div>
        </div>

        <div>
            <label for="update_password_password" class="col-form-label">New Password:</label>
            <input id="update_password_password" type="password" name="password" autocomplete="current-password" class="form-control rounded">
            <div class="error-message">
                <?php echo $errors->updatePassword->first('password'); ?>
            </div>
        </div>

        <div>
            <label for="update_password_password_confirmation" class="col-form-label">Confirm Password:</label>
            <input id="update_password_password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="form-control rounded">
            <div class="error-message">
                <?php echo $errors->updatePassword->first('password_confirmation'); ?>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <input type="submit" name="submit" value="Save" class="btn btn-primary my-3">

            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>