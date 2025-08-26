// window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'
import Axios from 'axios'

window.axios = Axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Alpine.plugin(intersect)

window.Alpine = Alpine

Alpine.start()
