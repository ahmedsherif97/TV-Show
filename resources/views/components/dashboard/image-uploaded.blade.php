@php use Illuminate\Support\Str; @endphp

@props([
    'name' => 'images',
    'multiple' => false,
    'required' => false,
    'existingImages' => [],
    'label' => null,
])

<div class="mb-3">
    <label class="form-label">{{ $multiple ? 'المرفقات' : __('dashboard.image') }}
        @if($required && empty($existingImages))
            <span class="text-danger" id="image-required-marker-{{ $name }}">*</span>
        @endif
    </label>

    <input type="file" id="image-upload-{{ $name }}" class="d-none"
           accept="image/*,.pdf,application/pdf"
           name="{{ $multiple ? $name . '[]' : $name }}"
           {{ $multiple ? 'multiple' : '' }}
           @if($required && empty($existingImages)) required @endif
           data-multiple="{{ $multiple ? 'true' : 'false' }}">

    <div id="image-preview-container-{{ $name }}" class="d-flex flex-wrap gap-2">
        @foreach ($existingImages as $image)
            <div class="position-relative existing-image" data-id="{{ $image->id }}">
                @if(Str::startsWith($image->mime_type, 'image/'))
                    <img src="{{ $image->getUrl() }}" class="rounded border p-1" style="width:100px; height:100px;">
                @else
                    <a href="{{ $image->getUrl() }}" download target="_blank"
                       class="d-flex flex-column align-items-center justify-content-center border rounded p-2 text-center text-decoration-none"
                       style="width:100px; height:100px;">
                        <i class="bi bi-file-earmark-pdf" style="font-size: 32px;"></i>
                        <small class="text-truncate w-100">{{ $image->file_name }}</small>
                    </a>
                @endif
                <button type="button" class="btn btn-danger btn-sm delete-existing" data-id="{{ $image->id }}"
                        style="position:absolute;top:5px;right:5px;">&times;
                </button>
            </div>
        @endforeach
    </div>

    <button type="button" class="btn btn-outline-primary mt-2"
            id="select-image-{{ $name }}">{{$multiple ? 'المرفقات' : 'الصورة'}}</button>

    <input type="hidden" name="deleted_images_{{ $name }}" id="deleted-images-{{ $name }}">
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let deletedImages = [];
            const inputField = document.getElementById('image-upload-{{ $name }}');
            const previewContainer = document.getElementById('image-preview-container-{{ $name }}');
            const marker = document.getElementById('image-required-marker-{{ $name }}');

            document.getElementById('select-image-{{ $name }}').addEventListener('click', () => {
                inputField.click();
            });

            inputField.addEventListener('change', function (event) {
                const files = event.target.files;

                if (!@json($multiple)) {
                    previewContainer.innerHTML = "";
                }

                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        let previewElement;

                        if (file.type.startsWith('image/')) {
                            previewElement = document.createElement('img');
                            previewElement.src = e.target.result;
                            previewElement.className = 'rounded border p-1';
                            previewElement.style.width = '100px';
                            previewElement.style.height = '100px';
                        } else {
                            previewElement = document.createElement('a');
                            previewElement.href = e.target.result;
                            previewElement.download = file.name;
                            previewElement.target = '_blank';
                            previewElement.className = 'd-flex flex-column align-items-center justify-content-center border rounded p-2 text-center text-decoration-none';
                            previewElement.style.width = '100px';
                            previewElement.style.height = '100px';
                            previewElement.innerHTML = `<i class="bi bi-file-earmark-pdf" style="font-size: 32px;"></i><small class="text-truncate w-100">${file.name}</small>`;
                        }

                        const deleteBtn = document.createElement('button');
                        deleteBtn.innerHTML = '&times;';
                        deleteBtn.className = 'btn btn-danger btn-sm';
                        deleteBtn.style.position = 'absolute';
                        deleteBtn.style.top = '5px';
                        deleteBtn.style.right = '5px';
                        deleteBtn.addEventListener('click', function () {
                            previewContainer.removeChild(wrapper);
                        });

                        const wrapper = document.createElement('div');
                        wrapper.className = 'position-relative';
                        wrapper.style.display = 'inline-block';
                        wrapper.style.marginRight = '10px';

                        wrapper.appendChild(previewElement);
                        wrapper.appendChild(deleteBtn);
                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });

            document.querySelectorAll('.delete-existing').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    deletedImages.push(id);
                    this.parentElement.remove();
                    updateDeletedImagesInput();
                });
            });

            function updateDeletedImagesInput() {
                document.getElementById('deleted-images-{{ $name }}').value = JSON.stringify(deletedImages);
            }
        });
    </script>
@endpush

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endpush
