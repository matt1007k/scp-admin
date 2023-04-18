<div class="mt-5 w-full flex flex-col justify-center items-center gap-5" x-data="DragAndDrop" x-init"init">
    <div class="dropzone w-full md:w-2/4 hover:bg-gray-100 dark:hover:bg-slate-800">
        <input type="file" x-model="file" x-ref="file" accept="{{ $onlyAccept }}" class="input-file" :class="progress === 100 || 'cursor-pointer'" />
        <template x-if="!uploading">
            <p class="grid place-items-center gap-2">
                <x-feathericon-upload class="h-10 w-10" />
                <span>Seleccione un archivo</span>
            </p>
        </template>
        <template x-if="uploading">
            <div>
                <div class="flex justify-center gap-1 text-lg">
                    <span x-text="progress"></span>
                    <span>%</span>
                </div>
                <div class="h-1 w-full bg-gray-200">
                    <div class="h-full bg-blue-500" :style="{ width: `${progress}%` }"></div>
                </div>
            </div>
        </template>
    </div>
    <div class="w-full sm:w-auto grid gap-2">
        <template x-if="error">
            <x-alert type="error" x-text="errors.file[0]"></x-alert>
        </template>
        <template x-if="uploadFile.length > 0">
            <x-alert type="success">
                <template x-for="upFile in uploadFile" :key="upFile.name">
                    <li x-text="getFileUploaded(upFile)"></li>
                </template>
            </x-alert>
        </template>
    </div>

</div>
@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('DragAndDrop', () => ({
            error: false,
            uploading: false,
            uploadFile: [],
            progress: 0,
            errors: {},
            file: null,
            url: @entangle('url'),
            init() {
                this.$watch('file', () => {
                    this.sendFile();
                });
            },
            async sendFile() {
                let file = this.$refs.file.files[0];
                const formData = new FormData();
                formData.append("file", file);

                try {
                    this.uploading = true;
                    const res = await axios.post(this.url, formData, {
                        onUploadProgress: e =>
                            (this.progress = Math.round((e.loaded * 100) / e.total))
                    });
                    this.error = false;
                    this.uploadFile.push(file);
                    this.uploading = false;
                    this.progress = 0;

                    var file_path = res.data.file_path;
                    if (file_path) {
                        this.$wire.emit('filePath', file_path);
                        this.resetInputFile();
                    }
                } catch (error) {
                    console.log('error', error);
                    this.errors = error.response.data.errors;
                    this.progress = 0;
                    this.error = true;
                    this.uploading = false;
                    this.uploadFile = [];
                }
            },
            getFileUploaded(file) {
                return `Archivo: ${file.name} subido con éxito`;
            },
            resetInputFile() {
                this.error = false;
                this.uploading = false;
                this.uploadFile = [];
                this.progress = 0;
                this.errors = {};
            }
        }));

    });
</script>
@endpush
