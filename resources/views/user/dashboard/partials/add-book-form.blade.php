<div class="panel-card">
    <div class="panel-title">Add New Book</div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('message.book_title') }} (English)<span class="text-danger">*</span></label>
            <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}">
            @error('title_en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('message.author') }}<span class="text-danger">*</span></label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
            @error('author') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('message.categories') }}<span class="text-danger">*</span></label>
            <select name="category_id" id="category" class="form-select">
                <option value="">{{ __('message.select_category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->getName() }}
                    </option>
                @endforeach
                <option value="other" {{ old('category_id') == 'other' ? 'selected' : '' }}>
                    {{ __('message.other') }}
                </option>
            </select>
            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div id="otherCategoryDiv" class="mt-2" style="display: none;">
            <input type="text" name="custom_category" class="form-control" placeholder="{{ __('message.enter_category') }}" value="{{ old('custom_category') }}">
        </div>
        @error('custom_category') <small class="text-danger">{{ $message }}</small> @enderror

        <div class="mb-3">
            <label class="form-label">{{ __('message.description') }} (English)</label>
            <textarea name="description_en" class="form-control" rows="2">{{ old('description_en') }}</textarea>
            @error('description_en') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('message.upload_image') }}</label>
            <input type="file" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}">
            @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('message.upload_book') }} (PDF / EPUB)<span class="text-danger">*</span></label>
            <input type="file" name="file" class="form-control" value="{{ old('file') }}">
            @error('file') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('message.edition') }}<span class="text-danger">*</span></label>
            <input type="text" name="edition" class="form-control" value="{{ old('edition') }}" placeholder="{{ __('message.edition_placeholder') }}">
            @error('edition') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <span class="text-danger">*</span> required

        <button class="btn btn-primary w-100 mt-3">
            {{ __('message.add_record') }}
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const category = document.getElementById('category');
    const otherDiv = document.getElementById('otherCategoryDiv');

    function toggleOther() {
        if (category && category.value === 'other') {
            otherDiv.style.display = 'block';
        } else if (otherDiv) {
            otherDiv.style.display = 'none';
        }
    }

    if (category) {
        category.addEventListener('change', toggleOther);
    }

    toggleOther();
});
</script>
