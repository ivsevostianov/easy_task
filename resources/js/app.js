import './bootstrap';
import Alpine from 'alpinejs';

// resources/js/app.js

import './bootstrap'; // or your existing bootstrap file if any
import './theme-toggle.js'; // add this line to include your theme toggle code

// ...rest of your app.js code

window.Alpine = Alpine;
Alpine.start();
