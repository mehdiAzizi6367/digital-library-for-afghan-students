<section class="mb-5">

    <!-- Header -->
    <header class="mb-3">
        <h2 class="h5 text-dark mb-1">
            {{ __('profile.delete_acount') }}
        </h2>

        <p class="small text-muted mb-0">
            {{ __('profile.delete_acount_information') }}
        </p>
    </header>

    <!-- Delete Button (Triggers Bootstrap Modal) -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('profile.delete_acount') }}
    </button>

    <!-- Confirmation Modal -->
    @php
        $showModal = $errors->userDeletion->isNotEmpty() ?? false;
    @endphp

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h2 class="h5 modal-title text-dark" id="confirmUserDeletionModalLabel">
                            {{ __('profile.confirm_acount_delete') }}
                        </h2>
                        <!-- Added a close button for standard Bootstrap UI -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('message.close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <p class="small text-muted mb-4">
                            {{ __('profile.delete_acount_information') }}
                        </p>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="visually-hidden">{{ __('message.password') }}</label>
                            
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control w-75 @if($errors->userDeletion->has('password')) is-invalid @endif"
                                placeholder="{{ __('message.password') }}"
                            />

                            <!-- Error Message -->
                            @if($errors->userDeletion->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('message.cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger ms-2">
                            {{ __('profile.delete_acount') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script to automatically open the modal if there are validation errors -->
    @if($showModal)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var deletionModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                deletionModal.show();
            });
        </script>
    @endif

</section>