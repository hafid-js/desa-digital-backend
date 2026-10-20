import '@tabler/core/dist/js/tabler.min.js'
import '@tabler/core/dist/js/tabler-theme.min.js'
import './settings.js'

document.addEventListener('DOMContentLoaded', () => {
    initArtikelForm()
    initWysiwyg()
})

/**
 * Form artikel memakai pemilih foto + cropper, hanya dimuat di halaman tersebut.
 */
async function initArtikelForm() {
    if (!document.querySelector('#photo-picker')) {
        return
    }

    const { initArtikelForm: start } = await import('./pages/artikel-form.js')

    start()
}

/**
 * Editor teks artikel (hugeRTE) hanya tersedia di halaman form artikel.
 */
async function initWysiwyg() {
    const element = document.querySelector('#hugerte-description')

    if (!element) {
        return
    }

    const { default: hugeRTE } = await import('@tabler/core/dist/libs/hugerte/hugerte.min.js')

    hugeRTE.init({
        selector: '#hugerte-description',
        height: 300,
        menubar: false,
        statusbar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
            'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
            'table', 'code', 'help', 'wordcount',
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        content_style:
            'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
        ...(document.documentElement.getAttribute('data-bs-theme') === 'dark'
            ? { skin: 'oxide-dark', content_css: 'dark' }
            : {}),
    })
}
