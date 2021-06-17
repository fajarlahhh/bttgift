<div>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="save">
                    <div>
                        <label for="title" class="form-label">Title</label>
                        <input id="title" type="text" class="form-control" wire:model="title" placeholder="Title" autocomplete="off">
                        @error('title')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="mytextarea" id="content" wire:model="content"></textarea>
                    </div>
                    <button class="btn btn-success mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/qqxdeqhgwbgfazzgno304z8rpf492vx5yid4pl10cguuxubb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'mytextarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    @endpush
</div>
