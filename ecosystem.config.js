require('dotenv').config();

// DOCS    :: https://pm2.keymetrics.io/docs/usage/application-declaration/

// console.log('process.env', {
//     'process.env': process.env,
// });

const {
    API_HOST = '0.0.0.0',
    API_PORT = 8000,

    WEB_HOST = '0.0.0.0',
    WEB_PORT = 3000,
} = process.env;

const applicationCwd = './apps/application';

module.exports = {
    apps: [
        {
            name: 'ds:web',
            script: './node_modules/.bin/mix',
            args: 'watch',
            cwd: applicationCwd,

            // while developing more than one cluster breaks things.
            exec_mode: 'fork',
            instances: '1',
            // nuxt dev watches for changes already
            watch: false,

            env: {
                // Inject env vars here. Just make sure to prefix them with REACT_APP
                REACT_APP_API_HOST: API_HOST,
                REACT_APP_API_PORT: API_PORT,
            },
        },
        {
            name: 'ds:api',
            cwd: applicationCwd,
            script: 'artisan',
            args: ['serve', `--host=${API_HOST}`, `--port=${API_PORT}`],
            instances: '1',
            wait_ready: false,
            autorestart: false,
            max_restarts: 1,
            interpreter: 'php',
            watch: false,
        },
        {
            name: 'ds:queue',
            cwd: applicationCwd,
            script: 'artisan',
            args: `queue:work --tries 3 `,
            instances: '1',
            wait_ready: false,
            autorestart: false,
            max_restarts: 1,
            interpreter: 'php',
            watch: false,
            env: {
                // Pass all env variables along
                ...(process.env || {}),
            },
        },
    ],
};
