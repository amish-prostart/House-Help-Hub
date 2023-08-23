const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Copy Fonts

//
// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css',
//     'public/assets/css/plugins/daterangepicker.css');
// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js',
//     'public/assets/js/plugins/daterangepicker.js');
// mix.copy('node_modules/select2/dist/css/select2.min.css',
//     'public/assets/css/select2.min.css');
// mix.copy('node_modules/flatpickr/dist/flatpickr.css',
//     'public/assets/css/flatpickr.css');
// mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
//     'public/assets/css/dataTables.bootstrap4.min.css');
//
// mix.babel('node_modules/select2/dist/js/select2.min.js',
//     'public/assets/js/select2.min.js');
// mix.babel('node_modules/moment/min/moment.min.js',
//     'public/assets/js/moment.min.js');
// mix.babel('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
//     'public/assets/js/dataTables.bootstrap4.min.js');
// mix.copy('node_modules/flatpickr/dist/flatpickr.min.js',
//     'public/assets/js/flatpickr.js');
// mix.babel('node_modules/datatables.net/js/jquery.dataTables.min.js',
//     'public/assets/js/jquery.dataTables.min.js');
// mix.copy('node_modules/@fortawesome/fontawesome-free/js/all.js',
//     'public/assets/js/all.js');

// mix.babel('node_modules/moment-round/src/moment-round.js',
//     'public/assets/js/moment-round.js')
//
// // Copy CSS

//
// mix.copy('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
//     'public/assets/css/jquery.toast.min.css');
// mix.copy('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js',
//     'public/assets/js/jquery.toast.min.js');
//
// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/int-tel/css/intlTelInput.css');
// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/int-tel/css/intlTelInput.css');

// mix.copy('node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'public/assets/js/int-tel/js/intlTelInput.min.js');
// mix.copy('node_modules/intl-tel-input/build/js/utils.js',
//     'public/assets/js/int-tel/js/utils.min.js');

// mix.copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
//     'public/assets/css/owl.carousel.min.css');
// mix.copy('node_modules/lightgallery/css/lightgallery.css',
//     'public/assets/css/lightgallery.css');
// mix.copy('node_modules/lightgallery/css/lg-transitions.css',
//     'public/assets/css/lg-transitions.css');

//front-css

// mix.copy('node_modules/datatables/media/css/jquery.dataTables.css',
//     'public/assets/css/dataTables.css');

//AOS Css-js
// mix.copy('node_modules/aos/dist/aos.css',
//     'public/assets/css/aos.css');
// mix.copy('node_modules/aos/dist/aos.js',
//     'public/assets/js/aos.js');

// Compile JS

mix.js('resources/assets/js/custom/custom.js',
    'public/assets/js/custom/custom.js').
    js('resources/assets/js/custom/helpers.js',
    'public/assets/js/custom/helpers.js').
    js('resources/assets/js/custom/delete.js',
    'public/assets/js/custom/delete.js').
    js('resources/assets/js/category/category.js',
    'public/assets/js/category/category.js').
version();

//front custom css

mix.sass('resources/assets/scss/admin-custom.scss',
    'public/assets/css/admin-custom.css').version()
// mix.sass('resources/assets/front/scss/layout.scss',
//     'public/landing_front/css/layout.css').version()
// mix.sass('resources/assets/front/scss/home.scss',
//     'public/landing_front/css/home.css').version()
// mix.sass('resources/assets/front/scss/about.scss',
//     'public/landing_front/css/about.css').version()
// mix.sass('resources/assets/front/scss/services.scss',
//     'public/landing_front/css/services.css').version()
// mix.sass('resources/assets/front/scss/contact.scss',
//     'public/landing_front/css/contact.css').version()
// mix.sass('resources/assets/front/scss/choose-plan.scss',
//     'public/landing_front/css/choose-plan.css').version()
// landing css

// mix.sass('resources/assets/hospital-front/scss/hospital-custom.scss',
//     'public/web_front/css/hospital-custom.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-home.scss',
//     'public/web_front/css/hospital-home.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-layout.scss',
//     'public/web_front/css/hospital-layout.css').version();
// mix.sass('resources/assets/hospital-front/scss/hospital-doctors.scss',
//     'public/web_front/css/hospital-doctors.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-about.scss',
//     'public/web_front/css/hospital-about.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-contact.scss',
//     'public/web_front/css/hospital-contact.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-appointment.scss',
//     'public/web_front/css/hospital-appointment.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-working-hours.scss',
//     'public/web_front/css/hospital-working-hours.css').version()
// mix.sass('resources/assets/hospital-front/scss/hospital-testimonials.scss',
//     'public/web_front/css/hospital-testimonials.css').version();

// backend third party css


// front third-party js

// mix.scripts([
//     'node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'node_modules/intl-tel-input/build/js/utils.js',
// ], 'public/js/front-third-party.js')




