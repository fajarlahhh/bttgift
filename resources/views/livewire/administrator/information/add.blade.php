<div>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="save">
                    <div>
                        <label for="title" class="form-label">Title</label>
                        <input id="title" type="text" class="form-control" wire:model.defer="title" placeholder="Title" autocomplete="off">
                        @error('title')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <div class="mt-3" wire:ignore>
                        <label for="content" class="form-label">Content</label>
                        <div id="mytextarea" id="content" wire:model.defer="content" ></div>
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
            height: 300,
            menubar: false,
            selector: '#mytextarea',
            toolbar_mode: 'floating',
            setup: function(editor) {
                editor.on('change', function(e) {
                    window.livewire.emit('set:setcontent', editor.getContent());
                });
            }
        });
    </script>
    @endpush
</div>
