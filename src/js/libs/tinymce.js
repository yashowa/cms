// Import TinyMCE
import tinymce from 'tinymce/tinymce';

// A theme is also required
import 'tinymce/themes/silver';

// Any plugins you want to use has to be imported
import 'tinymce/plugins/paste';
import 'tinymce/plugins/link';
require ('./langs/fr_FR.js');

// Initialize the app
tinymce.init({
    selector: '#form-page-content',
    plugins: ['paste', 'link'],
    language: 'fr_FR'
});