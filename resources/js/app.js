import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.getElementById("alert-component")) {
    import('./closeAlert')
}

if (document.getElementById("dialog")){
    import('./Modal')
}
