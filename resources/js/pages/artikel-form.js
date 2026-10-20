export function initArtikelForm() {
    const picker = document.querySelector('#photo-picker');
    const uploadInput = document.querySelector('#cropped-files');
    const preview = document.querySelector('#photo-preview');
    const dialog = document.querySelector('#crop-dialog');
    const viewImage = document.querySelector('#crop-image');
    const closeButton = document.querySelector('#crop-close');
    const thumbnailInput = document.querySelector('#thumbnail-artikel');
    const thumbnailPreview = document.querySelector('#thumbnail-preview');
    const thumbnailImage = document.querySelector('#thumbnail-preview-image');
    const documentPicker = document.querySelector('#document-picker');
    const documentUploadInput = document.querySelector('#document-files');
    const documentPreview = document.querySelector('#document-preview');

    if (!picker || !uploadInput || !preview) {
        return;
    }

    const items = [];
    let nextId = 1;

    function syncUploadInput() {
        const transfer = new DataTransfer();

        items.forEach((item) => {
            transfer.items.add(item.file);
        });

        uploadInput.files = transfer.files;
    }

    function renderPreview() {
        preview.replaceChildren();

        items.forEach((item) => {
            const column = document.createElement('div');
            column.className = 'col-12 col-sm-6 col-lg-4';

            const card = document.createElement('div');
            card.className = 'card photo-preview-card h-100';

            const imageButton = document.createElement('button');
            imageButton.type = 'button';
            imageButton.className = 'photo-preview-button';

            const image = document.createElement('img');
            image.className = 'photo-preview-image';
            image.src = item.previewUrl;
            image.alt = item.name;

            imageButton.append(image);
            imageButton.addEventListener('click', () => {
                if (viewImage) {
                    viewImage.src = item.previewUrl;
                    viewImage.alt = item.name;
                }

                if (dialog && !dialog.open) {
                    dialog.showModal();
                }
            });

            const body = document.createElement('div');
            body.className = 'card-body';

            const filename = document.createElement('div');
            filename.className = 'text-truncate mb-2';
            filename.textContent = item.name;
            filename.title = item.name;

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-outline-danger btn-sm';
            removeButton.textContent = 'Hapus foto';

            removeButton.addEventListener('click', () => {
                URL.revokeObjectURL(item.previewUrl);

                const index = items.findIndex(
                    (photo) => photo.id === item.id
                );

                if (index !== -1) {
                    items.splice(index, 1);
                }

                syncUploadInput();
                renderPreview();
            });

            body.append(filename, removeButton);
            card.append(imageButton, body);
            column.append(card);
            preview.append(column);
        });

        syncUploadInput();
    }

    picker.addEventListener('change', () => {
        const selectedFiles = Array.from(picker.files || []);

        selectedFiles.forEach((file) => {
            if (file.type.startsWith('image/')) {
                items.push({
                    id: nextId++,
                    name: file.name,
                    file,
                    previewUrl: URL.createObjectURL(file),
                });
            }
        });

        // Reset agar file yang sama bisa dipilih kembali.
        picker.value = '';

        renderPreview();
    });

    const closeButtons = dialog
        ? [...dialog.querySelectorAll('#crop-close, .crop-close-action')]
        : [];

    closeButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (viewImage) {
                viewImage.removeAttribute('src');
            }

            if (dialog.open) {
                dialog.close();
            }
        });
    });

    if (dialog) {
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) {
                dialog.close();
            }
        });
    }

    if (thumbnailInput && thumbnailPreview && thumbnailImage) {
        thumbnailInput.addEventListener('change', () => {
            const file = thumbnailInput.files && thumbnailInput.files[0];

            if (!file || !file.type.startsWith('image/')) {
                thumbnailPreview.hidden = true;
                thumbnailImage.removeAttribute('src');
                return;
            }

            if (thumbnailImage.dataset.url) {
                URL.revokeObjectURL(thumbnailImage.dataset.url);
            }

            const url = URL.createObjectURL(file);
            thumbnailImage.dataset.url = url;
            thumbnailImage.src = url;
            thumbnailPreview.hidden = false;
        });

        thumbnailImage.addEventListener('click', () => {
            if (!dialog || !viewImage || !thumbnailImage.src) {
                return;
            }

            viewImage.src = thumbnailImage.src;
            viewImage.alt = thumbnailImage.alt;

            if (!dialog.open) {
                dialog.showModal();
            }
        });
    }

    if (documentPicker && documentUploadInput && documentPreview) {
        const documentItems = [];
        let documentNextId = 1;

        function syncDocumentInput() {
            const transfer = new DataTransfer();

            documentItems.forEach((item) => {
                transfer.items.add(item.file);
            });

            documentUploadInput.files = transfer.files;
        }

        function formatFileSize(bytes) {
            if (!bytes) return '0 B';

            const units = ['B', 'KB', 'MB', 'GB'];
            let size = bytes;
            let unitIndex = 0;

            while (size >= 1024 && unitIndex < units.length - 1) {
                size /= 1024;
                unitIndex += 1;
            }

            return `${size.toFixed(size >= 10 || unitIndex === 0 ? 0 : 1)} ${units[unitIndex]}`;
        }

        function renderDocumentPreview() {
            documentPreview.replaceChildren();

            documentItems.forEach((item) => {
                const row = document.createElement('div');
                row.className = 'list-group-item d-flex align-items-center justify-content-between gap-3';

                const info = document.createElement('div');
                info.className = 'text-truncate';

                const name = document.createElement('div');
                name.className = 'fw-medium text-truncate';
                // disini untuk nama dokumennya
                name.textContent = item.name;
                name.title = item.name;

                const meta = document.createElement('div');
                meta.className = 'text-secondary small';
                meta.textContent = formatFileSize(item.file.size);

                info.append(name, meta);

                const openLink = document.createElement('a');
                // disini untuk dokumen lampiran yang nantinya jadi link bisa diakses
                openLink.href = item.previewUrl;
                openLink.target = '_blank';
                openLink.rel = 'noopener';
                openLink.className = 'btn btn-outline-primary btn-sm';
                openLink.textContent = 'Buka';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'btn btn-outline-danger btn-sm';
                removeButton.textContent = 'Hapus';

                removeButton.addEventListener('click', () => {
                    const index = documentItems.findIndex(
                        (documentItem) => documentItem.id === item.id
                    );

                    if (index !== -1) {
                        documentItems.splice(index, 1);
                    }

                    if (item.previewUrl) {
                        URL.revokeObjectURL(item.previewUrl);
                    }

                    syncDocumentInput();
                    renderDocumentPreview();
                });

                row.append(info, openLink, removeButton);
                documentPreview.append(row);
            });

            syncDocumentInput();
        }

        documentPicker.addEventListener('change', () => {
            const selectedFiles = Array.from(documentPicker.files || []);

            selectedFiles.forEach((file) => {
                documentItems.push({
                    id: documentNextId++,
                    name: file.name,
                    file,
                    previewUrl: URL.createObjectURL(file),
                });
            });

            // Reset agar file yang sama bisa dipilih kembali.
            documentPicker.value = '';

            renderDocumentPreview();
        });
    }
}
