import 'alpinejs';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Larasocket from 'larasocket-js';

window.Echo = new Echo({
    broadcaster: Larasocket,
    token: process.env.MIX_LARASOCKET_TOKEN,
});
